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

namespace Core\Controller;

defined('EAYO_ACCESS') OR exit('No direct script access.');

class Controller
{
    protected $config = null;
    protected $tools = null;

    public function __construct() {
        $this->config = \Core\Config::init();
        $this->tools = \Core\Tools::init();
    }

}
