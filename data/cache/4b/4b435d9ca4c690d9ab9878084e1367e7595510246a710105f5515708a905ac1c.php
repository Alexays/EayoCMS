<?php

/* @kiCkila_views/items/view_item.twig */
class __TwigTemplate_783e7feb9d91f200d931cb11cdd1ae5d007a80f4c30212a820b80309dab0e8df extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["item"] = $this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "item", array(0 => (isset($context["params"]) ? $context["params"] : null)), "method");
        // line 2
        echo "<div class=\"modal-header\">
\t<h3>";
        // line 3
        echo $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array());
        echo "</h3>
</div>
<div class=\"modal-body\">
\t<p>";
        // line 6
        echo $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "desc", array());
        echo "</p>
\t<p>";
        // line 7
        echo $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "owner", array());
        echo "</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "@kiCkila_views/items/view_item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 7,  30 => 6,  24 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% set item = kiCkila.item(params) %}*/
/* <div class="modal-header">*/
/* 	<h3>{{item.name}}</h3>*/
/* </div>*/
/* <div class="modal-body">*/
/* 	<p>{{item.desc}}</p>*/
/* 	<p>{{item.owner}}</p>*/
/* </div>*/
/* */
