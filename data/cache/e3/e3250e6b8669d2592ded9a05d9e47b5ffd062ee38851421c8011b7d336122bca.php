<?php

/* @default/login.twig */
class __TwigTemplate_a6175b93c7ec69b4a4f2c8b5a5934f10d88ae28654338033326d43bf6be8710d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@default/default.html.twig", "@default/login.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@default/default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function block_content($context, array $blocks = array())
    {
        // line 2
        echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-6 col-md-offset-3\">
            <h3>Connexion</h3>
            <form name=\"login\" method=\"post\" action=\"\">
                <div class=\"form-group\">
                    <label for=\"inputUsernameEmail\">Indetifiant ou email</label>
                    <input type=\"text\" class=\"form-control\" name=\"emailid\" id=\"inputUsernameEmail\">
                </div>
                <div class=\"form-group\">
                    <a class=\"pull-right\" href=\"#\">Mot de passe oubliez ?</a>
                    <label for=\"inputPassword\">Mot de passe</label>
                    <input type=\"password\" class=\"form-control\" name=\"password\" id=\"inputPassword\">
                </div>
                <div class=\"checkbox pull-left\">
                    <label>
                        <input type=\"checkbox\">Se souvenir de moi</label>
                </div>
                <input type=\"submit\" name=\"login\" class=\"btn btn-primary pull-right\" value=\"Connexion\" />
            </form>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@default/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 2,  11 => 1,);
    }
}
/* {% extends "@default/default.html.twig" %} {% block content %}*/
/* <div class="container">*/
/*     <div class="row">*/
/*         <div class="col-md-6 col-md-offset-3">*/
/*             <h3>Connexion</h3>*/
/*             <form name="login" method="post" action="">*/
/*                 <div class="form-group">*/
/*                     <label for="inputUsernameEmail">Indetifiant ou email</label>*/
/*                     <input type="text" class="form-control" name="emailid" id="inputUsernameEmail">*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <a class="pull-right" href="#">Mot de passe oubliez ?</a>*/
/*                     <label for="inputPassword">Mot de passe</label>*/
/*                     <input type="password" class="form-control" name="password" id="inputPassword">*/
/*                 </div>*/
/*                 <div class="checkbox pull-left">*/
/*                     <label>*/
/*                         <input type="checkbox">Se souvenir de moi</label>*/
/*                 </div>*/
/*                 <input type="submit" name="login" class="btn btn-primary pull-right" value="Connexion" />*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
