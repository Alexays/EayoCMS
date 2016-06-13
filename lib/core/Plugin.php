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

class Plugin
{
    protected static $_instance = null;

    public $plugins = [];

    public function __construct()
    {
        //$this->__autoload();
    }

    public function loadAll($plug)
    {
        foreach(glob(PLUGINS_DIR.'*', GLOB_ONLYDIR) as $dirPlugin) {
            $dirPlugin = str_replace(PLUGINS_DIR, '', $dirPlugin);
            list($name, $author) = explode('@', $dirPlugin);
            if(array_key_exists($dirPlugin, Config::init()->get('plugins'))) {
                $confPlug = Config::init()->get('plugins');
                if(isset($confPlug[$dirPlugin]['active']) && $confPlug[$dirPlugin]['active'] === true) {
                    $plugClass = '\\Plugins\\'.$author.'\\'.$name;
                    $plugin = new $plugClass;
                }
            }
            $this->plugins = array_merge($this->plugins, array($dirPlugin => $plugin));
        }
        return $this->plugins;
    }

    /*public function addPlugin($path, $class, $url)
    {
        $tmpPlugin = array($url, $path);
        $class = new $class;
        $array = $this->set_element($tmpPlugin, $class);
        if (isset($this->plugin)) {
            $this->plugin = array_merge($this->plugins, $array);
            return;
        }
        $this->plugins = $array;
        return;
    }*/

    public function set_element(&$path, $data) {
        return ($key = array_pop($path)) ? $this->set_element($path, array($key=>$data)) : $data;
    }

    public static function autoload($className)
    {
        //$className = substr($className, 13);
        $fileName = str_replace('Plugins\\', '', $className);
        list($author, $name) = explode('\\', $fileName);
        $fileName = PLUGINS_DIR . implode('@', array($name, $author)) . DS . $name . '.php';
        if (file_exists($fileName)) {
            include $fileName;
        }
    }

    /** @return Return instance of Eayo class as singleton */
    public static function init()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Plugin();
        }
        return static::$_instance;
    }
}
