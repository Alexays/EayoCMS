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

    public $templates = [];

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
        defined('CONTENT_EXT') || define('CONTENT_EXT', '.md');
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
        foreach(glob(APP_DIR.'*', GLOB_ONLYDIR) as $app_dir) {
            $app = str_replace(APP_DIR, '', $app_dir);
            $app_conf = Yaml::parse(file_get_contents($app_dir.DS.'config.yml'));
            \Apps\App::$apps = array_merge(\Apps\App::$apps, [$app => $app_conf]);
            \Apps\App::$router = array_merge(\Apps\App::$router, [isset($app_conf['route']) ? $app_conf['route'] : null => $app]);
        }
        \Apps\App::$router = array_merge(\Apps\App::$router, ['login' => 'default']);
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
            $content = empty($content_tmp = str_replace($index, '', implode($queryPart, DS))) ? 'index' : $content_tmp;
        } else {
            $template_name = 'default';
            $content = implode($queryPart, DS);
        }

        $template_path = $this->tools->findTemplate($template_name);
        $app_path = APP_DIR.$template_name;
        $view_path = rtrim($app_path, '\/').DS.'views'.DS;
        $this->templates = array_merge($this->templates, [$template_name => ['views' => $view_path, 'template' => $template_path]]);
        $content_path = $view_path.implode($queryPart, DS);
        $file_finded = false;

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

        if ($file_finded === false) {
            if (is_dir($content_path)) {
                $content_path .= DS.'index';
                if(!empty($q = glob($content_path.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                    $content_file = $q[0];
                    $file_finded = true;
                }
            }
        }

        if ($file_finded === false) {
            $template_path = isset($template_name) && $template_name === 'default' ? $template_path : $this->tools->findTemplate('default');
            $this->templates = array_merge($this->templates, ['default' => ['template' => $template_path]]);
            $page_404 = glob($template_path.'404.{md,html,htm,php}', GLOB_BRACE);
            $content_file = $page_404[0];
        }

        return [$content_file, $template_name, $index, $template_path, $view_path, isset($main_query) ? $main_query : '', isset($rest_query) ? $rest_query : ''];

        /* Analyse
        if (isset($this::$router) && array_key_exists($index, $this::$router)) {
            if (count($queryPart) > 1) {
                print('sss');
                $routing = true;
                unset($queryPart[0]);
                $query = implode($queryPart, DS);
                if ($this::$router !== null) {
                    $_query = [$query => '@'.$this::$router[$index]];
                } else {
                    $_query = ['index' => '@'.$this::$router[$index]];
                }
            } else {
                unset($queryPart[0]);
                $query = implode($queryPart, DS);
                if (empty($index)) {
                    $_query = ['index' => '@'.$this::$router[$index]];
                } else {
                    $_query = [$queryPart[0] => '@'.$this::$router[$index]];
                }
            }
        } else {
            $query = implode($queryPart, DS);
            $_query = [$query => '@default'];
        }

        $query = key($_query);
        $namespace = current($_query);
        $template = $this->tools->findTemplate($namespace);
        $content_dir = APP_DIR;
        $count = count($queryPart);

        /* Search file
        if ($namespace === '@default' && !$routing) {
            $content_file = $content_dir.$query;
        } else {
            $content_dir = rtrim($template, '\/').DS.'views'.DS;
            $content_file = $content_dir.$query;
        }

        print($query);

        for($i = 0; $i < $count; $i++) {
            if (!empty(glob($content_file.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                $main_query = implode($queryPart, DS);
                $content_file = glob($content_file.'.{md,html,htm,twig,php}', GLOB_BRACE)[0];
                break;
            } else {
                unset($queryPart[$count - $i]);
                $main_query = implode($queryPart, DS);
                $content_file = $content_dir.$main_query;
            }
        }

        /* Try index dir else 404 not found file
        $index_file = glob(rtrim($content_file, '\/').DS.'index.{md,html,htm,twig,php}', GLOB_BRACE);
        $page_404 = glob(CONTENT_DIR.'404.{md,html,htm,php}', GLOB_BRACE);
        if (is_dir($content_dir.$query) && !empty($index_file)) {
            print($index_file[0]);
            $content_file = $index_file[0];
        } elseif (!empty($page_404) && file_exists($content_file) === false) {
            $content_file = $page_404[0];
        } elseif (empty($page_404)) {
            throw new \Exception('There is no 404 Page.', 164);
        }

        isset($main_query) ? $main_query = explode(DS, $main_query) : null;

        return [['index' => $index, 'main_query' => isset($main_query) ? end($main_query) : '', 'query' => $query], $content_file, $namespace, $template];*/
    }

    /**
     * Prepare Twig Environment
     */
    protected function initTwig()
    {
        $loader = new \Twig_Loader_Filesystem(APP_DIR);
        foreach($this->templates as $key => $val) {
            $loader->addPath($val['template'], $key);
            if (isset($val['views'])) {
                $loader->addPath($val['views'], $key.'_views');
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

        /* Process */
        $content_file = $router[0];
        $namespace = $router[1];
        $index = $router[2];
        $template_path = $router[3];
        $view_path = $router[4];
        $main_query = $router[5];
        $rest_query = $router[6];

        $ctrlArray = ['php', 'twig'];
        $fileExt = pathinfo($content_file)['extension'];
        $modular_twig = false;

        if (in_array($fileExt, $ctrlArray)) {
            if ($namespace === 'default') {
                $controller = "\\App\\Controller\\".$index."Ctrl";
                $maincontroller = "\\App\\Controller\\".$main_query."Ctrl";
            } else {
                $classRoot = explode('\\', str_replace(ROOT_DIR, '', $this->tools->findTemplate($this::$router[$index])));
                unset($classRoot[count($classRoot) - 1]);
                $classRoot = implode('\\', $classRoot);
                $controller = DS.$classRoot."\\Controller\\".$index."Ctrl";
                $maincontroller = DS.$classRoot."\\Controller\\".$main_query."Ctrl";
            }

            if (class_exists($controller)) {
                $controller = new $controller();
            }
            if (class_exists($maincontroller)) {
                $maincontroller = new $maincontroller();
            }

            if ($fileExt === 'php') {
                $content_file = include $content_file;
            } else {
                $modular_twig = true;
                $content_file = '@'.$namespace.'_views/'.str_replace($view_path, '', $content_file);
            }
        } elseif ($content_file = file_get_contents($content_file)) {
            $is_markdown = $fileExt === 'md' ? true : false;
        }
        $this->twig_vars = array_merge($this->twig_vars, array(
            'theme_url' => $this->tools->rooturl.$this->tools->SanitizeURL(str_replace(ROOT_DIR, '', $template_path)),
            'assets_url' => $this->tools->rooturl.$this->tools->SanitizeURL(str_replace(ROOT_DIR, '', $template_path).'assets'.DS),
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
            $output = $this->twig->render('@'.$namespace.'/default.twig', $this->twig_vars);
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
