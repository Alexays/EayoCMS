<?php

/* @default/login/register.twig */
class __TwigTemplate_ff48e7ad72a176a16a614d21642345fc39e33b48df17c671c837523ccae21c0b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@default/default.html.twig", "@default/login/register.twig", 1);
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
            <h3>Inscription</h3>
            <form name=\"register\" method=\"post\" action=\"\">
                <div class=\"row\">
                    <div class=\"form-group col-md-6\">
                        <label for=\"inputFirstname\">Prénom</label>
                        <input type=\"text\" class=\"form-control\" name=\"firstname\" id=\"inputFirstname\" />
                    </div>
                       <div class=\"form-group col-md-6\">
                        <label for=\"inputLastname\">Nom</label>
                        <input type=\"text\" class=\"form-control\" name=\"lastname\" id=\"inputLastname\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"inputUsername\">Indentifiant</label>
                    <input type=\"text\" class=\"form-control\" name=\"username\" id=\"inputUsername\" />
                </div>
                <div class=\"form-group\">
                    <label for=\"inputUsername\">E-mail</label>
                    <input type=\"text\" class=\"form-control\" name=\"email\" id=\"inputEmail\" />
                </div>
                <div class=\"form-group\">
                    <label for=\"inputPassword\">Mot de passe</label>
                    <input type=\"password\" class=\"form-control\" name=\"password\" id=\"inputPassword\" />
                </div>
                <div class=\"form-group\">
                    <label for=\"inputPassword\">Confirmez le mot de passe</label>
                    <input type=\"password\" class=\"form-control\" name=\"password\" id=\"inputPassword2\" />
                </div>
                <input type=\"submit\" name=\"register\" class=\"btn btn-warning pull-right\" value=\"Inscription\" />
            </form>
            <a href=\"";
        // line 35
        echo $this->env->getExtension('eayo')->getUrl("login");
        echo "\">Déjà inscrit, clique ici pour te connecter !</a>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@default/login/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 35,  30 => 2,  11 => 1,);
    }
}
/* {% extends "@default/default.html.twig" %} {% block content %}*/
/* <div class="container">*/
/*     <div class="row">*/
/*         <div class="col-md-6 col-md-offset-3">*/
/*             <h3>Inscription</h3>*/
/*             <form name="register" method="post" action="">*/
/*                 <div class="row">*/
/*                     <div class="form-group col-md-6">*/
/*                         <label for="inputFirstname">Prénom</label>*/
/*                         <input type="text" class="form-control" name="firstname" id="inputFirstname" />*/
/*                     </div>*/
/*                        <div class="form-group col-md-6">*/
/*                         <label for="inputLastname">Nom</label>*/
/*                         <input type="text" class="form-control" name="lastname" id="inputLastname" />*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <label for="inputUsername">Indentifiant</label>*/
/*                     <input type="text" class="form-control" name="username" id="inputUsername" />*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <label for="inputUsername">E-mail</label>*/
/*                     <input type="text" class="form-control" name="email" id="inputEmail" />*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <label for="inputPassword">Mot de passe</label>*/
/*                     <input type="password" class="form-control" name="password" id="inputPassword" />*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <label for="inputPassword">Confirmez le mot de passe</label>*/
/*                     <input type="password" class="form-control" name="password" id="inputPassword2" />*/
/*                 </div>*/
/*                 <input type="submit" name="register" class="btn btn-warning pull-right" value="Inscription" />*/
/*             </form>*/
/*             <a href="{{url('login')}}">Déjà inscrit, clique ici pour te connecter !</a>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
