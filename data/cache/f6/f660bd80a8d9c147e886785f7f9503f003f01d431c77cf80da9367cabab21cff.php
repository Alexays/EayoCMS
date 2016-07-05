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
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["mainCtrl"]) ? $context["mainCtrl"] : null), "AppsList", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["app"]) {
            // line 3
            echo "    <div class=\"masonry-layout\">
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
        <div class=\"masonry-panel\">
            <img src=\"//placehold.it/180x150\">
        </div>
    </div>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 27
            echo "    <span>Un problèmes est survenue.</span>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['app'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "    <!-- MODAL (EDIT) -->
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
        return array (  62 => 29,  55 => 27,  27 => 3,  22 => 2,  19 => 1,);
    }
}
/* <div class="container-fluid">*/
/*     {% for key, app in mainCtrl.AppsList %}*/
/*     <div class="masonry-layout">*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*         <div class="masonry-panel">*/
/*             <img src="//placehold.it/180x150">*/
/*         </div>*/
/*     </div>*/
/*     {% else %}*/
/*     <span>Un problèmes est survenue.</span>*/
/*     {% endfor %}*/
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
