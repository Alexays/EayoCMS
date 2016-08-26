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

class Eayo
{

    /** @var core An instance of the Eayo class */
    protected static $instance = null;

    /** Version de Eayo */
    const VERSION = '0.0.3';

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

    protected $router = [];

    protected $requestUrl;

    protected $requestTemplate;

    protected $requestFile;

    public static $apps = [];

    public static $templates = [];

    public $CurApp = '';

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
     * @author Alexis Rouillard
     */
    protected function __construct()
    {
        // Turn on output buffering
        //substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ? ob_start("ob_gzhandler") : ob_start();

        // Define App definitions
        defined('LIB_DIR') || define('LIB_DIR', ROOT_DIR . 'lib' . DS);
        defined('APPS_DIR') || define('APPS_DIR', ROOT_DIR . 'apps' . DS);
        defined('CONF_DIR') || define('CONF_DIR', ROOT_DIR . 'config' . DS);
        defined('CONTENT_DIR') || define('CONTENT_DIR', APPS_DIR . 'views' . DS);
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

        $this->initSession();
    }

    /**
     * Run Eayo process
     * @author Alexis Rouillard
     * @return string Content
     */
    public function run()
    {
        /* Init Plugins */
        $this->loadPlugins();

        /* Init App */
        $this->initApp();

        /* Init Twig */
        $this->InitTwig();

        /* Init Page */
        $this->page = Core\Page::init();

        $this->Analyse();

        $this->Discover();

        return $this->Process();
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
                }/* else {
                    throw new \Exception("Cannot find '".$fileName."'.", 15878);
                }*/
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

    protected function initSession()
    {
        session_start();

        if (isset($_COOKIE['eayo_login']) && !isset($_SESSION['login_token'])) {
            list($lookup, $validator) = explode(':', $_COOKIE['eayo_login']);
            $accounts = $this->config->getAllAccounts();
            if (($user_id = $this->tools->recursive_array_search($lookup, $accounts)) && $user_id[1] === 'token') {
                $user_id = $user_id[0];
                if (isset($accounts[$user_id]['tok_val']) && $accounts[$user_id]['tok_val'] === hash_hmac('sha256', $validator, $this->tools->ip()) && ($user = $this->config->getAccount($user_id))) {
                    //Now we can create Session
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $user['username'] = preg_replace("/[^a-zA-Z0-9_\-]+/", '', $user['username']);
                    $_SESSION['email'] = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
                    $_SESSION['firstname'] = preg_replace("/[^a-zA-Z\-]+/", '', ucfirst(strtolower($user['firstname'])));
                    $_SESSION['lastname'] = preg_replace("/[^a-zA-Z\-]+/", '', ucfirst(strtolower($user['lastname'])));
                    $_SESSION['avatar'] = filter_var($user['avatar'], FILTER_SANITIZE_URL);
                    $_SESSION['login_token'] = base64_encode(time().':'.$this->tools->ip());
                    $lookup = bin2hex(openssl_random_pseudo_bytes(9));
                    $validator = base64_encode((openssl_random_pseudo_bytes(18)));
                    $accounts[$user_id]['token'] = $lookup;
                    $accounts[$user_id]['tok_val'] = hash_hmac('sha256', $validator, $this->tools->ip());
                    setcookie(
                        'eayo_login',
                        $lookup . ':' . $validator,
                        time() + 604800
                    );
                    file_put_contents(CONF_DIR.'accounts.yml', Yaml::dump($accounts, 4));
                }
            }
        }

        // Make sure we have a canary set
        if (!isset($_SESSION['canary'])) {
            session_regenerate_id(true);
            $_SESSION['canary'] = [
                'birth' => time(),
                'IP' => $_SERVER['REMOTE_ADDR']
            ];
        }
        if ($_SESSION['canary']['IP'] !== $_SERVER['REMOTE_ADDR']) {
            session_regenerate_id(true);
            // Delete everything:
            foreach (array_keys($_SESSION) as $key) {
                unset($_SESSION[$key]);
            }
            $_SESSION['canary'] = [
                'birth' => time(),
                'IP' => $_SERVER['REMOTE_ADDR']
            ];
        }
        // Regenerate session ID every five minutes:
        if ($_SESSION['canary']['birth'] < time() - 300) {
            session_regenerate_id(true);
            $_SESSION['canary']['birth'] = time();
        }
    }

    /**
     * Init App function
     */
    protected function initApp()
    {
        //FRENCH
        setlocale(LC_ALL, 'fr_FR');
        //ROUTER
        foreach(glob(APPS_DIR.'*', GLOB_ONLYDIR) as $APPS_DIR) {
            $app = str_replace(APPS_DIR, '', $APPS_DIR);
            $app_conf_file = $APPS_DIR.DS.'config.yml';
            if (file_exists($app_conf_file)) {
                $app_conf = Yaml::parse(file_get_contents($app_conf_file));
            } else {
                $app_conf = ['name' => $app];
            }
            $this::$apps = array_merge($this::$apps, [$app => isset($app_conf) ? $app_conf : null]);
            $this->router = array_merge($this->router, [isset($app_conf['route']) ? $app_conf['route'] : $app => $app]);
        }
        $this->router = array_merge($this->router, ['login' => 'default']);
        $this->router = array_merge($this->router, ['register' => 'default']);

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
                $template_tmp = array_merge_recursive($template_tmp, ['apps' => [$key => APPS_DIR.$key.DS.$val['template']]]);
            } else {
                if (isset($val['default']) && $val['default'] === true) {
                    $default_template = array_merge($default_template, [$key]);
                }
                $template_tmp = array_merge_recursive($template_tmp, ['apps' => [$key => APPS_DIR.$key.DS.$default_template_path]]);
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
     * Load Plugins
     * @author Alexis Rouillard
     */
    protected function loadPlugins()
    {
        $loadPlugin = \Core\Plugin::init();
        $plugins = $this->config->get('plugins');
        if (isset($plugins) && is_array($plugins)) {
            $this->plugins = $loadPlugin->loadAll($plugins);
        }
    }

    /**
     * Initialize Twig Environment
     * @author Alexis Rouillard
     */
    protected function initTwig()
    {
        $loader = new \Twig_Loader_Filesystem(APPS_DIR);
        //For apps & plugins
        $templates = $this::$templates;
        $loader->addPath($templates['apps'][$templates['default']], 'default');
        unset($templates['default']);
        foreach($templates as $origin => $namespaces) {
            foreach($namespaces as $namespace => $template) {
                $loader->addPath($template, $namespace);
                if($origin === 'apps') {
                    $loader->addPath(APPS_DIR.$namespace.DS.'views'.DS, $namespace.'_views');
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
        $this->twig->addExtension(new \Twig_Extension_Optimizer());
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $conf = $this->config->getAll();
        unset($conf['twig']);
        $this->twig_vars = array_merge($this->twig_vars, array(
            'version' => $this::VERSION,
            'config' => $conf,
            'user' => isset($_SESSION['user_id']) ? $_SESSION : null
        ));
    }

    /**
     * Discover the requested Url
     * @author Alexis Rouillard
     */
    public function Analyse()
    {
        $content_file;
        $template_file;

        $uri = str_replace($this->tools->rootpath, '', $this->tools->uri);

        if (($pos = strpos($uri, ':')) !== FALSE) {
            $params = substr($uri, $pos+1);
            $query = strtok($uri, ':');
        } else {
            $query = $uri;
            $params = '';
        }

        $queryPart = explode('/', trim($query, '/'));

        $queryLength = count($queryPart);
        $index = empty($queryPart[0]) ? null : $queryPart[0];
        $main = $queryPart[count($queryPart) - 1];
        $main = $main === $index ? 'index' : $main;
        $query = implode($queryPart, DS);

        if (isset($this->router) && ($router = array_change_key_case($this->router)) && array_key_exists(strtolower($index), $router)) {
            $this->requestTemplate = $router[strtolower($index)];
            $this->CurApp = array_search($this->requestTemplate, $this->router);
            if ($this->requestTemplate === 'default') {
                $query = empty($_query = $query) ? 'index' : $_query;
            } else {
                $query = empty($_query = str_replace($index, '', $query)) ? 'index' : $_query;
            }
        } else {
            $this->requestTemplate = 'default';
        }

        $this->requestUrl = [$query, $main, $index, $params];
    }

    /**
     * Discover the requested file
     * @author Alexis Rouillard
     */
    public function Discover()
    {
        list($template_origin, $template_path, $template_name) = $this->tools->findTemplate($this->requestTemplate);
        $this->CurApp = empty($this->CurAPP) ? $template_name : $this->CurApp;
        if ($template_origin === 'apps') {
            defined('APP_DIR') || define('APP_DIR', APPS_DIR.$this->CurApp . DS);
        } elseif ($template_origin === 'plugins') {
            defined('APP_DIR') || define('APP_DIR', PLUGINS_DIR.$this->CurApp . DS);
        } else {
            throw new \Exception('Orgine du template inconnue.', 894);
        }

        $view_path = APP_DIR.'views';
        $content_path = $view_path.DS.$this->requestUrl[0];
        $is_views = false;

        if (isset($this->router) && array_key_exists($this->requestUrl[2], $this->router) && !empty($q = glob($template_path.$this->requestUrl[0].'.{md,html,htm,twig,php}', GLOB_BRACE)) || is_dir($template_path.$this->requestUrl[0]) && !empty($q = glob($template_path.$this->requestUrl[0].DS.'index.{md,html,htm,twig,php}', GLOB_BRACE))) {
            $content_file = $q[0];
        } elseif (!empty($q = glob($content_path.'.{md,html,htm,twig,php}', GLOB_BRACE)) || is_dir($content_path) && !empty($q = glob($content_path.DS.'index.{md,html,htm,twig,php}', GLOB_BRACE))) {
            $is_views = $view_path;
            $content_file = $q[0];
        } else {
            $template_path_404 = array_values($this->tools->findTemplate('default'))[1];
            if(!empty($q = glob($template_path.'404.{md,html,htm,php}', GLOB_BRACE))) {
                $content_file = $q[0];
            } elseif (!empty($q = glob($template_path_404.'404.{md,html,htm,php}', GLOB_BRACE))) {
                $content_file = $q[0];
            } else {
                throw new \Exception('Impossible de trouver le fichier 404 not found');
            }
        }

        $this->requestFile = [$content_file, $template_path, $is_views, $this->requestUrl[1], $this->requestUrl[3]];
    }

    /**
     * Process the requested file
     * @author Alexis Rouillard
     * @return string Content
     */
    public function Process()
    {
        list($content_file, $template_path, $is_views, $main, $params) = $this->requestFile;
        $fileExt = pathinfo($content_file)['extension'];
        $classRoot = str_replace('/', '\\', $this->tools->Sanitize('/'.str_replace(ROOT_DIR, '', APP_DIR).'/Controller/', true));
        if (strtolower($this->requestUrl[2]) !== strtolower($this->CurApp)) {
            $indexController = $classRoot.$this->requestUrl[2].'Ctrl';
            $this->twig_vars[$this->requestUrl[2]] = $indexController = class_exists($indexController) ? new $indexController() : null;
        }
        $appController = $classRoot.$this->CurApp.'Ctrl';
        $pageController = $classRoot.$main.'Ctrl';
        $this->twig_vars[$this->CurApp] = $appController = class_exists($appController) ? new $appController() : null;
        $this->twig_vars[$main] = $pageController = class_exists($pageController) ? new $pageController() : null;
        $this->twig_vars['params'] = $this->requestUrl[3];
        $page = ['page' => $content_file,
                 'template' => $this->requestTemplate,
                 'template_path' => $template_path,
                 'ext' => $fileExt,
                 'is_views' => $is_views
                ];
        if (empty($_POST)) {
            $this->twig->addExtension(new Core\TwigExtension($this, $page));
            return $this->page->Process($this, $page);
        }
    }

    /**
     * Initalize Eayo App
     * @author Alexis Rouillard
     * @return object EayoClass
     */
    public static function init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Eayo();
        }
        return self::$instance;
    }

}
