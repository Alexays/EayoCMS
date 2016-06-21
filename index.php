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

/* Verify PHP version */
version_compare(PHP_VERSION, "5.5.0", "<") and exit("PHP 5.5.0+ required.");

define('EAYO_ACCESS', true);
define('PERF_START', microtime(true));
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_DIR') || define('ROOT_DIR', realpath(__DIR__ . DS) . DS);

//Include Eayo Class
require ROOT_DIR.'lib/core/Eayo.php';

substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ? ob_start("ob_gzhandler") : ob_start();

//Init Eayo
try {
    $core = \Core\Eayo::start();
    $router = $core->Router();
    echo $core->Process($router);
} catch (\Exception $e) {
    ob_end_flush();
    if (class_exists('\Core\ErrorHandler\ErrorHandler')) {
        $errorHandler = new \Core\ErrorHandler\ErrorHandler;
        $errorHandler->handleException($e);
    } else {
        print($e);
    }
}
