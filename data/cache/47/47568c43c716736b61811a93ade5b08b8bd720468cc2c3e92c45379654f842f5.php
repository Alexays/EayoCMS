<?php

/* @kiCkila_views/items/add_item.twig */
class __TwigTemplate_c8362be7e2b5901caa1310f016bc596f27fa38749f64ffdc6b2659264e6afbd6 extends Twig_Template
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
        echo "<h4 class=\"page-title\">Ajouter un objet</h4>
<hr>
<form method=\"post\" id=\"add_item\" action=\"";
        // line 3
        echo $this->env->getExtension('eayo')->getUrl("items/add_item", "APP");
        echo "\" enctype=\"multipart/form-data\">
    <div class=\"row\">
        <div class=\"form-group col-md-6\">
            <label for=\"name\">Nom</label>
            <input type=\"text\" class=\"form-control\" name=\"name\" required />
        </div>
        <div class=\"form-group col-md-6\">
            <label for=\"file\">Images</label>
            <input name=\"file[]\" type=\"file\" multiple />
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"desc\">Description</label>
        <textarea type=\"text\" class=\"form-control\" name=\"desc\"></textarea>
    </div>
    <div class=\"form-group\">
        <label for=\"date\">Disponibilité</label>
        <br>
        <label for=\"from\">De</label>
        <input type=\"text\" id=\"from\" name=\"from\" required />
        <label for=\"to\"> à </label>
        <input type=\"text\" id=\"to\" name=\"to\" required />
    </div>
    <div class=\"form-group pull-right\">
        <input type=\"reset\" class=\"btn btn-danger\" value=\"Vider le formulaire\" />
        <input type=\"submit\" name=\"add_item\" class=\"btn btn-primary\" value=\"Ajouter\"/>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "@kiCkila_views/items/add_item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }
}
/* <h4 class="page-title">Ajouter un objet</h4>*/
/* <hr>*/
/* <form method="post" id="add_item" action="{{url('items/add_item', 'APP')}}" enctype="multipart/form-data">*/
/*     <div class="row">*/
/*         <div class="form-group col-md-6">*/
/*             <label for="name">Nom</label>*/
/*             <input type="text" class="form-control" name="name" required />*/
/*         </div>*/
/*         <div class="form-group col-md-6">*/
/*             <label for="file">Images</label>*/
/*             <input name="file[]" type="file" multiple />*/
/*         </div>*/
/*     </div>*/
/*     <div class="form-group">*/
/*         <label for="desc">Description</label>*/
/*         <textarea type="text" class="form-control" name="desc"></textarea>*/
/*     </div>*/
/*     <div class="form-group">*/
/*         <label for="date">Disponibilité</label>*/
/*         <br>*/
/*         <label for="from">De</label>*/
/*         <input type="text" id="from" name="from" required />*/
/*         <label for="to"> à </label>*/
/*         <input type="text" id="to" name="to" required />*/
/*     </div>*/
/*     <div class="form-group pull-right">*/
/*         <input type="reset" class="btn btn-danger" value="Vider le formulaire" />*/
/*         <input type="submit" name="add_item" class="btn btn-primary" value="Ajouter"/>*/
/*     </div>*/
/* </form>*/
