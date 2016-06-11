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

    public $plugins = array();

    public function addPlugin($path, $class, $url)
    {
        $tmpPlugin = array($url, $class);
        $array = $this->set_element($tmpPlugin, $path);
        if (isset($this->plugin)) {
            $this->page = array_merge($this->plugins, $array);
            return;
        }
        $this->plugins = $array;
        return;
    }

    public function set_element(&$path, $data) {
        return ($key = array_pop($path)) ? $this->set_element($path, array($key=>$data)) : $data;
    }

    /** @return Return instance of Eayo class as singleton */
    public static function init()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Plugin($core);
        }
        return static::$_instance;
    }
}
