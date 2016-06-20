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

class Tools
{
    private static $_instance = null;

    const HOSTNAME_REGEX = '/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/';

    public $url;

    public $template = [];

    public function __construct()
    {
        $this->scheme = $this->GetScheme();
        $this->name = $this->GetHostname();
        $this->port = $this->GetPort();
        $this->uri = $this->GetUri();
        $this->rootpath = $this->GetRootPath();
        $this->rooturl = $this->GetRootUrl();

        /* Sanitize URL to prevent XSS */
        $this->SanitizeURL();
    }

    /**
     * Return the Scheme
     *
     * @return string scheme
     */
    private static function GetScheme()
    {
        return isset($_SERVER['HTTPS']) ? strtolower(@$_SERVER['HTTPS']) == 'on' ? 'https://' : 'http://' : 'http://';
    }

    /**
     * Return the hostname
     *
     * @return string hostname
     */
    private function GetHostname()
    {
        $hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
        // Remove port from HTTP_HOST generated $hostname
        $hostname = $this->substrToString($hostname, ':');
        // Validate the hostname
        $hostname = (bool)preg_match(Tools::HOSTNAME_REGEX, $hostname) ? $hostname : 'unknown';
        return $hostname;
    }

    /**
     * Return the port
     *
     * @return string port
     */
    private static function GetPort()
    {
        $port = isset($_SERVER['SERVER_PORT']) ? (string)$_SERVER['SERVER_PORT'] : '80';
        return $port;
    }

    /**
     * Return the URI
     *
     * @return string uri
     */
    private static function GetUri()
    {
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        return rawurldecode($uri);
    }

    /**
     * Return the Base url like http://127.0.0.1
     *
     * @return string baseurl
     */
    private function GetBaseUrl()
    {
        return $this->scheme . $this->name;
    }

    /**
     * Return the Root path like 'data/cms'
     *
     * @return string rootpath
     */
    public function GetRootPath()
    {
        $root_path = str_replace(' ', '%20', rtrim(substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php')), '/'));
        return strpos($this->uri, '/~') !== false && strpos($_SERVER['PHP_SELF'], '/~') === false ?  substr($this->uri, 0, strpos($this->uri, '/', 1)) . $root_path : $root_path;
    }

    /**
     * Return the Root url like http://127.0.0.1/cms
     *
     * @return string rooturl
     */
    private function GetRootUrl()
    {
        return $this->scheme . $this->name . $this->rootpath;
    }

    /**
     * Returns the substring of a string up to a specified needle.  if not found, return the whole haytack
     *
     * @param $haystack
     * @param $needle
     *
     * @return string
     */
    protected static function substrToString($haystack, $needle)
    {
        return static::contains($haystack, $needle) ? substr($haystack, 0, strpos($haystack, $needle)) : $haystack;
    }

    /**
     * Check if the $haystack string contains the substring $needle
     *
     * @param  string $haystack
     * @param  string $needle
     *
     * @return bool
     */
    protected static function contains($haystack, $needle)
    {
        return $needle === '' || strpos($haystack, $needle) !== false;
    }

    /**
     * Return the IP address of the current user
     *
     * @return string ip address
     */
    public static function ip()
    {
        $_instance = self::init();

        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * Return the safe url
     *
     * @return string url
     */
    public function SanitizeURL($_url = '')
    {
        $_url = trim($_url === '' ? $this->name.$this->uri : $_url);
        $_url = rawurldecode($_url);
        $_url = str_replace(array('--', '&quot;', '!', '@', '#', '$', '%', '^', '*', '(', ')', '+', '{', '}', '|', ':', '"', '<', '>',
                                  '[', ']', '\\', ';', "'", ',', '*', '+', '~', '`', 'laquo', 'raquo', ']>', '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8211;', '&#8212;'),
                            array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
                            $_url);
        $_url = str_replace('--', '-', $_url);
        $_url = rtrim($_url, "-");
        $_url = str_replace('..', '', $_url);
        $_url = str_replace('//', '', $_url);
        //$_url = preg_replace('/^/', '', $_url);
        $_url = preg_replace('/^\./', '', $_url);

        if (!isset($this->url))
        {
            $this->url = $this->scheme.$_url;
        }
        return $_url;
    }

    public function findTemplate($route = null) {
        foreach (Eayo::$router as $key => $val) {
            $this->template = array_merge($this->template, [$key => (new $val)->template]);
        }
        return isset($route) && $route !== null ? isset($key) && $key !== null ? $this->template[$route] : $this->template['default'] : $this->template;
    }

    public static function AddRoute($url, $class)
    {
        $array = [$url => $class];
        Eayo::$router = array_merge($array, Eayo::$router);
    }

    public function getContent($file)
    {
        if(pathinfo($file, PATHINFO_EXTENSION) === ltrim(CONTENT_EXT, '.')) {
            return ['md' => $file];
        } elseif(pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            return ['php' => $file];
        } elseif(pathinfo($file, PATHINFO_EXTENSION) === 'twig') {
            return ['twig' => str_replace(ROOT_DIR, '', $file)];
        } elseif(pathinfo($file, PATHINFO_EXTENSION) === 'html') {
            return ['html' => $file];
        }
    }

    /** @return Return instance of Eayo class as singleton */
    public static function init()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Tools();
        }
        return self::$_instance;
    }
}
