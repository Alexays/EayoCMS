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

namespace Apps;

defined('EAYO_ACCESS') || exit('No direct script access.');

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class App
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
    public static $environment = App::PRODUCTION;

    /** @var array Eayo environment names */
    public static $environment_names = array(
        App::PRODUCTION  => 'production',
        App::DEVELOPMENT => 'development',
    );

    public static $router = [];

    public static $apps = [];

    public static $templates = [];

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
        App::$environment = App::DEVELOPMENT;

        /* Init Session */
        $this->sessionStart();

        /** Load Core file */
        $this->__autoload();

        /* Init Config API */
        $this->config = \Core\Config::init();

        /* Init Tools API*/
        $this->tools = \Core\Tools::init();

        /* Init Plugins API*/
        $this->initPlugins();

        /* Init App */
        $this->initApp();

        /* Init default Route */
        //$this->initRoute();
    }

    /** Initialize the autoloader */
    protected function __autoload()
    {
        //spl_autoload_extensions(".php");
        spl_autoload_register(
            function ($className) {
                $fileName = ROOT_DIR . str_replace("\\", DS, $className) . '.php';
                if (file_exists($fileName)) {
                    include $fileName;
                }
            }
        );
        spl_autoload_register('\Core\Plugin::autoload');
        $vendor = LIB_DIR . 'vendor' . DS . 'autoload.php';
        if(is_file($vendor)) {
            include $vendor;
        } else {
            throw new \Exception('Cannot find `lib/vendor/autoload.php`. Run `composer install`.', 1568);
        }
    }

    /**
     * Init Apps
     */
    protected function initApp()
    {
        //ROUTER
        foreach(glob(APP_DIR.'*', GLOB_ONLYDIR) as $app_dir) {
            $app = str_replace(APP_DIR, '', $app_dir);
            $app_conf = Yaml::parse(file_get_contents($app_dir.DS.'config.yml'));
            $this::$apps = array_merge($this::$apps, [$app => $app_conf]);
            $this::$router = array_merge($this::$router, [isset($app_conf['route']) ? $app_conf['route'] : null => $app]);
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
     * Init plugins
     */
    protected function initPlugins()
    {
        $loadPlugin = \Core\Plugin::init();
        $plugins = $this->config->get('plugins');
        if (isset($plugins) && is_array($plugins)) {
            $this->plugins = $loadPlugin->loadAll($plugins);
        }
    }

    public function Router()
    {
        $_query = [];
        $content_file;
        $template_file;

        $query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
        $queryPart = explode('/', rtrim($query, '\/'));
        $queryLength = count($queryPart);
        $index = empty($queryPart[0]) ? null : $queryPart[0];


        if (isset($this::$router) && array_key_exists($index, $this::$router)) {
            $template_name = $this::$router[$index];
            if ($template_name === 'default') {
                $query = empty($query_tmp = implode($queryPart, DS)) ? 'index' : $query_tmp;
            } else {
                $query = empty($query_tmp = str_replace($index, '', implode($queryPart, DS))) ? 'index' : $query_tmp;
            }
        } else {
            $template_name = 'default';
            $query = implode($queryPart, DS);
        }

        list($template_origin, $template_name, $template_path) = $this->tools->findTemplate($template_name);
        if ($template_origin === 'apps') {
            $app_path = APP_DIR.$template_name;
        } elseif($template_origin === 'plugins') {
            $app_path = PLUGINS_DIR.$template_name;
        } else {
            throw new \Exception('Orgine du template inconnue.', 894);
        }
        $view_path = $app_path.DS.'views'.DS;
        $content_path = $view_path.$query;
        $file_finded = $is_template = false;
        //Detect query
        $qPart = $queryPart;
        for($i = 0; $i < $queryLength; $i++) {
            if(!empty($q = glob($content_path.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                $content_file = $q[0];
                $main_query = $qPart[count($qPart) - 1];
                $rest_query = str_replace(implode($qPart, DS), '', implode($queryPart, DS));
                $file_finded = true;
                break;
            } else {
                unset($qPart[$queryLength - $i]);
                $content_path = $view_path.str_replace($index, '', implode($qPart, DS));
            }
        }
        //try in template dir
        if ($file_finded === false && isset($this::$router) && array_key_exists($index, $this::$router)) {
            $content_path = $template_path.implode($qPart, DS);
            $template_content = glob($content_path.'.{php,twig}', GLOB_BRACE);
            if (!empty($template_content)) {
                $content_file = $template_content[0];
                $file_finded = $is_template = true;
            }
        }
        //try index if is dir
        if (is_dir($content_path) && $file_finded === false) {
            $content_path .= DS.'index';
            if(!empty($q = glob($content_path.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                $content_file = $q[0];
                $file_finded = true;
            }
        }
        //else content = 404 error page
        if ($file_finded === false) {
            $template_path_404 = isset($template_name) && $template_name === 'default' ? $template_path : array_values($this->tools->findTemplate('default'))[2];
            $page_404 = glob($template_path_404.'404.{md,html,htm,php}', GLOB_BRACE);
            if(!empty($page_404)) {
                $content_file = $page_404[0];
            } else {
                throw new \Exception('Impossible de trouver le fichier 404 not found');
            }
        }

        return [$content_file, $template_name, $index, $template_path, $view_path, isset($main_query) ? $main_query : '', isset($rest_query) ? $rest_query : '', $is_template];
    }

    /**
     * Prepare Twig Environment
     */
    protected function initTwig()
    {
        $loader = new \Twig_Loader_Filesystem(APP_DIR);
        //For apps & plugins
        $templates = $this::$templates;
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
        $this->twig->addExtension(new \Jralph\Twig\Markdown\Extension(
            new \Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown
        ));
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig_vars = array_merge($this->twig_vars, array(
            'version' => $this::VERSION,
            'config' => $this->config->getAll(),
            'base_url' => $this->tools->rooturl,
            'uploads_url' => $this->tools->rooturl.str_replace(ROOT_DIR, '', UPLOAD_DIR),
            'user' => isset($_SESSION) ? $_SESSION : null
        ));
    }

    /**
     * Return template and content
     *
     * @return $output
     */
    public function Process($router)
    {
        /* Init Twig */
        $this->InitTwig();

        list($content_file, $namespace, $index, $template_path, $view_path, $main_query, $rest_query, $is_template) = $router;

        $ctrlArray = ['php', 'twig'];
        $fileExt = pathinfo($content_file)['extension'];
        $modular_twig = false;
        $template_file = 'default.twig';

        if (in_array($fileExt, $ctrlArray)) {
            $classRoot = str_replace(ROOT_DIR, '', dirname($view_path));
            $controller = DS.$classRoot."\\Controller\\".$index."Ctrl";
            $maincontroller = DS.$classRoot."\\Controller\\".$main_query."Ctrl";
            $controller = class_exists($controller) ? new $controller() : null;
            $maincontroller = class_exists($maincontroller) ? new $maincontroller(): null;

            if ($fileExt === 'php') {
                $content_file = include $content_file;
            } elseif ($fileExt === 'twig') {
                $modular_twig = true;
                if ($is_template) {
                    //$template_file = str_replace($template_path, '', $content_file);
                    $content_file = '@'.$namespace.'/'.str_replace($template_path, '', $content_file);
                } else {
                    $modular_twig = true;
                    $content_file = '@'.$namespace.'_views/'.str_replace($view_path, '', $content_file);
                }
            } else {
                throw new \Exception('Une erreur inconnue est survenue', 0);
            }
        } elseif ($content_file = file_get_contents($content_file)) {
            $is_markdown = $fileExt === 'md' ? true : false;
        }
        $this->twig_vars = array_merge($this->twig_vars, array(
            'theme_url' => $this->tools->rooturl.$this->tools->SanitizeURL(str_replace(ROOT_DIR, '', $template_path).'/'),
            'assets_url' => $this->tools->rooturl.$this->tools->SanitizeURL(str_replace(ROOT_DIR, '', $template_path).'/assets/'),
            'mainCtrl' => isset($maincontroller) ? $maincontroller : null,
            'ctrl' => isset($controller) ? $controller : null,
            'is_markdown' => isset($is_markdown) ? $is_markdown : false,
            'load_time' => number_format(microtime(true) - PERF_START, 3)
        ));
        $this::$content = $content_file;
        try {
            //Process in-page tiwg
            if ($modular_twig) {
                $this->twig_vars['content'] = $this->twig->render($this::$content, $this->twig_vars);
            } else {
                $this->twig_vars['content'] = $this::$content;
            }
            //Process page twig
            $output = $this->twig->render('@'.$namespace.'/'.'default.twig', $this->twig_vars);
        } catch (\Twig_Error_Loader $e) {
            throw new \RuntimeException($e->getRawMessage(), 4054, $e);
        }

        return $output;
    }

    /**
     * Start Session
     */
    protected function sessionStart() {
        if (ini_set('session.use_only_cookies', 1) === '0') {
            throw new \Exception('Could not initiate a safe session (ini_set)', 145);
        }
        session_name('eayo_Session');
        session_set_cookie_params(0, '/', $_SERVER['SERVER_NAME'], isset($_SERVER['HTTPS']), true);
        session_start();
        session_regenerate_id(true);
    }

    /**
     * Return instance of Eayo class as singleton
     *
     * @return $_instance
     */
    public static function start()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new App();
        }
        return static::$_instance;
    }

}
