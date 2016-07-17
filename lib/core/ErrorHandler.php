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

namespace Core;

defined('EAYO_ACCESS') || exit('No direct script access.');

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
        if (\Eayo::$environment == \Eayo::PRODUCTION) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $file = $exception->getFile();
            $line = $exception->getLine();
            error_log("[{$code}] {$message} in {$file} on line {$line}");
        } elseif (\Eayo::$environment == \Eayo::DEVELOPMENT) {
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
            'base_url' => \Core\Tools::init()->rootpath,
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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Eayo Development Error Handler</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $base_url;?>/lib/Core/ErrorHandler/style.css" type="text/css" rel="stylesheet" />
        <style>
            @import url(//fonts.googleapis.com/css?family=Montserrat:400|Raleway:300,400,600|Inconsolata);
            html,
            body {
                height: 100%;
            }

            body {
                padding: 30px;
                background: #fff;
                color: #444;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            a {
                color: #1BB3E9;
            }

            a:hover {
                color: #0e6e90;
            }

            b,
            strong,
            label,
            th {
                font-weight: 600;
            }

            .header {
                font-size: 35px;
                text-align: center;
            }

            html,
            body,
            button,
            input,
            select,
            textarea,
            .pure-g,
            .pure-g [class*="pure-u"] {
                font-family: "Raleway", "Helvetica", "Tahoma", "Geneva", "Arial", sans-serif;
                font-weight: 400;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: "Montserrat", "Helvetica", "Tahoma", "Geneva", "Arial", sans-serif;
                font-weight: 400;
                text-rendering: optimizeLegibility;
                letter-spacing: -0px;
            }

            h1 {
                font-size: 3.2rem;
            }

            @media only all and (max-width: 47.938em) {
                h1 {
                    font-size: 2.5rem;
                    line-height: 1.2;
                    margin-bottom: 2.5rem;
                }
            }

            @media only all and (min-width: 48em) and (max-width: 59.938em) {
                h2 {
                    font-size: 2.1rem;
                }
            }

            @media only all and (max-width: 47.938em) {
                h2 {
                    font-size: 2rem;
                }
            }

            @media only all and (min-width: 48em) and (max-width: 59.938em) {
                h3 {
                    font-size: 1.7rem;
                }
            }

            @media only all and (max-width: 47.938em) {
                h3 {
                    font-size: 1.6rem;
                }
            }

            @media only all and (min-width: 48em) and (max-width: 59.938em) {
                h4 {
                    font-size: 1.35rem;
                }
            }

            @media only all and (max-width: 47.938em) {
                h4 {
                    font-size: 1.25rem;
                }
            }

            h1 {
                text-align: center;
                letter-spacing: -3px;
            }

            h2 {
                letter-spacing: -2px;
            }

            h3 {
                letter-spacing: -1px;
            }

            h1 + h2 {
                margin: -2rem 0 2rem 0;
                font-size: 2rem;
                line-height: 1;
                text-align: center;
                font-family: "Raleway", "Helvetica", "Tahoma", "Geneva", "Arial", sans-serif;
                font-weight: 300;
            }

            @media only all and (min-width: 48em) and (max-width: 59.938em) {
                h1 + h2 {
                    font-size: 1.6rem;
                }
            }

            @media only all and (max-width: 47.938em) {
                h1 + h2 {
                    font-size: 1.5rem;
                }
            }

            h2 + h3 {
                margin: 0.5rem 0 2rem 0;
                font-size: 2rem;
                line-height: 1;
                text-align: center;
                font-family: "Raleway", "Helvetica", "Tahoma", "Geneva", "Arial", sans-serif;
                font-weight: 300;
            }

            @media only all and (min-width: 48em) and (max-width: 59.938em) {
                h2 + h3 {
                    font-size: 1.6rem;
                }
            }

            @media only all and (max-width: 47.938em) {
                h2 + h3 {
                    font-size: 1.5rem;
                }
            }

            blockquote {
                border-left: 10px solid #F0F2F4;
            }

            blockquote p {
                font-size: 1.1rem;
                color: #999;
            }

            blockquote cite {
                display: block;
                text-align: right;
                color: #666;
                font-size: 1.2rem;
            }

            blockquote > blockquote > blockquote {
                margin: 0;
            }

            blockquote > blockquote > blockquote p {
                padding: 15px;
                display: block;
                font-size: 1rem;
                margin-top: 0rem;
                margin-bottom: 0rem;
            }

            blockquote > blockquote > blockquote > p {
                margin-left: -71px;
                border-left: 10px solid #F0AD4E;
                background: #FCF8F2;
                color: #df8a13;
            }

            blockquote > blockquote > blockquote > blockquote > p {
                margin-left: -94px;
                border-left: 10px solid #D9534F;
                background: #FDF7F7;
                color: #b52b27;
            }

            blockquote > blockquote > blockquote > blockquote > blockquote > p {
                margin-left: -118px;
                border-left: 10px solid #5BC0DE;
                background: #F4F8FA;
                color: #28a1c5;
            }

            blockquote > blockquote > blockquote > blockquote > blockquote > blockquote > p {
                margin-left: -142px;
                border-left: 10px solid #5CB85C;
                background: #F1F9F1;
                color: #3d8b3d;
            }

            code,
            kbd,
            pre,
            samp {
                font-family: "Inconsolata", monospace;
            }

            code {
                background: #f9f2f4;
                color: #9c1d3d;
            }

            pre {
                padding: 2rem;
                background: #f6f6f6;
                border: 1px solid #ddd;
                border-radius: 3px;
            }

            pre code {
                color: #237794;
                background: inherit;
            }

        </style>
    </head>
    <body>
        <div class="main">
            <div class="header">Eayo Development Error Handler</div>
            <div class="body">
                <h2>Une erreur de type "<?php echo $type ?>" s'est produite :(</h2>
                <p>
                    <strong>
                        <?= $exception_message ?> [<?= $exception_code ?>]
                    </strong>
                    <br />
                    <span class="exception"><?= $exception_class ?></span>
                    triggered in file
                    <span class="file">
                        <?= $exception_file ?></span> on line <span class="line"><?= $exception_line ?>
                    </span>.
                </p>
                <?= $exception_fragment ?>
                <?php if (isset($exception_backtrace)) : ?>
                <h2>Backtrace</h2>
                <?= $exception_backtrace ?>
                <?php
            endif; ?>
            </div>
        </div>
    </body>
</html>

<?php
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
