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

    public $self_user;

    public static $router = [];

    public $twig;

    public $twig_loader;

    public $twig_vars = [];

    /** @access  protected clone method */
    protected function __clone()
    {
        // Nothing here.
    }

    protected function __construct()
    {
        // Local
        date_default_timezone_set('Europe/Paris');

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

        /* Init Session */
        $this->sessionStart();

        /** Load Core file */
        $this->__autoload();

        /* Init Config API */
        $this->config = Config::init();

        /* Init Tools API*/
        $this->tools = Tools::init();

        /* Init Admin */
        new Admin\Core;

        /* Init Plugins API*/
        $this->initPlugins();

        /* Init default Route */
        $this->initRoute();
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

        //Prepare Query
        if (count($queryPart) > 1) {
            if (isset(Eayo::$router) && array_key_exists($index, Eayo::$router)) {
                $routing = true;
                unset($queryPart[0]);
                $query = implode($queryPart, '/');
                if (Eayo::$router[$index] === true) {
                    $_query = [$index => '@default'];
                } else {
                    $_query = [$query => '@'.$index];
                }
            } else {
                $query = implode($queryPart, '/');
                $_query = [$query => '@default'];
            }
        } else {
            if (empty($query)) {
                $_query = ['index' => '@default'];
            } else {
                $_query = [$index => '@default'];
            }
        }

        //Understand Query
        $query = key($_query);
        $namespace = current($_query);
        $template = $this->tools->findTemplate($namespace);
        $content_dir = CONTENT_DIR;

        if ($namespace === '@default' && !$routing) {
            $content_file = $content_dir.$query;
            if (is_dir($content_dir.$query)) {
                $content_file .= '\index';
            }
        } else {
            $content_dir = rtrim($template, '\/').DS.'views'.DS;
            $content_file = $content_dir.$query;
            if (is_dir($content_dir.$query)) {
                $content_file .= 'index';
            }
        }

        //Attribute File Extension
        $content_file = glob($content_file.'.{md,html,htm,twig,php}', GLOB_BRACE);
        if (!empty($content_file)) {
            $content_file = $content_file[0];
        } else {
            $content_file = glob(CONTENT_DIR.'404.{md,html,htm,php}', GLOB_BRACE)[0];
        }

        return [$content_file, $namespace, $template];
    }

    /**
     * Prepare Twig Environment
     */
    protected function initTwig($template)
    {
        $this->twig_loader = new \Twig_Loader_Filesystem($template);

        $this->twig = new \Twig_Environment($this->twig_loader, $this->config->get('twig'));
        $this->twig->addExtension(new \Jralph\Twig\Markdown\Extension(
            new \Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown
        ));
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig_vars = array_merge($this->twig_vars, array(
            'version' => Eayo::VERSION,
            'config' => $this->config->getAll(),
            'base_url' => $this->tools->rooturl,
            'user' => $this->self_user
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

    public function Process($router)
    {
        $page = $router[0];
        $namespace = ltrim($router[1], '@');
        $template = $router[2];
        $this->InitTwig($template);
        $this->twig_loader->setPaths($template, $namespace);

        $time_end = microtime(true);
        $time = number_format($time_end - PERF_START, 3);
        $is_markdown = false;
        try {
            $fpage = fopen($page, 'r');
            switch (pathinfo($page)['extension']) {
                case 'php':
                    Eayo::$content = include $page;
                    break;
                case 'twig':
                    Eayo::$content = $this->twig->render(str_replace($template, '', $page));
                    break;
                case 'html':
                    $page = fread($fpage, filesize($page));
                    Eayo::$content = $page;
                    break;
                case 'md':
                    $page = fread($fpage, filesize($page));
                    Eayo::$content = $page;
                    $is_markdown = true;
                    break;
            }
            fclose($fpage);
            $this->twig_vars = array_merge($this->twig_vars, array(
                'load_time' => $time,
                'template' => $this->tools->rooturl.'/'.str_replace(ROOT_DIR, '', $template),
                'content' => Eayo::$content,
                'is_markdown' => $is_markdown
            ));
            $output = $this->twig->render('@'.$namespace.'/default.twig', $this->twig_vars);
        } catch (\Twig_Error_Loader $e) {
            throw new \Exception($e->getRawMessage(), 4054);
        }

        return $output;
    }

    public function login($emailid, $pass) {
        if (!isset($_SESSION['login_str'])) {
            $wanted_user;
            foreach ($this->config->getAllAccounts() as $key => $val){
                if(strcasecmp($emailid, $val['username']) === 0 || strcasecmp($emailid, $val['email']) === 0) {
                    $wanted_user = $key;
                }
            }
            if (password_verify($pass, $this->config->getAccount($wanted_user)['pass_hash'])) {
                $this->self_user = $this->config->getAccount($wanted_user);
                $_SESSION['user_id'] = preg_replace("/[^0-9]+/", "", $wanted_user);
                $_SESSION['username'] = preg_replace("/[^a-zA-Z0-9_\-]+/",
                                                     "",
                                                     $this->self_user['username']);
                $_SESSION['login_str'] = hash('sha512', $this->self_user['pass_hash'].$_SERVER['HTTP_USER_AGENT']);
                return true;
            } else {
                return false;
            }
        } else {
            return 'Vous ête déjà connecté.';
        }
    }

    public function register() {
        //echo password_hash($pass, PASSWORD_DEFAULT);
    }

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
