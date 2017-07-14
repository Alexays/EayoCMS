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

namespace Apps\Backend\Controller;

defined('EAYO_ACCESS') || exit('No direct script access.');

use Core\Controller;

class editCtrl extends Controller
{
    public function __construct() {
        parent::__construct();
        if (!empty($_POST)) {
            if (isset($_POST['username']) && isset($_POST['passwd']) && isset($_POST['passwd-2'])) {
                if ($_POST['username'] !== '' || $_POST['passwd'] !== '' || $_POST['passwd-2'] !== '') {
                    return 'true';
                } else {
                    echo 'L\'identifiant et le mot de passe ne doivent pas être vide.';
                }
            } else {
                echo 'L\'identifiant et le mot de passe sont obligatoire.';
            }
        }
    }

    public function getUser($user_id) {
        if (!empty($q = $this->config->getAccount($user_id))) {
            return $q;
        } else {
            throw new \Exception('Utilisateurs n\'ayant pas de données ou bloqué.', 56);
        }
    }
}