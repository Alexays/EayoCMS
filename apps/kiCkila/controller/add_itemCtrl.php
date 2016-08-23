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

class add_itemCtrl extends Controller
{
    protected static $needLogin = true;

    public function __construct() {
        parent::__construct();

        function dateDiff($dformat, $endDate, $beginDate)
        {
            $date_parts1=explode($dformat, $beginDate);
            $date_parts2=explode($dformat, $endDate);
            $start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
            $end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
            return $end_date - $start_date;
        }

        if (isset($_POST['add_item'])) {
            $items_file = APP_DIR.'data'.DS.'items.yml';

            $items = Yaml::parse(file_get_contents($items_file));

            $item_id = !empty($items) ? max(array_keys($items))+1 : rand(500, 999);
            $items[$item_id] = [
                'owner' => intval($_SESSION['user_id']),
                'holder' => intval($_SESSION['user_id'])
            ];

            file_put_contents($items_file, Yaml::dump($items, 4));

            $available_from = dateDiff('/', $_POST['from'], date("m/d/Y"));
            $available_to = dateDiff('/', $_POST['to'], date("m/d/Y"));

            $item = [
                'name' => $_POST['name'],
                'desc' => $_POST['desc'],
                'owner' => intval($_SESSION['user_id']),
                'holder' => intval($_SESSION['user_id']),
                'creation_date' => time(),
                'hold_date' => time(),
                'available_date' => [$_POST['from'], $_POST['to']],
                'available' => $available_from >= 0 && $available_to <= 0 ? true : false,
            ];



            if (is_array($_FILES)) {
                $image_ext = array("jpeg","jpg","png");
                $item['image'] = [];
                foreach($_FILES["file"]["tmp_name"] as $key => $tmp_name) {
                    $file_name = $_FILES["file"]["name"][$key];
                    $file_tmp = $_FILES["file"]["tmp_name"][$key];
                    $ext = pathinfo($file_name,PATHINFO_EXTENSION);

                    if(in_array($ext, $image_ext)) {
                        $image_dir = APP_DIR.'data'.DS.'imgs'.DS;
                        move_uploaded_file($file_tmp = $_FILES["file"]["tmp_name"][$key],$image_dir.$item_id.'_img_'.time().'.'.$ext);
                        array_push($item['images'], $item_id.'_img_'.time().'.'.$ext);
                    } else {
                        echo 'Not an images';
                    }
                }
            } else {
                echo 'No Files';
            }

            file_put_contents(APP_DIR.'data'.DS.$item_id.'.yml', Yaml::dump($item, 4));

            echo 'Success';
        }
    }

}
