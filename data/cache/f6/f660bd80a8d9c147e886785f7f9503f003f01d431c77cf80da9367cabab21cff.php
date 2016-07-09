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
    <div class=\"row\">
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["mainCtrl"]) ? $context["mainCtrl"] : null), "AppsList", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["app"]) {
            // line 4
            echo "        <div class=\"col-lg-3 col-sm-3\">
            <div class=\"thumbnail\">
                <div class=\"thumb\">
                    <img src=\"http://placehold.it/150x100\" alt=\"\">
                    <div class=\"caption-overflow\">
                        <p>
                            ";
            // line 10
            if ($this->getAttribute($context["app"], "desc", array())) {
                // line 11
                echo "                            ";
                echo $this->getAttribute($context["app"], "desc", array());
                echo "
                            ";
            }
            // line 13
            echo "                        </p>
                    </div>
                </div>

                <div class=\"caption text-center\">
                    <h6>
                        <a href=\"gallery.htm#\">
                            ";
            // line 20
            if ($this->getAttribute($context["app"], "name", array())) {
                // line 21
                echo "                            ";
                echo $this->getAttribute($context["app"], "name", array());
                echo "
                            ";
            } else {
                // line 23
                echo "                            ";
                echo twig_capitalize_string_filter($this->env, $context["key"]);
                echo "
                            ";
            }
            // line 25
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
            // line 34
            echo "        <span>Un problèmes est survenue.</span>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['app'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
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
        return array (  87 => 36,  80 => 34,  67 => 25,  61 => 23,  55 => 21,  53 => 20,  44 => 13,  38 => 11,  36 => 10,  28 => 4,  23 => 3,  19 => 1,);
    }
}
/* <div class="container-fluid">*/
/*     <div class="row">*/
/*         {% for key, app in mainCtrl.AppsList %}*/
/*         <div class="col-lg-3 col-sm-3">*/
/*             <div class="thumbnail">*/
/*                 <div class="thumb">*/
/*                     <img src="http://placehold.it/150x100" alt="">*/
/*                     <div class="caption-overflow">*/
/*                         <p>*/
/*                             {% if app.desc %}*/
/*                             {{app.desc}}*/
/*                             {% endif %}*/
/*                         </p>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="caption text-center">*/
/*                     <h6>*/
/*                         <a href="gallery.htm#">*/
/*                             {% if app.name %}*/
/*                             {{app.name}}*/
/*                             {% else %}*/
/*                             {{key | capitalize}}*/
/*                             {% endif %}*/
/*                         </a>*/
/*                         <a href="#">*/
/*                             <i class="fa fa-bars pull-right"></i>*/
/*                         </a>*/
/*                     </h6>*/
/*                 </div>*/
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
