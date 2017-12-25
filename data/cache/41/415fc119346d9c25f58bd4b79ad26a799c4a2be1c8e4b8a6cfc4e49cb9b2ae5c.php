<?php

/* @backend_views/users/index.twig */
class __TwigTemplate_20b03bfc1f591f4971323204f987fb2a3e56d64c71bbdd125ceba59382bc8f9f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@backend/default.html.twig", "@backend_views/users/index.twig", 1);
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
        echo "<div class=\"container-fluid users-list\">
   <!-- USER TABLE -->
    <table class=\"table table-hover\">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Dâte d'enregistrement</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["users"]) ? $context["users"] : null), "UserList", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["user"]) {
            // line 17
            echo "            <tr>
                <th>
                    <img src=\"";
            // line 19
            echo $this->env->getExtension('Core\TwigExtension')->getUrl("avatar/default-0.png", "UPLOAD");
            echo "\" width=45 height=45 class=\"img-circle avatar\">
                    <a href=\"user-profile.html\" class=\"name\">";
            // line 20
            echo $this->getAttribute($context["user"], "username", array());
            echo " <span>#";
            echo $context["key"];
            echo "</span></a>
                    <span class=\"subtext\">Développeur</span>
                </th>
                <th>";
            // line 23
            echo twig_date_format_filter($this->env, $this->getAttribute($context["user"], "signup", array()));
            echo "</th>
                <th>";
            // line 24
            echo $this->getAttribute($context["user"], "email", array());
            echo "</th>
                <th>
                    <div class=\"btn-group\" role=\"group\" aria-label=\"Action\">
                        <a href=\"";
            // line 27
            echo $this->env->getExtension('Core\TwigExtension')->getUrl("admin/users/edit:");
            echo $context["key"];
            echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>
                        <a class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                    </div>
                </th>
            </tr>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 33
            echo "            <span>Un problèmes est survenue.</span>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "        </tbody>
    </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "@backend_views/users/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 35,  88 => 33,  76 => 27,  70 => 24,  66 => 23,  58 => 20,  54 => 19,  50 => 17,  45 => 16,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"@backend/default.html.twig\" %}

{% block content %}
<div class=\"container-fluid users-list\">
   <!-- USER TABLE -->
    <table class=\"table table-hover\">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Dâte d'enregistrement</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {% for key, user in users.UserList %}
            <tr>
                <th>
                    <img src=\"{{url('avatar/default-0.png', 'UPLOAD')}}\" width=45 height=45 class=\"img-circle avatar\">
                    <a href=\"user-profile.html\" class=\"name\">{{ user.username }} <span>#{{ key }}</span></a>
                    <span class=\"subtext\">Développeur</span>
                </th>
                <th>{{ user.signup | date }}</th>
                <th>{{ user.email }}</th>
                <th>
                    <div class=\"btn-group\" role=\"group\" aria-label=\"Action\">
                        <a href=\"{{url('admin/users/edit:')}}{{key}}\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>
                        <a class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                    </div>
                </th>
            </tr>
            {% else %}
            <span>Un problèmes est survenue.</span>
            {% endfor %}
        </tbody>
    </table>
</div>
{% endblock %}
", "@backend_views/users/index.twig", "/media/fa36508a-b3c4-4499-b30a-711dd5994225/arouillard.fr/apps/backend/views/users/index.twig");
    }
}
