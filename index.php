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

defined('EAYO_ACCESS') || define('EAYO_ACCESS', true);
defined('PERF_START') || define('PERF_START', microtime(true));
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_DIR') || define('ROOT_DIR', realpath(__DIR__ . DS) . DS);

//Include Eayo Class
require ROOT_DIR.'apps/App.php';

substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ? ob_start("ob_gzhandler") : ob_start();

//Init Eayo
try {
    $core = \Apps\App::start();
    $router = \Core\Router::Analyse($core);
    echo $core->Process($router);
} catch (\Exception $e) {
    if (class_exists('\Core\ErrorHandler')) {
        (new \Core\ErrorHandler)->handleException($e);
    } else {
        print($e);
    }
}
