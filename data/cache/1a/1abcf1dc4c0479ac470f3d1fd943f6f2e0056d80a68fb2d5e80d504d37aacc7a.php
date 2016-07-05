<?php

/* @backend_views/\users\index.twig */
class __TwigTemplate_26badf8c8a29b60f90525a21423d19d9d4cb3bb6b4ff63ac86428cef74634318 extends Twig_Template
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
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["mainCtrl"]) ? $context["mainCtrl"] : null), "UserList", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["key"] => $context["user"]) {
            // line 14
            echo "            <tr>
                <th>
                    <img src=\"";
            // line 16
            echo (isset($context["uploads_url"]) ? $context["uploads_url"] : null);
            echo "avatar/default-0.png\" width=45 height=45 class=\"img-circle avatar\">
                    <a href=\"user-profile.html\" class=\"name\">";
            // line 17
            echo $this->getAttribute($context["user"], "username", array());
            echo " <span>#";
            echo $context["key"];
            echo "</span></a>
                    <span class=\"subtext\">Développeur</span>
                </th>
                <th>";
            // line 20
            echo twig_date_format_filter($this->env, $this->getAttribute($context["user"], "signup", array()));
            echo "</th>
                <th>";
            // line 21
            echo $this->getAttribute($context["user"], "email", array());
            echo "</th>
                <th>
                    <div class=\"btn-group\" role=\"group\" aria-label=\"Action\">
                        <button type=\"button\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>
                        <button type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
                    </div>
                </th>
            </tr>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 30
            echo "            <span>Un problèmes est survenue.</span>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "        </tbody>
    </table>
    <!-- USER MODAL (EDIT) -->
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
        return "@backend_views/\\users\\index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 32,  72 => 30,  58 => 21,  54 => 20,  46 => 17,  42 => 16,  38 => 14,  33 => 13,  19 => 1,);
    }
}
/* <div class="container-fluid users-list">*/
/*    <!-- USER TABLE -->*/
/*     <table class="table table-hover">*/
/*         <thead>*/
/*             <tr>*/
/*                 <th>Nom</th>*/
/*                 <th>Dâte d'enregistrement</th>*/
/*                 <th>E-mail</th>*/
/*                 <th>Action</th>*/
/*             </tr>*/
/*         </thead>*/
/*         <tbody>*/
/*             {% for key, user in mainCtrl.UserList %}*/
/*             <tr>*/
/*                 <th>*/
/*                     <img src="{{uploads_url}}avatar/default-0.png" width=45 height=45 class="img-circle avatar">*/
/*                     <a href="user-profile.html" class="name">{{ user.username }} <span>#{{ key }}</span></a>*/
/*                     <span class="subtext">Développeur</span>*/
/*                 </th>*/
/*                 <th>{{ user.signup | date }}</th>*/
/*                 <th>{{ user.email }}</th>*/
/*                 <th>*/
/*                     <div class="btn-group" role="group" aria-label="Action">*/
/*                         <button type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>*/
/*                         <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>*/
/*                     </div>*/
/*                 </th>*/
/*             </tr>*/
/*             {% else %}*/
/*             <span>Un problèmes est survenue.</span>*/
/*             {% endfor %}*/
/*         </tbody>*/
/*     </table>*/
/*     <!-- USER MODAL (EDIT) -->*/
/*     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">*/
/*         <div class="modal-dialog modal-lg">*/
/*             <div class="modal-content">*/
/*                 ...*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
