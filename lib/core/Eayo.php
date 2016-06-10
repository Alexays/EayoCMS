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

defined('EAYO_ACCESS') OR exit('No direct script access.');

class Eayo
{
    /** @var core An instance of the Eayo class */
    protected static $_instance = null;

    /** Version de Eayo */
    const VERSION = '0.0.1';

    /** Common environment type constants for consistency and convenience */
    const PRODUCTION  = 1;
    const DEVELOPMENT = 2;

    /** @var string Eayo environment */
    public static $environment = Eayo::PRODUCTION;

    /** @var array Eayo environment names */
    public static $environment_names = array(
        Eayo::PRODUCTION  => 'production',
        Eayo::DEVELOPMENT => 'development',
    );

    /** @access  protected clone method */
    protected function __clone()
    {
        // Nothing here.
    }

    protected function __construct()
    {
        /* Define App */
        defined('DS') || define('DS', DIRECTORY_SEPARATOR);
        defined('ROOT_DIR') || define('ROOT_DIR', realpath(__DIR__ . DS . '..' . DS . '..' . DS) . DS);
        defined('LIB_DIR') || define('LIB_DIR', ROOT_DIR . 'lib' . DS);
        defined('APP_DIR') || define('APP_DIR', LIB_DIR . 'app' . DS);
        defined('CONTENT_DIR') || define('CONTENT_DIR', APP_DIR . 'views' . DS);
        defined('CONTENT_EXT') || define('CONTENT_EXT', '.md');
        defined('PLUGINS_DIR') || define('PLUGINS_DIR', ROOT_DIR . 'plugins' . DS);
        defined('THEMES_DIR') || define('THEMES_DIR', APP_DIR . 'themes' . DS);
        defined('CACHE_DIR') || define('CACHE_DIR', LIB_DIR . 'cache' . DS);
        defined('STORAGE_DIR') || define('STORAGE_DIR', LIB_DIR . 'datastorage' . DS);

        /** Set Eayo Environment */
        Eayo::$environment = Eayo::DEVELOPMENT;

        /** Load Core file */
        $this->__autoload();

        /* Init Config API */
        $this->config = Config::init();

        defined('THEMES') || define('THEMES', $this->config->get('themes'));

        /* Init Tools API*/
        $this->tools = Tools::init();

        /* Init Backend Plugin */
        new Admin;

        /* Sanitize URL to prevent XSS */
        $this->tools->SanitizeURL();

        /* Discover Requested File */
        $this->tools->requestFile();

        /* Execute Twig */
        $this->executeTwig();
    }

    /** Initialize the autoloader */
    protected function __autoload()
    {
        spl_autoload_extensions(".php");
        spl_autoload_register(
            function ($className) {
                $fileName = LIB_DIR . str_replace("\\", DS, $className) . '.php';
                if (file_exists($fileName)) {
                    include_once $fileName;
                }
            }
        );
        if(is_file(ROOT_DIR . 'vendor' . DS . 'autoload.php')) {
            require_once ROOT_DIR . 'vendor' . DS . 'autoload.php';
        } else {
            throw new \Exception('Cannot find `vendor/autoload.php`. Run `composer install`.', 1568);
        }
    }

    /**
     * Prepare Twig Environment
     */
    protected function executeTwig()
    {
        $dir = isset($this->tools->template) ? $this->tools->template : THEMES_DIR . THEMES . DS . 'templates';
        $loader = new \Twig_Loader_Filesystem($dir);
        $twig = new \Twig_Environment($loader, $this->config->get('twig'));
        $twig->addExtension(new \Twig_Extension_Debug());
        $TEMPLATE_NAME = 'index';

        if (file_exists($dir.DS.$TEMPLATE_NAME.'.twig')) {
            $TEMPLATE_NAME .= '.twig';
        } else {
            $TEMPLATE_NAME .= '.html';
        }
        echo $twig->render($TEMPLATE_NAME, $this->getTwigVariables());
    }

    /**
     * Returns the variables passed to the template
     *
     * @return array template variables
     */
    protected function getTwigVariables()
    {
        return array(
            'config' => $this->config->getAll(),
            'contents' => Tools::$content
        );
    }

    /**
     * Return instance of Eayo class as singleton
     *
     * @return $_instance
     */
    public static function init()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Eayo();
        }
        return static::$_instance;
    }

}
