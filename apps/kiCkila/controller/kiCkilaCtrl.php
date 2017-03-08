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
    public function getMyItem() { //USE GLOB
        $myItemsData = [];
        $myItems = [];
        $item = [];
        $items = Yaml::parse(file_get_contents(APP_DIR.'data'.DS.'items.yml'));

        if (isset($_SESSION['user_id'])) {
            if(!empty($items)) {
                foreach($items as $value) {
                    $results = $this->recursive_array_search($_SESSION['user_id'], $items);
                    if ($results) {
                        list($item_id, $owner_type) = $results;
                        if ($owner_type = 'owner') {
                            $myItems[] = $item_id;
                            unset($items[$item_id]);
                        }
                    }
                }
            }

            if(!empty($myItems)) {
                foreach($myItems as $value) {
                    $item = Yaml::parse(file_get_contents(APP_DIR.'data'.DS.$value.'.yml'));
                    if ($item['owner'] === $item['holder'] && $item['available'] === true) {
                        $myItemsData['available'][$value] = $item;
                    } elseif ($item['owner'] !== $item['holder'] && $item['available'] === false) {
                        $myItemsData['taken'][$value] = $item;
                    } elseif ($item['available'] === false) {
                        $myItemsData['unavailable'][$value] = $item;
                    }
                }

                return $myItemsData;
            }
        }
    }
    
    public function getItemsList() { //USE GLOB
        $itemList = [];
        $items = Yaml::parse(file_get_contents(APP_DIR.'data'.DS.'items.yml'));
        $myItems = !empty($this->getMyItem()) ? array_unique(array_reduce(array_map('array_keys',$this->getMyItem()),'array_merge',[])) : [];

        foreach($items as $key=>$value) {
            if (!in_array(intval($key), $myItems)) {
                $item = Yaml::parse(file_get_contents(APP_DIR.'data'.DS.$key.'.yml'));
                if (isset($_SESSION['user_id'])) {
                    if ($item['holder'] !== $_SESSION['user_id'] && $item['available'] === true) {
                        $item['mode'] = 'available';
                        $itemList[$key] = $item;
                    } elseif ($item['holder'] !== $_SESSION['user_id'] && $item['available'] === false) {
                        $item['mode'] = 'taken';
                        $itemList[$key] = $item;
                    } elseif ($item['available'] === false) {
                        $item['mode'] = 'unavailable';
                        $itemList[$key] = $item;
                    }
                } else {
                    if ($item['available'] === true) {
                        $item['mode'] = 'available';
                        $itemList[$key] = $item;
                    } elseif ($item['owner'] !== $item['holder'] && $item['available'] === false) {
                        $item['mode'] = 'taken';
                        $itemList[$key] = $item;
                    } elseif ($item['available'] === false) {
                        $item['mode'] = 'unavailable';
                        $itemList[$key] = $item;
                    }
                }
            }
        }

        return $itemList;
    }
    
    public function getItem($items_id) {
        $this->items = Yaml::parse(file_get_contents(ROOT_DIR.'apps'.DS.'kiCkila'.DS.'data'.DS.$items_id.'.yml'));
        return $this->items;
    }
    
    public function getUserInfo($user_id) {
        $account = $this->config->getAccount($user_id);
        unset($account['pass_hash']);
        $account['fullname'] = $account['firstname'] .' '. $account['lastname'];
        return $account;
    }


    protected function recursive_array_search($needle, $haystack, $currentKey = []) {
        foreach($haystack as $key=>$value) {
            if (is_array($value)) {
                $nextKey = $this->recursive_array_search($needle,$value, array_merge($currentKey, array($key)));
                if ($nextKey) {
                    return $nextKey;
                }
            }
            else if($value==$needle) {
                return array_merge($currentKey, array($key));
            }
        }

        return false;
    }
}
