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

class Admin
{
    protected $uri = 'admin';

    public $template = APP_DIR.DS.'admin'.DS;

    public function __construct()
    {
        Tools::init()->addPage(APP_DIR.'controller'.DS.'admin'.DS.'core.php', get_class($this), $this->uri); //same as futur plugins api
    }

    public function __load()
    {
        die ('ss');
        //\Core\Eayo->content = "test";
    }
}
