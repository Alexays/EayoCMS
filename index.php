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
version_compare(PHP_VERSION, "5.3.2", "<") and exit("PHP 5.3.2+ required.");

define('EAYO_ACCESS', true);

//Include Eayo Class
require_once 'lib/core/Eayo.php';

ob_start();

//Init Eayo
try {
    \Core\Eayo::init();
} catch (\Exception $e) {
    ob_end_flush();
    if (class_exists('\Core\ErrorHandler\ErrorHandler')) {
        $errorHandler = new \Core\ErrorHandler\ErrorHandler;
        $errorHandler->handleException($e);
    } else {
        print($e);
    }
}
