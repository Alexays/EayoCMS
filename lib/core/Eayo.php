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

        /* init Twig */
        $this->initTwig();
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
        $this->tools->template = array_merge($this->tools->template, ['default' => THEMES_DIR.Config::init()->get('themes').DS.'templates']);
        $query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
        if (($queryLength = strpos($query, '&')) !== false) {
            $query = substr($query, 0, $queryLength);
        }
        $query = strpos($query, '=') === false ? rawurldecode($query) : '';
        $query = trim($query, '/');

        $_query = [];
        $template = '';
        $file = '';
        $routing = false;

        if (empty($query)) {
            $_query = ['index' => $this->tools->findTemplate('default')];
        } else {
            $_queryPart = explode('/', $query);
            if (isset(Eayo::$router) && array_key_exists($_queryPart[0], Eayo::$router)) {
                $qPart = $_queryPart;
                unset($qPart[0]);
                $qPart = implode('/', $qPart);
                $_query = [empty($qPart) ? 'index' : $qPart => $this->tools->findTemplate($_queryPart[0])];
                $routing = true;
            } else {
                $_query = [implode('/', $_queryPart) => $this->tools->findTemplate('default')];
            }
        }
        $fileContent = glob(CONTENT_DIR.key($_query).'.{md,html,htm,twig,php}', GLOB_BRACE);
        $fileContent2 = glob($_query[key($_query)].DS.key($_query).'.{md,html,htm,twig,php}', GLOB_BRACE);
        if (!empty($fileContent) && !$routing) {
            $file = $fileContent[0];
        } elseif (!empty($fileContent2) && pathinfo($fileContent2[0])['filename'] !== 'default'){
            $file = $fileContent2[0];
        } else {
            $file = CONTENT_DIR.'404'.CONTENT_EXT;
        }
        $k_query = key($_query) === 'index' ? 'default' : key($_query);
        $fileTemplate = glob($_query[key($_query)].DS.$k_query.'.{twig,php}', GLOB_BRACE);
        if (empty($fileTemplate)) {
            $template = $_query[key($_query)].DS.'default.twig';
        } elseif ($routing) {
            $template = glob($_query[key($_query)].DS.'default'.".{twig,php}", GLOB_BRACE)[0];
        } else {
            $template = glob($_query[key($_query)].DS.$k_query.".{twig,php}", GLOB_BRACE)[0];
        }
        return [$file, str_replace(ROOT_DIR, '', $template)];
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

    public function Process($router)
    {
        $page = $router[0];
        $template = $router[1];

        $local_twig = clone($this->twig);
        $time_end = microtime(true);
        $time = number_format($time_end - PERF_START, 3);
        $output = '';
        $is_markdown = false;
        try {
            $fpage = fopen($page, 'r');
            switch (pathinfo($page)['extension']) {
                case 'php':
                    Eayo::$content = include $page;
                    break;
                case 'twig':
                    $page = str_replace(ROOT_DIR, '', $page);
                    Eayo::$content = $this->twig->render($page);
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
                'template' => $this->tools->rooturl.DS.pathinfo($template)['dirname'],
                'content' => Eayo::$content,
                'is_markdown' => $is_markdown
            ));
            $output = $local_twig->render($template, $this->twig_vars);
        } catch (\Twig_Error_Loader $e) {
            throw new \Exception($e->getRawMessage(), 4054);
        }

        return $output;
    }

    public function login($emailid, $pass) {
        //if (!isset($_SESSION['login_str'])) {
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
        /*} else {
            return 'Vous ête déjà connecté.';
        }*/
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
