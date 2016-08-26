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

    public function __construct(\Eayo $core, $page)
    {
        $this->core = $core;
        $this->page = $page;
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
            'url' => new \Twig_Filter_Method($this, 'getUrl'),
            'frDate' => new \Twig_Filter_Method($this, 'getDate')
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

    public function getUrl($url, $type='URL') {
        switch(strtoupper($type)) {
            case 'URL':
                $url = $this->core->tools->rooturl.ltrim($url, '/');
                break;
            case 'APP':
                $url = $this->core->tools->rooturl.ltrim($this->core->CurApp).'/'.ltrim($url, '/');
                break;
            case 'APP_ASSETS':
                $url = $this->core->tools->rooturl.str_replace(ROOT_DIR, '', APP_DIR).'/'.ltrim($url, '/');
                break;
            case 'ASSETS':
                $url = $this->core->tools->rooturl.str_replace(ROOT_DIR, '', $this->page['template_path']).'/assets/'.ltrim($url, '/');
                break;
            case 'UPLOAD':
                $url = $this->core->tools->rooturl.str_replace(ROOT_DIR, '', UPLOAD_DIR).ltrim($url, '/');
                break;
            default:
                $url = $this->core->tools->rooturl.ltrim($url, '/');
                break;
        }

        return $this->core->tools->Sanitize($url);
    }

    public function getDate(\Datetime $datetime) {
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::LONG);
        return $formatter->format($datetime);
    }
}
