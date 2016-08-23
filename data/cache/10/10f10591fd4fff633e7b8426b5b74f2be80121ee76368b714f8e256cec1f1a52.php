<?php

/* @kiCkila_views/index.twig */
class __TwigTemplate_e8a2f6feec0081c69f8e8f00f48adabd16b986f1a14ba5b11c011b1bfacbd516 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@kiCkila/default.html.twig", "@kiCkila_views/index.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@kiCkila/default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context["items"] = $this->getAttribute($this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "ItemsList", array()), "available", array());
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function block_content($context, array $blocks = array())
    {
        // line 2
        echo "<ul id=\"tab-container\" class=\"nav nav-tabs\" role=\"tablist\">
    <li role=\"presentation\" class=\"active\"><a href=\"#home\" aria-controls=\"home\" role=\"tab\" data-toggle=\"tab\">Accueil</a></li>
</ul>

<div class=\"tab-content\">
    <div role=\"tabpanel\" class=\"tab-pane active\" id=\"home\">
        <div class=\"grid\">
            <div class=\"grid-sizer\"></div>
            ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            if (($this->getAttribute($context["item"], "mode", array()) != "unavailable")) {
                // line 11
                echo "            <div class=\"grid-item\">";
                echo $this->getAttribute($context["item"], "desc", array());
                echo "</div>
            ";
                $context['_iterated'] = true;
            }
        }
        if (!$context['_iterated']) {
            // line 13
            echo "            <p>Aucun objets n'est disponible ou bientôt disponible</p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@kiCkila_views/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 15,  56 => 13,  47 => 11,  41 => 10,  31 => 2,  11 => 1,);
    }
}
/* {% extends "@kiCkila/default.html.twig" %} {% set items = kiCkila.ItemsList.available %} {% block content %}*/
/* <ul id="tab-container" class="nav nav-tabs" role="tablist">*/
/*     <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Accueil</a></li>*/
/* </ul>*/
/* */
/* <div class="tab-content">*/
/*     <div role="tabpanel" class="tab-pane active" id="home">*/
/*         <div class="grid">*/
/*             <div class="grid-sizer"></div>*/
/*             {% for key, item in items if item.mode != 'unavailable' %}*/
/*             <div class="grid-item">{{item.desc}}</div>*/
/*             {% else %}*/
/*             <p>Aucun objets n'est disponible ou bientôt disponible</p>*/
/*             {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
