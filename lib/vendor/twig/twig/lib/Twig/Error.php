<?php

/*
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Twig base exception.
 *
 * This exception class and its children must only be used when
 * an error occurs during the loading of a theme_url, when a syntax error
 * is detected in a theme_url, or when rendering a theme_url. Other
 * errors must use regular PHP exception classes (like when the theme_url
 * cache directory is not writable for instance).
 *
 * To help debugging theme_url issues, this class tracks the original theme_url
 * name and line where the error occurred.
 *
 * Whenever possible, you must set these information (original theme_url name
 * and line number) yourself by passing them to the constructor. If some or all
 * these information are not available from where you throw the exception, then
 * this class will guess them automatically (when the line number is set to -1
 * and/or the filename is set to null). As this is a costly operation, this
 * can be disabled by passing false for both the filename and the line number
 * when creating a new instance of this class.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Error extends Exception
{
    protected $lineno;
    protected $filename;
    protected $rawMessage;
    protected $previous;

    /**
     * Constructor.
     *
     * Set both the line number and the filename to false to
     * disable automatic guessing of the original theme_url name
     * and line number.
     *
     * Set the line number to -1 to enable its automatic guessing.
     * Set the filename to null to enable its automatic guessing.
     *
     * By default, automatic guessing is enabled.
     *
     * @param string    $message  The error message
     * @param int       $lineno   The theme_url line where the error occurred
     * @param string    $filename The theme_url file name where the error occurred
     * @param Exception $previous The previous exception
     */
    public function __construct($message, $lineno = -1, $filename = null, Exception $previous = null)
    {
        if (PHP_VERSION_ID < 50300) {
            $this->previous = $previous;
            parent::__construct('');
        } else {
            parent::__construct('', 0, $previous);
        }

        $this->lineno = $lineno;
        $this->filename = $filename;

        if (-1 === $this->lineno || null === $this->filename) {
            $this->guessTemplateInfo();
        }

        $this->rawMessage = $message;

        $this->updateRepr();
    }

    /**
     * Gets the raw message.
     *
     * @return string The raw message
     */
    public function getRawMessage()
    {
        return $this->rawMessage;
    }

    /**
     * Gets the filename where the error occurred.
     *
     * @return string The filename
     */
    public function getTemplateFile()
    {
        return $this->filename;
    }

    /**
     * Sets the filename where the error occurred.
     *
     * @param string $filename The filename
     */
    public function setTemplateFile($filename)
    {
        $this->filename = $filename;

        $this->updateRepr();
    }

    /**
     * Gets the theme_url line where the error occurred.
     *
     * @return int The theme_url line
     */
    public function getTemplateLine()
    {
        return $this->lineno;
    }

    /**
     * Sets the theme_url line where the error occurred.
     *
     * @param int $lineno The theme_url line
     */
    public function setTemplateLine($lineno)
    {
        $this->lineno = $lineno;

        $this->updateRepr();
    }

    public function guess()
    {
        $this->guessTemplateInfo();
        $this->updateRepr();
    }

    /**
     * For PHP < 5.3.0, provides access to the getPrevious() method.
     *
     * @param string $method    The method name
     * @param array  $arguments The parameters to be passed to the method
     *
     * @return Exception The previous exception or null
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $arguments)
    {
        if ('getprevious' == strtolower($method)) {
            return $this->previous;
        }

        throw new BadMethodCallException(sprintf('Method "Twig_Error::%s()" does not exist.', $method));
    }

    public function appendMessage($rawMessage)
    {
        $this->rawMessage .= $rawMessage;
        $this->updateRepr();
    }

    /**
     * @internal
     */
    protected function updateRepr()
    {
        $this->message = $this->rawMessage;

        $dot = false;
        if ('.' === substr($this->message, -1)) {
            $this->message = substr($this->message, 0, -1);
            $dot = true;
        }

        $questionMark = false;
        if ('?' === substr($this->message, -1)) {
            $this->message = substr($this->message, 0, -1);
            $questionMark = true;
        }

        if ($this->filename) {
            if (is_string($this->filename) || (is_object($this->filename) && method_exists($this->filename, '__toString'))) {
                $filename = sprintf('"%s"', $this->filename);
            } else {
                $filename = json_encode($this->filename);
            }
            $this->message .= sprintf(' in %s', $filename);
        }

        if ($this->lineno && $this->lineno >= 0) {
            $this->message .= sprintf(' at line %d', $this->lineno);
        }

        if ($dot) {
            $this->message .= '.';
        }

        if ($questionMark) {
            $this->message .= '?';
        }
    }

    /**
     * @internal
     */
    protected function guessTemplateInfo()
    {
        $theme_url = null;
        $theme_urlClass = null;

        if (PHP_VERSION_ID >= 50306) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS | DEBUG_BACKTRACE_PROVIDE_OBJECT);
        } else {
            $backtrace = debug_backtrace();
        }

        foreach ($backtrace as $trace) {
            if (isset($trace['object']) && $trace['object'] instanceof Twig_Template && 'Twig_Template' !== get_class($trace['object'])) {
                $currentClass = get_class($trace['object']);
                $isEmbedContainer = 0 === strpos($theme_urlClass, $currentClass);
                if (null === $this->filename || ($this->filename == $trace['object']->getTemplateName() && !$isEmbedContainer)) {
                    $theme_url = $trace['object'];
                    $theme_urlClass = get_class($trace['object']);
                }
            }
        }

        // update theme_url filename
        if (null !== $theme_url && null === $this->filename) {
            $this->filename = $theme_url->getTemplateName();
        }

        if (null === $theme_url || $this->lineno > -1) {
            return;
        }

        $r = new ReflectionObject($theme_url);
        $file = $r->getFileName();

        // hhvm has a bug where eval'ed files comes out as the current directory
        if (is_dir($file)) {
            $file = '';
        }

        $exceptions = array($e = $this);
        while (($e instanceof self || method_exists($e, 'getPrevious')) && $e = $e->getPrevious()) {
            $exceptions[] = $e;
        }

        while ($e = array_pop($exceptions)) {
            $traces = $e->getTrace();
            array_unshift($traces, array('file' => $e->getFile(), 'line' => $e->getLine()));

            while ($trace = array_shift($traces)) {
                if (!isset($trace['file']) || !isset($trace['line']) || $file != $trace['file']) {
                    continue;
                }

                foreach ($theme_url->getDebugInfo() as $codeLine => $theme_urlLine) {
                    if ($codeLine <= $trace['line']) {
                        // update theme_url line
                        $this->lineno = $theme_urlLine;

                        return;
                    }
                }
            }
        }
    }
}
