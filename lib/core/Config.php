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

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class Config
{
    private static $_instance = null;

    private $settings = [];

    public function __construct() {
        try {
            $this->settings = Yaml::parse(file_get_contents(LIB_DIR.'config.yml'));
        } catch (ParseException $e) {
            throw new  \Exception("Unable to parse the YAML string: ".$e->getMessage(), 150);
        }
    }

     /**
     * Get All settings from config file
     *
     * @param  string $array
     */
    public function getAll()
    {
        return $this->settings;
    }

    /**
     * Get settings from config file
     *
     * @param  string $array
     *
     * @return string $value->$params
     */
    public function get($k)
    {
        if (!isset($this->settings[$k]))
        {
            return null;
        }
        return $this->settings[$k];
    }

    /**
     * Set settings to config file
     *
     * @param  string $array
     *
     * @return string $value->$params
     */
    public static function set_conf($array)
    {
        $value = (array)Yaml::parse(file_get_contents(LIB_DIR.'config.yml'));
        $array = array_merge($value, $array);
        $yaml = Yaml::dump($array, 2);
        file_put_contents(LIB_DIR.'config.yml', $yaml);
    }

    /** @return Return instance of Eayo class as singleton */
    public static function init()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Config();
        }
        return static::$_instance;
    }
}
