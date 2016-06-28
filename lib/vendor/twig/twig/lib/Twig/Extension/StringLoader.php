<?php

/*
 * This file is part of Twig.
 *
 * (c) 2012 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Extension_StringLoader extends Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('theme_url_from_string', 'twig_theme_url_from_string', array('needs_environment' => true)),
        );
    }

    public function getName()
    {
        return 'string_loader';
    }
}

/**
 * Loads a theme_url from a string.
 *
 * <pre>
 * {{ include(theme_url_from_string("Hello {{ name }}")) }}
 * </pre>
 *
 * @param Twig_Environment $env      A Twig_Environment instance
 * @param string           $theme_url A theme_url as a string or object implementing __toString()
 *
 * @return Twig_Template A Twig_Template instance
 */
function twig_theme_url_from_string(Twig_Environment $env, $theme_url)
{
    return $env->createTemplate((string) $theme_url);
}
