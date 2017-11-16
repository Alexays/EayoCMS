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
use \Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;

class Page
{
    protected static $_instance = null;

    public function Process(\Eayo $core, $page)
    {
        try {
            $core->twig_vars['load_time'] = number_format(microtime(true) - PERF_START, 3);

            if ($page['ext'] === 'html' || $page['ext'] === 'htm') {
                $content = file_get_contents($page['page']);
            } elseif ($page['ext'] === 'md') {
                $content = $core->page->parseMarkdown(file_get_contents($page['page']));
            } elseif ($page['ext'] === 'php') {
                $content = include($page['page']);
            } elseif ($page['ext'] === 'twig') {
                $page['page'] = $content = !$page['is_views'] ? $page['template'].'/'.ltrim(str_replace($page['template_path'], '', $page['page']), DS) : $page['template'].'_views/'.ltrim(str_replace($page['is_views'], '', $page['page']), DS);
            }

            if (!file_exists($page['page'])) {
                return $core->twig->render('@'.$content, $core->twig_vars);
            } else {
                $core->twig_vars['content'] = $content;
                return $core->twig->render('@'.$page['template'].'/default.html.twig', $core->twig_vars);
            }
        } catch (\Twig_Error_Loader $e) {
            throw new \RuntimeException($e->getRawMessage(), 4054, $e);
        }
    }

    public function parseMarkdown($raw)
    {
        $markdown = new \Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown;

        return $markdown->parse($raw);
    }

    /** @return Return instance of Eayo class as singleton */
    public static function init()
    {
        if (is_null(static::$_instance)) {
            self::$_instance = new Page();
        }
        return static::$_instance;
    }
}
