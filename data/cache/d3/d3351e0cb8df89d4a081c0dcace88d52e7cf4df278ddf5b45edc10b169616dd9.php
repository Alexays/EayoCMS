<?php

/* @backend_views/index.twig */
class __TwigTemplate_4c787a6163ed3d85cf0b7dadc2dd7b00a8b99f931afc69ac6e23c1f335aeaac7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@backend/default.html.twig", "@backend_views/index.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@backend/default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"row\">
    <div class=\"col-md-3 col-sm-6\">
        <div class=\"widget panel panel-default\">
            <div class=\"panel-body\">
                <h3><span class=\"color-red pull-right\">";
        // line 8
        echo $this->getAttribute((isset($context["index"]) ? $context["index"] : null), "AppsCount", array(), "method");
        echo "</span></h3>
                Application(s) activée(s)
            </div>
            <div class=\"panel-footer bg-red\"></div>
        </div>
    </div>
    <div class=\"col-md-3 col-sm-6\">
        <div class=\"widget panel panel-default\">
            <div class=\"panel-body\">
                <h3><span class=\"color-blue pull-right\">";
        // line 17
        echo $this->getAttribute((isset($context["index"]) ? $context["index"] : null), "UsersCount", array(), "method");
        echo "</span></h3>
                Utilisateur(s) enregistré(s)
            </div>
            <div class=\"panel-footer bg-blue\"></div>
        </div>
    </div>
    <div class=\"col-md-3\">.col-md-6</div>
    <div class=\"col-md-3\">.col-md-6</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@backend_views/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 17,  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"@backend/default.html.twig\" %}

{% block content %}
<div class=\"row\">
    <div class=\"col-md-3 col-sm-6\">
        <div class=\"widget panel panel-default\">
            <div class=\"panel-body\">
                <h3><span class=\"color-red pull-right\">{{index.AppsCount()}}</span></h3>
                Application(s) activée(s)
            </div>
            <div class=\"panel-footer bg-red\"></div>
        </div>
    </div>
    <div class=\"col-md-3 col-sm-6\">
        <div class=\"widget panel panel-default\">
            <div class=\"panel-body\">
                <h3><span class=\"color-blue pull-right\">{{index.UsersCount()}}</span></h3>
                Utilisateur(s) enregistré(s)
            </div>
            <div class=\"panel-footer bg-blue\"></div>
        </div>
    </div>
    <div class=\"col-md-3\">.col-md-6</div>
    <div class=\"col-md-3\">.col-md-6</div>
</div>
{% endblock %}
", "@backend_views/index.twig", "/media/fa36508a-b3c4-4499-b30a-711dd5994225/arouillard.fr/apps/backend/views/index.twig");
    }
}
