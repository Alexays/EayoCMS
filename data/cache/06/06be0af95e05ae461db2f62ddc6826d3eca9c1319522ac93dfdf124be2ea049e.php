<?php

/* @default_views/project.twig */
class __TwigTemplate_47929a6f37ed81885ef9d25255f874e0fa9a4e1ab4adab1581a51563546e7d46 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@frontend/default.html.twig", "@default_views/project.twig", 1);
        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@frontend/default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["title"] = "Alexis Rouillard | Developer";
        // line 3
        $context["head_title"] = "PROJECT";
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_styles($context, array $blocks = array())
    {
        // line 5
        echo "  <link href=\"";
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("css/project.css?v=1.0", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\"/>
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "  <div class=\"card-columns\">
    <div class=\"card\">
      <img class=\"card-img-top img-fluid\" src=\"";
        // line 10
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("wolf3d.jpg", "UPLOAD");
        echo "\"/>
    </div>
    <div class=\"card\">
      <img class=\"card-img-top img-fluid\" src=\"";
        // line 13
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("raytracer.jpg", "UPLOAD");
        echo "\"/>
    </div>
    <div class=\"card\">
      <img class=\"card-img-top img-fluid\" src=\"";
        // line 16
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("wireframe.jpg", "UPLOAD");
        echo "\">
    </div>
    <div class=\"card\">
      <img class=\"card-img img-fluid\" src=\"";
        // line 19
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("CMS.jpg", "UPLOAD");
        echo "\"/>
    </div>
    <div class=\"card\">
      <img class=\"card-img img-fluid\" src=\"";
        // line 22
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("AI.jpg", "UPLOAD");
        echo "\"/>
    </div>
  </div>
";
    }

    public function getTemplateName()
    {
        return "@default_views/project.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 22,  69 => 19,  63 => 16,  57 => 13,  51 => 10,  47 => 8,  44 => 7,  37 => 5,  34 => 4,  30 => 1,  28 => 3,  26 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"@frontend/default.html.twig\" %}
{% set title = 'Alexis Rouillard | Developer' %}
{% set head_title = 'PROJECT' %}
{% block styles %}
  <link href=\"{{url('css/project.css?v=1.0', 'ASSETS')}}\" rel=\"stylesheet\" type=\"text/css\"/>
{% endblock %}
{% block content %}
  <div class=\"card-columns\">
    <div class=\"card\">
      <img class=\"card-img-top img-fluid\" src=\"{{url('wolf3d.jpg', 'UPLOAD')}}\"/>
    </div>
    <div class=\"card\">
      <img class=\"card-img-top img-fluid\" src=\"{{url('raytracer.jpg', 'UPLOAD')}}\"/>
    </div>
    <div class=\"card\">
      <img class=\"card-img-top img-fluid\" src=\"{{url('wireframe.jpg', 'UPLOAD')}}\">
    </div>
    <div class=\"card\">
      <img class=\"card-img img-fluid\" src=\"{{url('CMS.jpg', 'UPLOAD')}}\"/>
    </div>
    <div class=\"card\">
      <img class=\"card-img img-fluid\" src=\"{{url('AI.jpg', 'UPLOAD')}}\"/>
    </div>
  </div>
{% endblock %}
", "@default_views/project.twig", "/srv/dev-disk-by-id-mmc-SE16G_0x43c0db87-part3/arouillard.fr/apps/frontend/views/project.twig");
    }
}
