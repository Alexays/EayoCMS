<?php namespace Core;

use \Twig_Extension;
use \Twig_Filter_Method;
use \Twig_Function_Method;

class TwigExtension extends \Twig_Extension {

    /**
     * An instance of a Tools to use.
     *
     * @var Tools
     */
    protected $tools;

    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
        //$this->markdown = new \Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown;
    }

    /**
     * Return the name of the extension.
     *
     * @return string
     */
    public function getName()
    {
        return 'eayo';
    }

    /**
     * Setup the twig filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            'url' => new \Twig_Filter_Method($this, 'parseMarkdown', ['is_safe' => ['html']])
        ];
    }

    /**
     * Setup the twig functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            'url' => new \Twig_Function_Method($this, 'getUrl')
        ];
    }

    public function getUrl($url) {
        return $this->tools->rooturl.ltrim($url, '\/');
    }
}
