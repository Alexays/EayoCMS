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
    const VERSION = '0.0.2';

    /** Common environment type constants for consistency and convenience */
    const PRODUCTION  = 1;
    const DEVELOPMENT = 2;

    /** @var string Contenu de la page */
    public static $content = '';

    /** @var string Eayo environment */
    public static $environment = Eayo::PRODUCTION;

    /** @var array Eayo environment names */
    public static $environment_names = array(
        Eayo::PRODUCTION  => 'production',
        Eayo::DEVELOPMENT => 'development',
    );

    public static $router = [];

    public $twig;

    public $twig_vars = [];

    /** @access  protected clone method */
    protected function __clone()
    {
        // Nothing here.
    }

    protected function __construct()
    {
        /* Define App */
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

        /* Init Tools API*/
        $this->tools = Tools::init();

        /* Init Plugins API*/
        $this->initPlugins();

        /* Init Backend Plugin */
        //$this->plugins->addPlugin(APP_DIR.'ctrl'.DS.'admin'.DS.'core.php', '\App\Ctrl\Admin\Core', 'admin'); //same as futur plugins api

        /* Sanitize URL to prevent XSS */
        $this->tools->SanitizeURL();

        /* Discovered Requested File *
        $file = $this->tools->requestFile($this->plugins);

        /* Set Content from Discovered Requested File *
        $this->tools->getContent($file);*/

        /* init Twig */
        $this->initTwig();
        /* init Router */
        $this->Router();
    }

    /** Initialize the autoloader */
    protected function __autoload()
    {
        spl_autoload_extensions(".php");
        spl_autoload_register(
            function ($className) {
                $fileName = LIB_DIR . str_replace("\\", DS, $className) . '.php';
                if (file_exists($fileName)) {
                    include $fileName;
                }
            }
        );
        spl_autoload_register('\Core\Plugin::autoload');
        $vendor = ROOT_DIR . 'vendor' . DS . 'autoload.php';
        if(is_file($vendor)) {
            include $vendor;
        } else {
            throw new \Exception('Cannot find `vendor/autoload.php`. Run `composer install`.', 1568);
        }
    }

    /**
     * Init plugins
     */
    protected function initPlugins()
    {
        $loadPlugin = Plugin::init();
        $plugins = $this->config->get('plugins');
        if (isset($plugins) && is_array($plugins)) {
            $this->plugins = $loadPlugin->loadAll($plugins);
        }
    }

    /**
     * Router
     */
    protected function Router()
    {
        $file = $this->tools->requestFile();
        echo $this->processPage($this->tools->getContent($file));
    }

    /**
     * Prepare Twig Environment
     */
    protected function initTwig()
    {
        $loader = new \Twig_Loader_Filesystem(ROOT_DIR);
        $loaderArray = new \Twig_Loader_Array([]);
        $loader_chain = new \Twig_Loader_Chain([$loaderArray, $loader]);

        $this->twig = new \Twig_Environment($loader_chain, $this->config->get('twig'));
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig_vars = array_merge($this->twig_vars, array(
            'version' => Eayo::VERSION,
            'config' => $this->config->getAll(),
            'base_url' => $this->tools->rooturl
        ));
    }

    public function processPage($page)
    {
        $local_twig = clone($this->twig);
        $time_end = microtime(true);
        $time = number_format($time_end - PERF_START, 3);
        $this->twig_vars = array_merge($this->twig_vars, array(
            'load_time' => $time,
            'content' => Eayo::$content
        ));
        $output = '';

        try {
            $type = key($page);
            $file = $page[$type];
            if($type === 'twig') {
                $output = $local_twig->render($file, $this->twig_vars);
            } elseif ($type === 'md') {
                $output = \ParsedownExtra::instance()->setBreaksEnabled(true)->text(file_get_contents($file));
            }
        } catch (\Twig_Error_Loader $e) {
            throw new \Exception($e->getRawMessage(), 4054);
        }

        return $output;
    }

    /**
     * Return instance of Eayo class as singleton
     *
     * @return $_instance
     */
    public static function start()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Eayo();
        }
        return static::$_instance;
    }

}
