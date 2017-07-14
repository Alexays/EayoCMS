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

class adminCtrl extends Controller
{
	protected static $needLogin = true;
}
