<?php
/**
  * This file is part of EayoCMS.
  *
  * @package EayoCMS
  * @author Alexis Rouillard / Alexays <contact@arouillard.fr>
  * @link http://arouillard.fr
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
ini_set( 'html_errors', 'On' );

version_compare(PHP_VERSION, "5.5.9", "<") and exit("PHP 5.5.9+ required.");

defined('EAYO_ACCESS') || define('EAYO_ACCESS', true);
defined('PERF_START') || define('PERF_START', microtime(true));
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_DIR') || define('ROOT_DIR', realpath(__DIR__) . DS);

substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ? ob_start("ob_gzhandler") : ob_start();

require ROOT_DIR.'lib/Eayo.php';

try {
    $core = \Eayo::init();
    echo $core->run();
} catch (\Exception $e) {
    if (class_exists('\Core\ErrorHandler')) {
        (new \Core\ErrorHandler)->handleException($e);
    } else {
        echo $e;
    }
}
ob_end_flush();
