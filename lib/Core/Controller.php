<?php
/**
  * This file is part of EayoCMS.
  *
  * @package EayoCMS
  * @author Alexis Rouillard / Alexays <contact@arouillard.fr>
  * @link http://arouillard.fr
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

namespace Core;

defined('EAYO_ACCESS') || exit('No direct script access.');

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class Controller
{
    protected static $needLogin = false;

    protected $config = null;
    protected $tools = null;

    public function __construct()
    {
        $this->config = \Core\Config::init();
        $this->tools = \Core\Tools::init();
        static::$needLogin ? $this->checkLogin() : '';
    }

    /**
     * Check if users is logged
     * @author Alexis Rouillard
     */
    protected function checkLogin()
    {
        if (!isset($_SESSION['login_token'])) {
            header('location: '.$this->tools->rooturl.'login/:url=' . $this->tools->fullurl);
            return false;
        }
        return true;
    }

    /**
     * Login function
     * @author Alexis Rouillard
     * @param  string $emailid ID or E-mail
     * @param  string $pass    Password
     * @return string   Login message.
     */
    protected function login($emailid, $pass)
    {
        // Check if is already logged
        if (!isset($_SESSION['login_token'])) {
            //Get all accounts id
            $accounts = $this->config->getAllAccounts();
            //Transfrom to lowercase
            array_walk_recursive($accounts, function (&$item, $key) {
                $item = strtolower($item);
            });
            //Check if users exists & return id
            if ($user_id = $this->tools->recursive_array_search(strtolower(filter_var($emailid, FILTER_SANITIZE_EMAIL)), $accounts)[0]) {
                //Verify password
                if (($user = $this->config->getAccount($user_id)) && password_verify(base64_encode(hash('sha256', $pass, true)), $user['pass_hash'])) {
                    //Now we can create Session
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $user['username'] = preg_replace("/[^a-zA-Z0-9_\-]+/", '', $user['username']);
                    $_SESSION['email'] = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
                    $_SESSION['firstname'] = preg_replace("/[^a-zA-Z\-]+/", '', ucfirst(strtolower($user['firstname'])));
                    $_SESSION['lastname'] = preg_replace("/[^a-zA-Z\-]+/", '', ucfirst(strtolower($user['lastname'])));
                    $_SESSION['avatar'] = filter_var($user['avatar'], FILTER_SANITIZE_URL);
                    $_SESSION['login_token'] = base64_encode(time().':'.$this->tools->ip());
                    if (isset($_POST['remember'])) {
                        $lookup = bin2hex(openssl_random_pseudo_bytes(9));
                        $validator = base64_encode((openssl_random_pseudo_bytes(18)));
                        $accounts[$user_id]['token'] = $lookup;
                        $accounts[$user_id]['tok_val'] = hash_hmac('sha256', $validator, $this->tools->ip());
                        setcookie(
                            'eayo_login',
                            $lookup . ':' . $validator,
                            time() + 604800
                        );
                    }
                    file_put_contents(CONF_DIR.'accounts.yml', Yaml::dump($accounts, 4));
                    if (!empty($this->tools->params["url"])) {
                        header("location: ".$this->tools->params["url"]);
                    } else {
                        header("location: ".$this->tools->rooturl);
                    }
                } else {
                    return 'Nom d\'utilisateurs\\E-mail ou mot de passe incorrect.';
                }
            } else {
                return 'Nom d\'utilisateurs\\E-mail ou mot de passe incorrect.';
            }
        } else {
            return 'Vous ête déjà connecté.';
        }
    }
}
