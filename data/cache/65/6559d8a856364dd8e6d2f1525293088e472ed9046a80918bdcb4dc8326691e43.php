<?php

/* @backend_views/index.twig */
class __TwigTemplate_c698c61d1ef50f3395496288d670092df5a57bbff0f8e92f87a5ce8a08b7054e extends Twig_Template
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
        echo "<div class=\"row\">
    <div class=\"col-md-3 col-sm-6\">
        <div class=\"widget panel panel-default\">
            <div class=\"panel-body\">
                <h3><span class=\"color-red pull-right\">";
        // line 5
        echo $this->getAttribute((isset($context["mainCtrl"]) ? $context["mainCtrl"] : null), "AppsCount", array(), "method");
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
        // line 14
        echo $this->getAttribute((isset($context["mainCtrl"]) ? $context["mainCtrl"] : null), "UsersCount", array(), "method");
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
        return array (  37 => 14,  25 => 5,  19 => 1,);
    }
}
/* <div class="row">*/
/*     <div class="col-md-3 col-sm-6">*/
/*         <div class="widget panel panel-default">*/
/*             <div class="panel-body">*/
/*                 <h3><span class="color-red pull-right">{{mainCtrl.AppsCount()}}</span></h3>*/
/*                 Application(s) activée(s)*/
/*             </div>*/
/*             <div class="panel-footer bg-red"></div>*/
/*         </div>        */
/*     </div>*/
/*     <div class="col-md-3 col-sm-6">*/
/*         <div class="widget panel panel-default">*/
/*             <div class="panel-body">*/
/*                 <h3><span class="color-blue pull-right">{{mainCtrl.UsersCount()}}</span></h3>*/
/*                 Utilisateur(s) enregistré(s)*/
/*             </div>*/
/*             <div class="panel-footer bg-blue"></div>*/
/*         </div>        */
/*     </div>*/
/*     <div class="col-md-3">.col-md-6</div>*/
/*     <div class="col-md-3">.col-md-6</div>*/
/* </div>*/
/* */
