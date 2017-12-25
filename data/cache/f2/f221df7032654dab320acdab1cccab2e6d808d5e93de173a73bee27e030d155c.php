<?php

/* @backend_views/users/edit.twig */
class __TwigTemplate_5bae5a86e16f97462c3bc683c0a260ee133f654d015449124a0b102e65d153f4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@backend/default.html.twig", "@backend_views/users/edit.twig", 1);
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
        $context["e_user"] = $this->getAttribute((isset($context["edit"]) ? $context["edit"] : null), "User", array(0 => (isset($context["params"]) ? $context["params"] : null)), "method");
        // line 5
        echo "<form method=\"post\" id=\"edit_user\"> 
    <div class=\"row\">
        <div class=\"col-md-6\">
            <div class=\"form-group\">
                <label for=\"username\">Pseudo:</label>
                <input type=\"text\" class=\"form-control\" name=\"username\" value=\"";
        // line 10
        echo $this->getAttribute((isset($context["e_user"]) ? $context["e_user"] : null), "username", array());
        echo "\" required>
            </div>
        </div>
        <div class=\"col-md-6\">
            <img class=\"img-circle\" src=\"";
        // line 14
        echo $this->env->getExtension('eayo')->getUrl($this->getAttribute((isset($context["e_user"]) ? $context["e_user"] : null), "avatar", array()));
        echo "\" width=\"60\" height=\"60\"/>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-6\">
            <div class=\"form-group\">
                <label for=\"firstname\">Prénom:</label>
                <input type=\"text\" class=\"form-control\" name=\"firstname\" value=\"";
        // line 21
        echo $this->getAttribute((isset($context["e_user"]) ? $context["e_user"] : null), "firstname", array());
        echo "\">
            </div>
        </div>
        <div class=\"col-md-6\">
            <div class=\"form-group\">
                <label for=\"lastname\">Nom:</label>
                <input type=\"text\" class=\"form-control\" name=\"lastname\" value=\"";
        // line 27
        echo $this->getAttribute((isset($context["e_user"]) ? $context["e_user"] : null), "lastname", array());
        echo "\">
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-6\">
            <div class=\"form-group\">
                <label for=\"firstname\">Mot de passe:</label>
                <input type=\"password\" class=\"form-control\" name=\"passwd\" value=\"password\" required>
            </div>
        </div>
        <div class=\"col-md-6\">
            <div class=\"form-group\">
                <label for=\"lastname\">Confirmer le mot de passe:</label>
                <input type=\"password\" class=\"form-control\" name=\"passwd-2\" value=\"password\" required>
            </div>
        </div>
    </div>
    <div class=\"form-group pull-right\">
        <input type=\"submit\" name=\"user_edit\" class=\"btn btn-primary\" />
        <button type=\"reset\" class=\"btn btn-danger\">Annuler</button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "@backend_views/users/edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 27,  57 => 21,  47 => 14,  40 => 10,  33 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends "@backend/default.html.twig" %}*/
/* */
/* {% block content %}*/
/* {% set e_user = edit.User(params) %}*/
/* <form method="post" id="edit_user"> */
/*     <div class="row">*/
/*         <div class="col-md-6">*/
/*             <div class="form-group">*/
/*                 <label for="username">Pseudo:</label>*/
/*                 <input type="text" class="form-control" name="username" value="{{e_user.username}}" required>*/
/*             </div>*/
/*         </div>*/
/*         <div class="col-md-6">*/
/*             <img class="img-circle" src="{{url(e_user.avatar)}}" width="60" height="60"/>*/
/*         </div>*/
/*     </div>*/
/*     <div class="row">*/
/*         <div class="col-md-6">*/
/*             <div class="form-group">*/
/*                 <label for="firstname">Prénom:</label>*/
/*                 <input type="text" class="form-control" name="firstname" value="{{e_user.firstname}}">*/
/*             </div>*/
/*         </div>*/
/*         <div class="col-md-6">*/
/*             <div class="form-group">*/
/*                 <label for="lastname">Nom:</label>*/
/*                 <input type="text" class="form-control" name="lastname" value="{{e_user.lastname}}">*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div class="row">*/
/*         <div class="col-md-6">*/
/*             <div class="form-group">*/
/*                 <label for="firstname">Mot de passe:</label>*/
/*                 <input type="password" class="form-control" name="passwd" value="password" required>*/
/*             </div>*/
/*         </div>*/
/*         <div class="col-md-6">*/
/*             <div class="form-group">*/
/*                 <label for="lastname">Confirmer le mot de passe:</label>*/
/*                 <input type="password" class="form-control" name="passwd-2" value="password" required>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div class="form-group pull-right">*/
/*         <input type="submit" name="user_edit" class="btn btn-primary" />*/
/*         <button type="reset" class="btn btn-danger">Annuler</button>*/
/*     </div>*/
/* </form>*/
/* {% endblock %}*/
/* */
