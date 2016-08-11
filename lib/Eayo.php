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

defined('EAYO_ACCESS') || exit('No direct script access.');

use \Symfony\Component\Yaml\Yaml;
use \Symfony\Component\Yaml\Exception\ParseException;
use \Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;

class Eayo
{

    /** @var core An instance of the Eayo class */
    protected static $_instance = null;

    /** Version de Eayo */
    const VERSION = '0.0.2';

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

    /** @var string Contenu de la page */
    public static $content;

    public static $router = [];

    public static $apps = [];

    public static $templates = [];

    public $twig;

    public $twig_vars = [];

    /**
     * Clone function
     * @private
     */
    protected function __clone()
    {
        // Nothing here.
    }

    /**
     * Construct function
     * @private
     */
    protected function __construct()
    {
        /* Define App */
        defined('LIB_DIR') || define('LIB_DIR', ROOT_DIR . 'lib' . DS);
        defined('APP_DIR') || define('APP_DIR', ROOT_DIR . 'apps' . DS);
        defined('CONF_DIR') || define('CONF_DIR', ROOT_DIR . 'config' . DS);
        defined('CONTENT_DIR') || define('CONTENT_DIR', APP_DIR . 'views' . DS);
        defined('DATA_DIR') || define('DATA_DIR', ROOT_DIR . 'data' . DS);
        defined('UPLOAD_DIR') || define('UPLOAD_DIR', DATA_DIR . 'uploads' . DS);
        defined('PLUGINS_DIR') || define('PLUGINS_DIR', ROOT_DIR . 'plugins' . DS);
        defined('THEMES_DIR') || define('THEMES_DIR', ROOT_DIR . 'themes' . DS);
        defined('CACHE_DIR') || define('CACHE_DIR', DATA_DIR . 'cache' . DS);
        defined('STORAGE_DIR') || define('STORAGE_DIR', LIB_DIR . 'datastorage' . DS);

        /** Set Eayo Environment */
        Eayo::$environment = Eayo::DEVELOPMENT;

        /** Load Core file */
        $this->__autoload();

        /* Init Config API */
        $this->config = Core\Config::init();

        /* Init Tools API*/
        $this->tools = Core\Tools::init();

        /* Init Plugins API*/
        $this->initPlugins();

        /* Init App */
        $this->initApp();

        /* Init Twig */
        $this->InitTwig();
    }

    /**
     * Autoloader function
     * @private
     */
    protected function __autoload()
    {
        spl_autoload_register(
            function ($className) {
                $fileName = str_replace("\\", DS, $className) . '.php';
                if (is_file(LIB_DIR.$fileName)) {
                    //Register Core File
                    include LIB_DIR.$fileName;
                } elseif (is_file(ROOT_DIR.$fileName)) {
                    //Register Apps/Plugins
                    include ROOT_DIR.$fileName;
                }
            }
        );
        //Register Plugins
        spl_autoload_register('\Core\Plugin::autoload');
        $vendor = LIB_DIR.'vendor'.DS .'autoload.php';
        if(is_file($vendor)) {
            include $vendor;
        } else {
            throw new \Exception('Cannot find `lib/vendor/autoload.php`. Run `composer install`.', 1568);
        }
    }

    /**
     * Init App function
     */
    protected function initApp()
    {
        //SESSION
        session_start();
        //ROUTER
        foreach(glob(APP_DIR.'*', GLOB_ONLYDIR) as $app_dir) {
            $app = str_replace(APP_DIR, '', $app_dir);
            $app_conf_file = $app_dir.DS.'config.yml';
            if (file_exists($app_conf_file)) {
                $app_conf = Yaml::parse(file_get_contents($app_conf_file));
            } else {
                $app_conf = ['name' => $app];
            }
            $this::$apps = array_merge($this::$apps, [$app => isset($app_conf) ? $app_conf : null]);
            $this::$router = array_merge($this::$router, [isset($app_conf['route']) ? $app_conf['route'] : $app => $app]);
        }
        $this::$router = array_merge($this::$router, ['login' => 'default']);

        //FIND TEMPLATE PATH
        $theme;
        $template_tmp = [];
        $default_template = [];
        $default_template_path = 'template';
        //1st from apps
        foreach($this::$apps as $key => $val) {
            if (isset($val['template'])) {
                $val['template'] = isset($val['theme']) ? str_replace('{{theme}}', $val['theme'], $val['template']) : $val['template'];
                if (isset($val['default']) && $val['default'] === true) {
                    $default_template = array_merge($default_template, [$key]);
                }
                $template_tmp = array_merge_recursive($template_tmp, ['apps' => [$key => APP_DIR.$key.DS.$val['template']]]);
            } else {
                if (isset($val['default']) && $val['default'] === true) {
                    $default_template = array_merge($default_template, [$key]);
                }
                $template_tmp = array_merge_recursive($template_tmp, ['apps' => [$key => APP_DIR.$key.DS.$default_template_path]]);
            }

        }
        if (count($default_template) === 1) {
            $template_tmp = array_merge_recursive($template_tmp, ['default' => $default_template[0]]);
        } else {
            throw new \Exception('Plusieurs themes sont définie par défaut, erreur.', 148);
        }
        $this::$templates = $template_tmp;
        //2nd from plugins
        //to do
    }

    /**
     * Init Plugins function
     */
    protected function initPlugins()
    {
        $loadPlugin = \Core\Plugin::init();
        $plugins = $this->config->get('plugins');
        if (isset($plugins) && is_array($plugins)) {
            $this->plugins = $loadPlugin->loadAll($plugins);
        }
    }

    /**
     * Prepare Twig Environment
     */
    protected function initTwig()
    {
        $loader = new \Twig_Loader_Filesystem(APP_DIR);
        //For apps & plugins
        $templates = $this::$templates;
        $loader->addPath($templates['apps'][$templates['default']], 'default');
        unset($templates['default']);
        foreach($templates as $origin => $namespaces) {
            foreach($namespaces as $namespace => $template) {
                $loader->addPath($template, $namespace);
                if($origin === 'apps') {
                    $loader->addPath(APP_DIR.$namespace.DS.'views'.DS, $namespace.'_views');
                } elseif($origin === 'plugins') {
                    $loader->addPath(PLUGINS_DIR.$namespace.DS.'views'.DS, $namespace.'_views');
                } else {
                    throw new \Exception('Orgine du template inconnue.', 894);
                }
            }
        }

        $twigConf = $this->config->get('twig');
        $twigConf['cache'] = $twigConf['cache'] === true ? CACHE_DIR : false;

        $this->twig = new \Twig_Environment($loader, $twigConf);
        //$this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig->addExtension(new Core\TwigExtension($this->tools));
        $conf = $this->config->getAll();
        unset($conf['twig']);
        $this->twig_vars = array_merge($this->twig_vars, array(
            'version' => $this::VERSION,
            'config' => $conf,
            'user' => isset($_SESSION) ? $_SESSION : null
        ));
    }

    /**
     * Process request
     * @param  array $router Router return
     * @return string return the content
     */
    public function Process($router)
    {
        list($content_file, $namespace, $index, $template_path, $view_path, $main_query, $is_template, $params) = $router;
        $this->twig_vars = array_merge($this->twig_vars, array(
            'params' => $params,
            'theme_url' => $this->tools->rooturl.str_replace(ROOT_DIR, '', $template_path),
            'assets_url' => $this->tools->rooturl.str_replace(ROOT_DIR, '', $template_path).'assets/',
            'app_url' =>$this->tools->rooturl.$namespace.'/'
        ));
        $fileExt = pathinfo($content_file)['extension'];
        $is_assets = false;
        switch ($fileExt) {
            case "php":
            case "twig":
                $classRoot = str_replace('/', '\\', str_replace(ROOT_DIR, '', dirname($view_path)));
                $classRoot = '\\'.$classRoot.'\\Controller\\';
                $controller = $classRoot.$index.'Ctrl';
                $maincontroller = $classRoot.$main_query.'Ctrl';
                $this->twig_vars[$index] = $controller = class_exists($controller) ? new $controller() : null;
                $this->twig_vars[$main_query] = $maincontroller = class_exists($maincontroller) ? new $maincontroller(): null;
                if ($fileExt === 'php') {
                    $content_file = include $content_file;
                } else {
                    $is_assets = true;
                    $content_file = $is_template ? $namespace.'/'.ltrim(str_replace($template_path, '', $content_file), '\/') : $namespace.'_views/'.ltrim(str_replace($view_path, '', $content_file), '\/');
                }
                break;
            case "html":
                $content_file = file_get_contents($content_file);
                break;
            case "md":
                $markdown = new \Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown;
                $content_file = $markdown->parse(file_get_contents($content_file));
                break;
            default:
                throw new \Exception('Une erreur inconnue est survenue', 0);
        }
        try {
            if (empty($_POST)) {
                $this->twig_vars['load_time'] = number_format(microtime(true) - PERF_START, 3);
                if ($is_assets) {
                    $output = $this->twig->render('@'.$content_file, $this->twig_vars);
                } else {
                    $this->twig_vars['content'] = $content_file;
                    $output = $this->twig->render('@'.$namespace.'/'.'default.html.twig', $this->twig_vars);
                }
                return $output;
            }
        } catch (\Twig_Error_Loader $e) {
            throw new \RuntimeException($e->getRawMessage(), 4054, $e);
        }
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
