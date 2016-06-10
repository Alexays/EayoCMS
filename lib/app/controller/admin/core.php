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

namespace App\Ctrl\Admin;

defined('EAYO_ACCESS') OR exit('No direct script access.');

class Core
{
     /** @var core An instance of the Eayo class */
    protected static $_instance = null;

    protected function __construct()
    {
    }

    /** @return Return instance of Eayo class as singleton */
    public static function init()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Core();
        }
        return static::$_instance;
    }
}
