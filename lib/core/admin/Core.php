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

namespace Core\Admin;

defined('EAYO_ACCESS') OR exit('No direct script access.');

class Core
{

    public function __construct()
    {
        \Core\Tools::AddRoute('admin', get_called_class());
        \Core\Tools::init()->template = array('@'.$this->PluginDetails()['name'] => LIB_DIR.'core'.DS.'admin'.DS.'template');
    }

    public function PluginDetails()
    {
        return [
            'name' => 'admin',
            'description' => 'Admin Plugin',
            'author' => 'EayoCMS / Alexis Rouillard',
            'template' => __DIR__.DS.'assets'
        ];
    }

    public static function render() {
        /* Check Login Status */
        if (isset($_SESSION['login_string'])) {
            header('location: '.\Core\Tools::init()->rooturl.'/login/');
        }
    }
}
