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

namespace Plugins\EayoCMS;

defined('EAYO_ACCESS') OR exit('No direct script access.');

class Admin
{
    //Name of plugin
    public $name = 'admin';

    //Template for admin
    public $template = __DIR__.DS.'public';

    public function __construct()
    {
        \Core\Tools::AddRoute('admin', get_called_class());
    }
}
