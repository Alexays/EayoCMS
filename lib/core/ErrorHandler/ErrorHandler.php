<?php
/**
  * This file is part of EayoCMS.
  *
  * @package EayoCMS
  * @author Alexis Rouillard / Leigende <contact@arouillard.fr>
  * @link http://arouillard.fr
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

namespace Core\ErrorHandler;

defined('EAYO_ACCESS') OR exit('No direct script access.');

class ErrorHandler extends \Exception
{
    /**
     * handle the error
     *
     * @param int    $errno
     * @param string $errstr
     * @param string $errfile
     * @param int    $errline
     * @param array  $errcontext
     *
     * @return boolean
     */
    public function handleError($errno, $errstr, $errfile, $errline, array $errcontext)
    {
        if (\Core\Eayo::$environment == \Core\Eayo::PRODUCTION) {
            error_log("[{$errno}] {$errstr} in {$errfile} on line {$errline}");
        } elseif (\Core\Eayo::$environment == \Core\Eayo::DEVELOPMENT) {
            $backtrace = debug_backtrace();
            $backtrace = array_slice($backtrace, 2);
            $this->displayDeveloperOutput(
                $errno,
                $errstr,
                $errfile,
                $errline,
                $backtrace
            );
        }
    }

    /**
     * handle all exceptions
     *
     * @param \Exception $exception
     *
     * @return mixed
     */
    public function handleException(\Exception $exception)
    {
        if (\Core\Eayo::$environment == \Core\Eayo::PRODUCTION) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $file = $exception->getFile();
            $line = $exception->getLine();
            error_log("[{$code}] {$message} in {$file} on line {$line}");
        } elseif (\Core\Eayo::$environment == \Core\Eayo::DEVELOPMENT) {
            $this->displayDeveloperOutput(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                null,
                $exception
            );
        }
    }

    /**
     * show a nice looking and human readable developer output
     *
     * @param $code
     * @param $message
     * @param $file
     * @param $line
     * @param array $backtrace
     * @param \Exception $exception
     */
    protected function displayDeveloperOutput(
        $code,
        $message,
        $file,
        $line,
        array $backtrace = null,
        \Exception $exception = null
    ) {
        header('HTTP/1.1 500 Internal Server Error');
        $fragment = $this->receiveCodeFragment(
            $file,
            $line,
            5,
            5
        );
        $marker = [
        'base_url' => \Core\Tools::init()->GetRootPath(),
        'type' => $exception ? 'Exception' : 'Error',
        'exception_message' => htmlspecialchars($message),
        'exception_code' => htmlspecialchars($code),
        'exception_file' => htmlspecialchars($file),
        'exception_line' => htmlspecialchars($line),
        'exception_fragment' => $fragment,
        'exception_class' => '',
        ];
        if ($exception) {
            $marker['exception_class'] = $this->linkClass(get_class($exception));
            $backtrace = $exception->getTrace();
        }
        if ($backtrace) {
            $marker['exception_backtrace'] = $this->createBacktrace($backtrace);
        }
        $DS = DIRECTORY_SEPARATOR;
        $tplPath = realpath(dirname(__FILE__)) . $DS . 'ErrorHandler.html.php';
        ob_start();
        extract($marker);
        include $tplPath;
        ob_end_flush();
        die();
    }
    /**
     * creates a human readable backtrace
     *
     * @param  array $traces
     * @return string
     */
    protected function createBacktrace(array $traces)
    {
        if (!count($traces)) {
            return '';
        }
        $backtraceCodes = [];
        foreach ($traces as $index => $step) {
            $backtrace = $this->tag('span', count($traces) - $index, ['class' => 'index']);
            $backtrace .= ' ';
            if (isset($step['class'])) {
                $class = $this->linkClass($step['class']) . '<span class="divider">::</span>';
                $backtrace .= $class . $this->linkClass($step['class'], $step['function']);
            } elseif (isset($step['function'])) {
                $backtrace .= $this->tag('span', $step['function'], ['class' => 'function']);
            }
            $arguments = $this->getBacktraceStepArguments($step);
            if ($arguments) {
                $backtrace .= $this->tag('span', "($arguments)", ['class' => 'funcArguments']);
            }
            if (isset($step['file'])) {
                $backtrace .= $this->receiveCodeFragment($step['file'], $step['line'], 3, 3);
            }
            $backtraceCodes[] = $this->tag('pre', $backtrace, ['class' => 'entry']);
        }
        return implode('', $backtraceCodes);
    }
    /**
     * render arguments for backtrace step
     *
     * @param  $step
     * @return string
     */
    protected function getBacktraceStepArguments($step)
    {
        if (empty($step['args'])) {
            return '';
        }
        $arguments = '';
        foreach ($step['args'] as $argument) {
            $arguments .= strlen($arguments) === 0 ? '' : $this->tag('span', ', ', ['class' => 'separator']);
            if (is_object($argument)) {
                $class = 'class';
                $content = $this->linkClass(get_class($argument));
            } else {
                $class = 'others';
                $content = gettype($argument);
            }
            $arguments .= $this->tag(
                'span',
                $content,
                [
                'class' => $class,
                'title' => print_r($argument, true)
                ]
            );
        }
        return $arguments;
    }
    /**
     * receive a code fragment from file
     *
     * @param $filename
     * @param $lineNumber
     * @param $linesBefore
     * @param $linesAfter
     *
     * @return string
     */
    protected function receiveCodeFragment($filename, $lineNumber, $linesBefore = 3, $linesAfter = 3)
    {
        if (!file_exists($filename)) {
            return '';
        }
        $html = $this->tag('span', $filename . ':<br/>', ['class' => 'filename']);
        $code = file_get_contents($filename);
        $lines = explode("\n", $code);
        $firstLine = $lineNumber - $linesBefore - 1;
        if ($firstLine < 0) {
            $firstLine = 0;
        }
        $lastLine = $lineNumber + $linesAfter;
        if ($lastLine > count($lines)) {
            $lastLine = count($lines);
        }
        $line = $firstLine;
        $fragment = '';
        while ($line < $lastLine) {
            $line++;
            $lineText = htmlspecialchars($lines[$line - 1]);
            $lineText = str_replace("\t", '&nbsp;&nbsp;', $lineText);
            $tmp = sprintf('%05d: %s <br/>', $line, $lineText);
            $class = 'row';
            if ($line === $lineNumber) {
                $class .= ' currentRow';
            }
            $fragment .= $this->tag('span', $tmp, ['class' => $class]);
        }
        $html .= $fragment;
        return $this->tag('pre', $html);
    }

    /**
     * resolve a file path by replace the mod: prefix
     *
     * @param $path
     *
     * @return string|null the full filepath or null if file does not exists
     */
    public static function resolveFilePath($path)
    {
        // resolve MOD: prefix
        if (strtoupper(substr($path, 0, 3)) === 'MOD') {
            $path = str_ireplace('mod:', PLUGINS_DIR, $path);
        }
        // check if file exists
        if (file_exists($path)) {
            return $path;
        }
        return null;
    }

    /**
     * link the class or method to the API or return the method name
  *
     * @param $class
     * @param $method
     *
     * @return string
     */
    protected function linkClass($class, $method = null)
    {
        $title = $method ? $method : $class;
        if (strpos($class, 'Core\\') === 0) {
            return $title;
        }
        $filename = 'docs/classes/' . str_replace('\\', '.', $class) . '.html';

        if (file_exists($this->resolveFilePath($filename))) {
            return $title;
        }
        $href = '#';
        if ($method) {
            $href .= '#method_' . $method;
        }
        return $this->tag('a', $title, ['href' =>  $href]);
    }
    /**
     * create HTML-tag
     *
     * @param  string $tag
     * @param  string $content
     * @param  array  $attributes
     * @return string
     */
    protected function tag($tag, $content = '', array $attributes = [])
    {
        $html = '<' . $tag;
        foreach ($attributes as $key => $value) {
            $html .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
        }
        $html .= '>' . $content . '</' . $tag . '>';
        return $html;
    }

}
