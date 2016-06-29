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
        defined('UPLOAD_DIR') || define('UPLOAD_DIR', APP_DIR . 'uploads' . DS);
        defined('CONTENT_EXT') || define('CONTENT_EXT', '.md');
        defined('PLUGINS_DIR') || define('PLUGINS_DIR', ROOT_DIR . 'plugins' . DS);
        defined('THEMES_DIR') || define('THEMES_DIR', ROOT_DIR . 'themes' . DS);
        defined('CACHE_DIR') || define('CACHE_DIR', LIB_DIR . 'cache' . DS);
        defined('STORAGE_DIR') || define('STORAGE_DIR', LIB_DIR . 'datastorage' . DS);

        /** Set Eayo Environment */
        Eayo::$environment = Eayo::DEVELOPMENT;

        /* Init Session */
        $this->sessionStart();

        /** Load Core file */
        $this->__autoload();

        /* Init Config API */
        $this->config = Config::init();

        /* Init Tools API*/
        $this->tools = Tools::init();

        /* Init Admin */
        new Admin\Core();

        /* Init Plugins API*/
        $this->initPlugins();

        /* Init default Route */
        $this->initRoute();
    }

    /** Initialize the autoloader */
    protected function __autoload()
    {
        //spl_autoload_extensions(".php");
        spl_autoload_register(
            function ($className) {
                $fileName = LIB_DIR . str_replace("\\", DS, $className) . '.php';
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

    public function Router()
    {
        $_query = [];
        $content_file;
        $template_file;
        $routing = false;

        $query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
        $queryLength = strpos($query, '&') !== false ? $query = substr($query, 0, $queryLength) : '';
        $queryPart = explode('/', $query);
        $index = empty($queryPart) ? '' : $queryPart[0];
        if (count($queryPart) > 1) {
            if (isset(Eayo::$router) && array_key_exists($index, Eayo::$router)) {
                $routing = true;
                unset($queryPart[0]);
                $query = implode($queryPart, DS);
                if (Eayo::$router[$index] === true) {
                    $_query = [$index => '@default'];
                } else {
                    $_query = [$query => '@'.$index];
                }
            } else {
                $query = implode($queryPart, DS);
                $_query = [$query => '@default'];
            }
        } else {
            if (empty($query)) {
                $_query = ['index' => '@default'];
            } else {
                $_query = [$index => '@default'];
            }
        }

        $query = key($_query);
        $namespace = current($_query);
        $template = $this->tools->findTemplate($namespace);
        $content_dir = CONTENT_DIR;

        if ($namespace === '@default' && !$routing) {
            $content_file = $content_dir.$query;
        } else {
            $content_dir = rtrim($template, '\/').DS.'views'.DS;
            $content_file = $content_dir.$query;
        }

        $count = count($queryPart);
        for($i = 0; $i <= $count; $i++) {
            if (!empty(glob($content_file.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                $content_file = glob($content_file.'.{md,html,htm,twig,php}', GLOB_BRACE)[0];
                break;
            } else {
                unset($queryPart[$count - $i]);
                $main_query = implode($queryPart, DS);
                $content_file = $content_dir.$main_query;
            }
        }
        $index_file = glob(rtrim($content_file, '\/').DS.'index.{md,html,htm,twig,php}', GLOB_BRACE);
        $page_404 = glob(CONTENT_DIR.'404.{md,html,htm,php}', GLOB_BRACE);
        if (is_dir($content_dir.$query) && !empty($index_file)) {
            $content_file = $index_file[0];
        } elseif (!empty($page_404) && file_exists($content_file) === false) {
            $content_file = $page_404[0];
        } elseif (empty($page_404)) {
            throw new \Exception('There is no 404 Page.', 164);
        }

        isset($main_query) ? $main_query = explode(DS, $main_query) : null;

        return [['index' => $index, 'main_query' => isset($main_query) ? end($main_query) : '', 'query' => $query], $content_file, $namespace, $template];
    }

    /**
     * Prepare Twig Environment
     */
    protected function initTwig($template, $namespace)
    {
        $loader = new \Twig_Loader_Filesystem(CONTENT_DIR);

        $loader->addPath($template, $namespace);

        $twigConf = $this->config->get('twig');
        $twigConf['cache'] = $twigConf['cache'] === true ? LIB_DIR.'cache'.DS : false;

        $this->twig = new \Twig_Environment($loader, $twigConf);
        $this->twig->addExtension(new \Jralph\Twig\Markdown\Extension(
            new \Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown
        ));
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig_vars = array_merge($this->twig_vars, array(
            'version' => Eayo::VERSION,
            'config' => $this->config->getAll(),
            'base_url' => $this->tools->rooturl,
            'uploads_url' => $this->tools->rooturl.str_replace(ROOT_DIR, '', UPLOAD_DIR),
            'user' => isset($_SESSION) ? $_SESSION : null
        ));
    }

    /**
     * Prepare default Route
     */
    protected function initRoute()
    {
        $this->tools->AddRoute('login', true);
        $this->tools->template = empty($this->tools->template) ? array('@default' => THEMES_DIR.$this->config->get('theme').DS.'templates'.DS) : array_merge($this->tools->template, array('@default' => THEMES_DIR.$this->config->get('theme').DS.'templates'.DS));
    }

    /**
     * Return template and content
     *
     * @return $output
     */
    public function Process($router)
    {
        $index = $router[0]['index'];
        $content_file = $router[1];
        $namespace = ltrim($router[2], '@');
        $template = $router[3];
        $query = $router[0]['query'];
        $main_query = $router[0]['main_query'];

        $ctrlArray = ['php', 'twig'];
        $fileExt = pathinfo($content_file)['extension'];
        $is_markdown = false;
        $modular_twig = false;
        $controller = null;

        $this->InitTwig($template, $namespace);
        if (in_array($fileExt, $ctrlArray)) {
            if ($namespace === 'default') {
                $controller = "\\App\\Controller\\".$index."Ctrl";
                $maincontroller = "\\App\\Controller\\".$main_query."Ctrl";
            } else {
                $classRoot = explode('\\', Eayo::$router[$index]);
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
                $content_file = '@'.$namespace.'/'.str_replace($template, '', $content_file);
            }
        } elseif ($content_file = file_get_contents($content_file)) {
            $is_markdown = $fileExt === 'md' ? true : false;
        }
        $this->twig_vars = array_merge($this->twig_vars, array(
            'theme_url' => $this->tools->rooturl.$this->tools->SanitizeURL(str_replace(ROOT_DIR, '', $template.DS)),
            'assets_url' => $this->tools->rooturl.$this->tools->SanitizeURL(dirname(str_replace(ROOT_DIR, '', $template)).DS.'assets'.DS),
            'mainCtrl' => isset($maincontroller) ? $maincontroller : null,
            'ctrl' => $controller,
            'is_markdown' => $is_markdown,
            'load_time' => number_format(microtime(true) - PERF_START, 3)
        ));
        Eayo::$content = $content_file;
        try {
            //Process in-page tiwg
            if ($modular_twig) {
                $this->twig_vars['content'] = $this->twig->render(Eayo::$content, $this->twig_vars);
            } else {
                $this->twig_vars['content'] = Eayo::$content;
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
            self::$_instance = new Eayo();
        }
        return static::$_instance;
    }

}
