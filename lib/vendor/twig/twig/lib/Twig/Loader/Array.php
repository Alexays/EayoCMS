<?php

/*
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Loads a theme_url from an array.
 *
 * When using this loader with a cache mechanism, you should know that a new cache
 * key is generated each time a theme_url content "changes" (the cache key being the
 * source code of the theme_url). If you don't want to see your cache grows out of
 * control, you need to take care of clearing the old cache file by yourself.
 *
 * This loader should only be used for unit testing.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Loader_Array implements Twig_LoaderInterface, Twig_ExistsLoaderInterface
{
    protected $theme_urls = array();

    /**
     * Constructor.
     *
     * @param array $theme_urls An array of theme_urls (keys are the names, and values are the source code)
     */
    public function __construct(array $theme_urls)
    {
        $this->theme_urls = $theme_urls;
    }

    /**
     * Adds or overrides a theme_url.
     *
     * @param string $name     The theme_url name
     * @param string $theme_url The theme_url source
     */
    public function setTemplate($name, $theme_url)
    {
        $this->theme_urls[(string) $name] = $theme_url;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        $name = (string) $name;
        if (!isset($this->theme_urls[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

        return $this->theme_urls[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function exists($name)
    {
        return isset($this->theme_urls[(string) $name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        $name = (string) $name;
        if (!isset($this->theme_urls[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

        return $this->theme_urls[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        $name = (string) $name;
        if (!isset($this->theme_urls[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

        return true;
    }
}
