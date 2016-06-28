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

namespace Core\Admin\Controller;

defined('EAYO_ACCESS') OR exit('No direct script access.');

use Core\Controller\Controller;

class adminCtrl extends Controller
{
    public function __construct() {
        parent::__construct();
        /* Check Login Status */
        if (!isset($_SESSION['login_str'])) {
            header('location: '.$this->tools->rooturl.'login/');
        }
    }

    public function userList() {
        return \Core\Config::init()->getAllAccounts();
    }
}
