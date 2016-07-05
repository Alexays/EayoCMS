<?php

/* @backend_views/\apps\index.twig */
class __TwigTemplate_fe9df1c1ca5e8019767595b7e8c4dddec596c3313642c511777807b80c2985ab extends Twig_Template
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
        echo "<div class=\"container-fluid\">
    <div class=\"row masonry-layout\">
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["mainCtrl"]) ? $context["mainCtrl"] : null), "AppsList", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["app"]) {
            // line 4
            echo "        <div class=\"col-md-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">
                    <img src=\"https://placeholdit.imgix.net/~text?txtsize=33&txt=350×150&w=350&h=150\" />
                </div>
                <div class=\"panel-footer\">";
            // line 9
            echo $context["key"];
            echo "</div>
            </div>
        </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 13
            echo "        <span>Un problèmes est survenue.</span>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['app'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
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
        return "@backend_views/\\apps\\index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 15,  44 => 13,  35 => 9,  28 => 4,  23 => 3,  19 => 1,);
    }
}
/* <div class="container-fluid">*/
/*     <div class="row masonry-layout">*/
/*         {% for key, app in mainCtrl.AppsList %}*/
/*         <div class="col-md-4">*/
/*             <div class="panel panel-default">*/
/*                 <div class="panel-body">*/
/*                     <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350×150&w=350&h=150" />*/
/*                 </div>*/
/*                 <div class="panel-footer">{{key}}</div>*/
/*             </div>*/
/*         </div>*/
/*         {% else %}*/
/*         <span>Un problèmes est survenue.</span>*/
/*         {% endfor %}*/
/*     </div>*/
/*     <!-- MODAL (EDIT) -->*/
/*     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">*/
/*         <div class="modal-dialog modal-lg">*/
/*             <div class="modal-content">*/
/*                 ...*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
