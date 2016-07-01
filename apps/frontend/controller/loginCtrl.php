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
        var_dump($_POST);
        var_dump($_SESSION);
        if(isset($_POST['login'])) {
            $emailid = $_POST['emailid'];
            $password = $_POST['password'];

            $login = $this->login($emailid, $password);
            print($login);
        }
    }

    protected function login($emailid, $pass) {
        //$SessionArray = ['username','email','firstname','surname','avatar'];
        if (!isset($_SESSION['login_str'])) {
            $wanted_user;
            foreach ($this->config->getAllAccounts() as $key => $val){
                if(strcasecmp($emailid, $val['username']) === 0 || strcasecmp($emailid, $val['email']) === 0) {
                    $wanted_user = $key;
                    if (password_verify($pass, $this->config->getAccount($wanted_user)['pass_hash'])) {
                        $self_user = $this->config->getAccount($wanted_user);
                        $_SESSION['user_id'] = preg_replace("/[^0-9]+/", "", $wanted_user);
                        $_SESSION['username'] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $self_user['username']);
                        $_SESSION['email'] = $self_user['email']; //make regex
                        $_SESSION['firstname'] = preg_replace("/[^a-zA-Z\-]+/", "", $self_user['firstname']);
                        $_SESSION['surname'] = preg_replace("/[^a-zA-Z\-]+/", "", $self_user['surname']);
                        $_SESSION['avatar'] = $self_user['avatar'];
                        $_SESSION['login_str'] = hash('sha512', $self_user['pass_hash'].$_SERVER['HTTP_USER_AGENT']);
                        return true;
                    } else {
                        return "Mot de passe ou nom d'utilisateurs incorrect.";
                    }
                } else {
                    return "Mot de passe ou nom d'utilisateurs incorrect.";
                }
            }
        } else {
            return 'Vous ête déjà connecté.';
        }
    }

    protected function register() {
        //echo password_hash($pass, PASSWORD_DEFAULT);
    }
}
