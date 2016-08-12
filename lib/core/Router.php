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
    public static function Analyse(\Eayo $core)
    {
        $params = '';
        $content_file;
        $template_file;

        $query = str_replace($core->tools->rootpath, '', $core->tools->uri);
        
        if (($pos = strpos($query, ':')) !== FALSE) { 
            $params = substr($query, $pos+1);
            $query = strtok($query, ':');
        }
        
        $queryPart = explode('/', trim($query, '\/'));

        $queryLength = count($queryPart);
        $index = empty($queryPart[0]) ? null : $queryPart[0];
        $main = $queryPart[count($queryPart) - 1];
        $main = $main === $index ? 'index' : $main;
        $query = implode($queryPart, DS);

        if (isset($core::$router) && array_key_exists($index, $core::$router)) {
            $template_name = $core::$router[$index];
            if ($template_name === 'default') {
                $query = empty($query_tmp = $query) ? 'index' : $query_tmp;
            } else {
                $query = empty($query_tmp = str_replace($index, '', $query)) ? 'index' : $query_tmp;
            }
        } else {
            $template_name = 'default';
        }

        list($template_origin, $template_name, $template_path) = $core->tools->findTemplate($template_name);
        if ($template_origin === 'apps') {
            $app_path = APP_DIR.$template_name;
        } elseif ($template_origin === 'plugins') {
            $app_path = PLUGINS_DIR.$template_name;
        } else {
            throw new \Exception('Orgine du template inconnue.', 894);
        }
        $view_path = $app_path.DS.'views'.DS;
        $content_path = rtrim($view_path, '\/').DS.$query;
        $is_template = false;

        if (!empty($q = glob(rtrim($template_path, '\/').DS.'parts'.DS.ltrim($query, '\/').'.{md,html,htm,twig,php}', GLOB_BRACE))) {
            $content_file = $q[0];
            $is_template = true;
        } elseif (!empty($q = glob($content_path.'.{md,html,htm,twig,php}', GLOB_BRACE)) || is_dir($content_path) && !empty($q = glob($content_path.DS.'index.{md,html,htm,twig,php}', GLOB_BRACE))) {
            $content_file = $q[0];
        } elseif (isset($core::$router) && array_key_exists($index, $core::$router) && !empty($q = glob($template_path.$query.'.{php,twig}', GLOB_BRACE))) {
            $content_file = $q[0];
            $is_template = true;
        } else {
            $template_path_404 = isset($template_name) && $template_name === 'default' ? $template_path : array_values($core->tools->findTemplate('default'))[2];
            if(!empty($q = glob($template_path_404.'404.{md,html,htm,php}', GLOB_BRACE))) {
                $content_file = $q[0];
            } else {
                throw new \Exception('Impossible de trouver le fichier 404 not found');
            }
        }

        return [$content_file, $template_name, $index, $template_path, $view_path, $main, $is_template, $params];
    }
}
