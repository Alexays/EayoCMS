<?php

/* @kiCkila_views/index.twig */
class __TwigTemplate_0ce71c45eb2f852e542ab09c0c816ed16a48430c295eef76f5a885ba96472f84 extends Twig_Template
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
        $context["items"] = $this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "ItemsList", array());
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
                echo "            ";
                $context["owner"] = $this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "UserInfo", array(0 => $this->getAttribute($context["item"], "owner", array())), "method");
                // line 12
                echo "            <div class=\"grid-item\">
                <div class=\"card hovercard\">
                    <a data-target=\"ajax\" data-name=\"";
                // line 14
                echo $this->getAttribute($context["item"], "name", array());
                echo "\" href=\"";
                echo $this->env->getExtension('eayo')->getUrl("kiCkila/items/view_item:");
                echo $context["key"];
                echo "\"><div class=\"cardheader\" style=\"background: url('";
                echo $this->env->getExtension('eayo')->getUrl("data/imgs/", "APP_ASSETS");
                echo twig_first($this->env, $this->getAttribute($context["item"], "images", array()));
                echo "');background-size: cover;\">

                        </div></a>
                    <div class=\"avatar\">
                        <img alt=\"Avatar de ";
                // line 18
                echo $this->getAttribute((isset($context["owner"]) ? $context["owner"] : null), "fullname", array());
                echo "\" src=\"";
                echo $this->env->getExtension('eayo')->getUrl($this->getAttribute((isset($context["owner"]) ? $context["owner"] : null), "avatar", array()));
                echo "\">
                    </div>
                    <div class=\"info\">
                        <div class=\"title\">
                            <a data-target=\"ajax\" href=\"";
                // line 22
                echo $this->env->getExtension('eayo')->getUrl("kiCkila/items/view_item:");
                echo $context["key"];
                echo "\">";
                echo $this->getAttribute($context["item"], "name", array());
                echo "</a><br>
                        </div>
                        <blockquote class=\"desc\">
                            <p>";
                // line 25
                echo $this->getAttribute($context["item"], "desc", array());
                echo "</p>
                            <footer>";
                // line 26
                echo $this->getAttribute((isset($context["owner"]) ? $context["owner"] : null), "fullname", array());
                echo "</footer>
                        </blockquote>
                    </div>
                    ";
                // line 29
                if ( !twig_test_empty($this->getAttribute($context["item"], "tags", array()))) {
                    // line 30
                    echo "                    <div class=\"bottom\">
                       ";
                    // line 31
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "tags", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 32
                        echo "                       <small><span class=\"badge\">";
                        echo $context["tag"];
                        echo "</span></small>
                       ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 34
                    echo "                    </div>
                    ";
                }
                // line 36
                echo "                </div>
            </div>
            ";
                $context['_iterated'] = true;
            }
        }
        if (!$context['_iterated']) {
            // line 39
            echo "            <p>Aucun objets n'est disponible ou bientôt disponible</p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
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
        return array (  132 => 41,  125 => 39,  117 => 36,  113 => 34,  104 => 32,  100 => 31,  97 => 30,  95 => 29,  89 => 26,  85 => 25,  76 => 22,  67 => 18,  54 => 14,  50 => 12,  47 => 11,  41 => 10,  31 => 2,  11 => 1,);
    }
}
/* {% extends "@kiCkila/default.html.twig" %} {% set items = kiCkila.ItemsList %} {% block content %}*/
/* <ul id="tab-container" class="nav nav-tabs" role="tablist">*/
/*     <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Accueil</a></li>*/
/* </ul>*/
/* */
/* <div class="tab-content">*/
/*     <div role="tabpanel" class="tab-pane active" id="home">*/
/*         <div class="grid">*/
/*             <div class="grid-sizer"></div>*/
/*             {% for key, item in items if item.mode != 'unavailable' %}*/
/*             {% set owner = kiCkila.UserInfo(item.owner) %}*/
/*             <div class="grid-item">*/
/*                 <div class="card hovercard">*/
/*                     <a data-target="ajax" data-name="{{item.name}}" href="{{url('kiCkila/items/view_item:')}}{{key}}"><div class="cardheader" style="background: url('{{url('data/imgs/', 'APP_ASSETS')}}{{item.images|first}}');background-size: cover;">*/
/* */
/*                         </div></a>*/
/*                     <div class="avatar">*/
/*                         <img alt="Avatar de {{owner.fullname}}" src="{{url(owner.avatar)}}">*/
/*                     </div>*/
/*                     <div class="info">*/
/*                         <div class="title">*/
/*                             <a data-target="ajax" href="{{url('kiCkila/items/view_item:')}}{{key}}">{{item.name}}</a><br>*/
/*                         </div>*/
/*                         <blockquote class="desc">*/
/*                             <p>{{item.desc}}</p>*/
/*                             <footer>{{owner.fullname}}</footer>*/
/*                         </blockquote>*/
/*                     </div>*/
/*                     {% if item.tags is not empty %}*/
/*                     <div class="bottom">*/
/*                        {% for tag in item.tags %}*/
/*                        <small><span class="badge">{{tag}}</span></small>*/
/*                        {% endfor %}*/
/*                     </div>*/
/*                     {% endif %}*/
/*                 </div>*/
/*             </div>*/
/*             {% else %}*/
/*             <p>Aucun objets n'est disponible ou bientôt disponible</p>*/
/*             {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
