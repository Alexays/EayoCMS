<?php

/* @backend_views/apps/index.twig */
class __TwigTemplate_fa8ad91be69c0e6bcc1c5d5c982204aac54a1c78af3fb04c8fdb75239d36a3d7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@backend/default.html.twig", "@backend_views/apps/index.twig", 1);
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
        echo "<div class=\"container-fluid\">
    <div class=\"row\">
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["apps"]) ? $context["apps"] : null), "AppsList", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["app"]) {
            // line 7
            echo "        <div class=\"col-lg-3 col-sm-3\">
            <div class=\"thumbnail\">
                <div class=\"thumb\">
                    <img src=\"http://placehold.it/150x100\" alt=\"\">
                    <div class=\"caption-overflow\">
                        <p>
                            ";
            // line 13
            if ($this->getAttribute($context["app"], "desc", array())) {
                // line 14
                echo "                            ";
                echo $this->getAttribute($context["app"], "desc", array());
                echo "
                            ";
            }
            // line 16
            echo "                        </p>
                    </div>
                </div>

                <div class=\"caption text-center\">
                    <h6>
                        <a href=\"gallery.htm#\">
                            ";
            // line 23
            if ($this->getAttribute($context["app"], "name", array())) {
                // line 24
                echo "                            ";
                echo $this->getAttribute($context["app"], "name", array());
                echo "
                            ";
            } else {
                // line 26
                echo "                            ";
                echo twig_capitalize_string_filter($this->env, $context["key"]);
                echo "
                            ";
            }
            // line 28
            echo "                        </a>
                        <a href=\"#\">
                            <i class=\"fa fa-bars pull-right\"></i>
                        </a>
                    </h6>
                </div>
            </div>
        </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 37
            echo "        <span>Un problèmes est survenue.</span>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['app'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "    </div>
    <!-- MODAL (EDIT) -->
    <div class=\"modal fade bs-example-modal-lg\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myLargeModalLabel\">
        <div class=\"modal-dialog modal-lg\">
            <div class=\"modal-content\">
                ...
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@backend_views/apps/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 39,  92 => 37,  79 => 28,  73 => 26,  67 => 24,  65 => 23,  56 => 16,  50 => 14,  48 => 13,  40 => 7,  35 => 6,  31 => 4,  28 => 3,  11 => 1,);
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
<div class=\"container-fluid\">
    <div class=\"row\">
        {% for key, app in apps.AppsList %}
        <div class=\"col-lg-3 col-sm-3\">
            <div class=\"thumbnail\">
                <div class=\"thumb\">
                    <img src=\"http://placehold.it/150x100\" alt=\"\">
                    <div class=\"caption-overflow\">
                        <p>
                            {% if app.desc %}
                            {{app.desc}}
                            {% endif %}
                        </p>
                    </div>
                </div>

                <div class=\"caption text-center\">
                    <h6>
                        <a href=\"gallery.htm#\">
                            {% if app.name %}
                            {{app.name}}
                            {% else %}
                            {{key | capitalize}}
                            {% endif %}
                        </a>
                        <a href=\"#\">
                            <i class=\"fa fa-bars pull-right\"></i>
                        </a>
                    </h6>
                </div>
            </div>
        </div>
        {% else %}
        <span>Un problèmes est survenue.</span>
        {% endfor %}
    </div>
    <!-- MODAL (EDIT) -->
    <div class=\"modal fade bs-example-modal-lg\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myLargeModalLabel\">
        <div class=\"modal-dialog modal-lg\">
            <div class=\"modal-content\">
                ...
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "@backend_views/apps/index.twig", "/media/fa36508a-b3c4-4499-b30a-711dd5994225/arouillard.fr/apps/backend/views/apps/index.twig");
    }
}
