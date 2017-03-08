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

namespace Apps\Frontend\Controller;

defined('EAYO_ACCESS') || exit('No direct script access.');

use Core\Controller;

class loginCtrl extends Controller
{
    public function __construct() {
        parent::__construct();
        if(isset($_POST['login'])) {
            $emailid = $_POST['emailid'];
            $password = $_POST['password'];

            $login = $this->login($emailid, $password);
            print($login);
        }
    }

    protected function register() {
        /**echo password_hash(base64_encode(
        hash('sha256', $_POST['password'], true)
            ), PASSWORD_DEFAULT);**/
    }
}
