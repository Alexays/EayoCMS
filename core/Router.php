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

namespace Core;

defined('EAYO_ACCESS') || exit('No direct script access.');

class Router
{
    public static function Analyse(\Apps\App $core)
    {
        $_query = [];
        $content_file;
        $template_file;

        $query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
        $queryPart = explode('/', rtrim($query, '\/'));
        $queryLength = count($queryPart);
        $index = empty($queryPart[0]) ? null : $queryPart[0];


        if (isset($core::$router) && array_key_exists($index, $core::$router)) {
            $template_name = $core::$router[$index];
            if ($template_name === 'default') {
                $query = empty($query_tmp = implode($queryPart, DS)) ? 'index' : $query_tmp;
            } else {
                $query = empty($query_tmp = str_replace($index, '', implode($queryPart, DS))) ? 'index' : $query_tmp;
            }
        } else {
            $template_name = 'default';
            $query = implode($queryPart, DS);
        }

        list($template_origin, $template_name, $template_path) = $core->tools->findTemplate($template_name);
        if ($template_origin === 'apps') {
            $app_path = APP_DIR.$template_name;
        } elseif($template_origin === 'plugins') {
            $app_path = PLUGINS_DIR.$template_name;
        } else {
            throw new \Exception('Orgine du template inconnue.', 894);
        }
        $view_path = $app_path.DS.'views'.DS;
        $content_path = rtrim($view_path, '\/').DS.$query;
        $file_finded = $is_template = false;
        //Detect query
        for($i = 0; $i < $queryLength; $i++) {
            $qPart = $queryPart;
            $content_path_tmp = $content_path;
            if(!empty($q = glob($content_path_tmp.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                $content_file = $q[0];
                $main_query = $qPart[count($qPart) - 1];
                $rest_query = str_replace(implode($qPart, DS), '', implode($queryPart, DS));
                $content_path = $content_path_tmp;
                $file_finded = true;
                break;
            } else {
                $main_query = $qPart[count($qPart) - 1];
                unset($qPart[$queryLength - $i]);
                $content_path_tmp = $view_path.str_replace($index, '', implode($qPart, DS));
            }
        }
        //try in template dir
        if ($file_finded === false && isset($core::$router) && array_key_exists($index, $core::$router)) {
            $content_path_tempalte = $template_path.implode($queryPart, DS);
            $template_content = glob($content_path_tempalte.'.{php,twig}', GLOB_BRACE);
            if (!empty($template_content)) {
                $content_file = $template_content[0];
                $file_finded = $is_template = true;
            }
        }
        //try index if is dir
        if (is_dir($content_path) && $file_finded === false) {
            $content_path .= DS.'index';
            if(!empty($q = glob($content_path.'.{md,html,htm,twig,php}', GLOB_BRACE))) {
                $content_file = $q[0];
                $file_finded = true;
            }
        }

        //else content = 404 error page
        if ($file_finded === false) {
            $template_path_404 = isset($template_name) && $template_name === 'default' ? $template_path : array_values($core->tools->findTemplate('default'))[2];
            $page_404 = glob($template_path_404.'404.{md,html,htm,php}', GLOB_BRACE);
            if(!empty($page_404)) {
                $content_file = $page_404[0];
            } else {
                throw new \Exception('Impossible de trouver le fichier 404 not found');
            }
        }

        return [$content_file, $template_name, $index, $template_path, $view_path, isset($main_query) ? $main_query : '', isset($rest_query) ? $rest_query : '', $is_template];
    }
}
