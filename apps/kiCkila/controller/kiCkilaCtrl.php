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

namespace Apps\kiCkila\Controller;

defined('EAYO_ACCESS') || exit('No direct script access.');

use Core\Controller;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class kiCkilaCtrl extends Controller
{
    public function __construct() {
        parent::__construct();
        /* Check Login Status */
        if (!isset($_SESSION['login_str'])) {
            header('location: '.$this->tools->rooturl.'login/');
        }
    }
    
    public function getMyItem() {
        $this->items = Yaml::parse(file_get_contents(ROOT_DIR.'apps'.DS.'kiCkila'.DS.'data'.DS.'items.yml'));
        return $this->items[$_SESSION['user_id']]['lend'];
    }
    
    public function getItem($items_id) {
        $this->items = Yaml::parse(file_get_contents(ROOT_DIR.'apps'.DS.'kiCkila'.DS.'data'.DS.$items_id.'.yml'));
        return $this->items;
    }
    
    public function getUserName($user_id) {
        $account = $this->config->getAccount($user_id);
        return $account['firstname'].' '.$account['lastname'];
    }
}