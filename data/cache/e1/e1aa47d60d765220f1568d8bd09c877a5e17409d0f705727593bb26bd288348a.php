<?php

/* @default/login/index.twig */
class __TwigTemplate_8be89d5b3ac9a1ab51103a86027c81e560d14b90d8c8adedcf58771458b95fc2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@default/default.html.twig", "@default/login/index.twig", 1);
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
        echo "<div class=\"top-content\">
    <div class=\"inner-bg\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-sm-offset-3 form-box\" style=\"margin:auto\">
                    <div class=\"form-top\">
                        <div class=\"form-top-left\">
                            <h3>Se connecter</h3>
                            <p>Entrez vos indentifiant pour vous connecter</p>
                        </div>
                        <div class=\"form-top-right\">
                            <i class=\"fa fa-key\"></i>
                        </div>
                    </div>
                    <div class=\"form-bottom\">
                        <form role=\"form\" action=\"\" method=\"post\" class=\"login-form\">
                            <div class=\"form-group\">
                                <label class=\"sr-only\" for=\"form-username\">Identifiant ou E-mail</label>
                                <input type=\"text\" name=\"emailid\" placeholder=\"Identifiant ou E-mail...\" class=\"form-username form-control\" id=\"form-username\">
                            </div>
                            <div class=\"form-group\">
                                <label class=\"sr-only\" for=\"form-password\">Mot de passe</label>
                                <input type=\"password\" name=\"password\" placeholder=\"Mot de passe...\" class=\"form-password form-control\" id=\"form-password\">
                            </div>
                            <input type=\"submit\" name=\"login\" class=\"btn\" value=\"Connexion\"/>
                            <label class=\"pull-right\" style=\"display: none\">
                                <input type=\"checkbox\" name=\"remember\">Se souvenir de moi
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@default/login/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"@default/default.html.twig\" %} {% block content %}
<div class=\"top-content\">
    <div class=\"inner-bg\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-sm-offset-3 form-box\" style=\"margin:auto\">
                    <div class=\"form-top\">
                        <div class=\"form-top-left\">
                            <h3>Se connecter</h3>
                            <p>Entrez vos indentifiant pour vous connecter</p>
                        </div>
                        <div class=\"form-top-right\">
                            <i class=\"fa fa-key\"></i>
                        </div>
                    </div>
                    <div class=\"form-bottom\">
                        <form role=\"form\" action=\"\" method=\"post\" class=\"login-form\">
                            <div class=\"form-group\">
                                <label class=\"sr-only\" for=\"form-username\">Identifiant ou E-mail</label>
                                <input type=\"text\" name=\"emailid\" placeholder=\"Identifiant ou E-mail...\" class=\"form-username form-control\" id=\"form-username\">
                            </div>
                            <div class=\"form-group\">
                                <label class=\"sr-only\" for=\"form-password\">Mot de passe</label>
                                <input type=\"password\" name=\"password\" placeholder=\"Mot de passe...\" class=\"form-password form-control\" id=\"form-password\">
                            </div>
                            <input type=\"submit\" name=\"login\" class=\"btn\" value=\"Connexion\"/>
                            <label class=\"pull-right\" style=\"display: none\">
                                <input type=\"checkbox\" name=\"remember\">Se souvenir de moi
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "@default/login/index.twig", "/media/fa36508a-b3c4-4499-b30a-711dd5994225/arouillard.fr/apps/frontend/themes/default/login/index.twig");
    }
}
