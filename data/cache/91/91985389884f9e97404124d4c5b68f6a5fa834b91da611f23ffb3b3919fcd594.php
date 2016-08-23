<?php

/* @kiCkila/default.html.twig */
class __TwigTemplate_58e919d01a20260ccd9ef86144895a11ab24419eb0c7b32f6d9efd7cbfece55a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["myItems"] = $this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "myItem", array());
        // line 2
        echo "<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\">
    <head>
        <meta charset=\"utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\" />
        <meta name=\"description\" content=\"\" />
        <meta name=\"author\" content=\"\" />
        <!--[if IE]>
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <![endif]-->
        <title>kiCkila</title>
        <!-- CDN  -->
        <link href=\"";
        // line 14
        echo $this->env->getExtension('eayo')->getUrl("css/bootstrap.min.css", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- CUSTOM STYLE  -->
        <link href=\"http://fonts.googleapis.com/css?family=Lato|Montserrat\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 18
        echo $this->env->getExtension('eayo')->getUrl("css/style.css", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 19
        echo $this->env->getExtension('eayo')->getUrl("css/font-awesome.min.css", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body>
        <main class=\"app-main\">
            <nav class=\"app-nav navbar navbar-inverse navbar-fixed-top no-pm\">
                <div class=\"container-fluid\">
                    <div class=\"navbar-header\">
                        ";
        // line 32
        if ( !twig_test_empty((isset($context["user"]) ? $context["user"] : null))) {
            // line 33
            echo "                        <button type=\"button\" class=\"navbar-toggle collapsed pull-left hidden-xs\" data-toggle=\"offcanvas\">
                            <span class=\"sr-only\">Toggle sidebar</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <button type=\"button\" class=\"navbar-toggle collapsed pull-left visible-xs\" data-toggle=\"left-sidebar\">
                            <span class=\"sr-only\">Toggle sidebar</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        ";
        }
        // line 46
        echo "                        <div class=\"navbar-brand hidden-xs\">
                            kiCkila
                        </div>
                        ";
        // line 49
        if ( !twig_test_empty((isset($context["user"]) ? $context["user"] : null))) {
            // line 50
            echo "                        <button type=\"button\" class=\"navbar-toggle collapsed pull-right visible-xs\" style=\"margin-right:0\" data-toggle=\"right-sidebar\">
                            <span class=\"sr-only\">Toggle sidebar</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a href=\"#\" class=\"navbar-text profile collapsed pull-right\">
                            <img width=\"40\" height=\"40\" src=\"";
            // line 57
            echo $this->env->getExtension('eayo')->getUrl($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "avatar", array()));
            echo "\" alt=\"My profile\" class=\"img-circle\">
                            <span class=\"hidden-xs\">";
            // line 58
            echo $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "firstname", array());
            echo " ";
            echo twig_first($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "lastname", array()));
            echo ".</span>
                        </a>
                        ";
        } else {
            // line 61
            echo "                        <form class=\"navbar-form\">
                            <button type=\"button\" class=\"btn btn-default pull-right\">Connexion</button>
                            <button type=\"button\" class=\"btn btn-warning pull-right\" style=\"margin: 0 10px;\">S'enregistrer</button>
                        </form>
                        ";
        }
        // line 66
        echo "                        <center>
                            <form class=\"navbar-form collapsed\" role=\"search\">
                                <div class=\"form-group\" style=\"width:35%;\">
                                    <input type=\"text\" style=\"width:100%;\" class=\"form-control hidden-xs\" placeholder=\"Tapez votre recherche ici...\">
                                    <input type=\"text\" style=\"width:100%;\" class=\"form-control visible-xs\" placeholder=\"Rechercher...\">
                                </div>
                            </form>
                        </center>
                    </div>
                </div>
            </nav>
            <!-- MENU SECTION END-->
            <div class=\"wrapper\">
                ";
        // line 79
        if ( !twig_test_empty((isset($context["user"]) ? $context["user"] : null))) {
            // line 80
            echo "                <aside class=\"sidebar left\">
                    <div class=\"item text-center\">
                        <div class=\"btn-group\" id=\"menuItem\">
                            <div class=\"dropdown\">
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\">
                                    Mes Objects
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">
                                    <li><a data-target=\"ajax\" href=\"";
            // line 88
            echo $this->env->getExtension('eayo')->getUrl("items/add_item", "APP");
            echo "\">Ajouter un objet</a></li>
                                </ul>
                            </div>
                            <div class=\"dropdown\" id=\"option\">
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\">
                                    <i class=\"fa fa-cogs\"></i>
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">
                                    <li><a href=\"#\">Trier</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"item-panel\">
                            <div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                <div class=\"panel panel-default\">
                                    <div class=\"panel-heading\" role=\"tab\" id=\"headingReserved\" data-toggle=\"collapse\" data-target=\"#collapseReserved\">
                                        <h4 class=\"panel-title\">
                                            <a role=\"button\" href=\"#collapseReserved\" aria-expanded=\"true\" aria-controls=\"collapseReserved\">
                                                Réservé
                                            </a>
                                        </h4>
                                    </div>
                                    <div id=\"collapseReserved\" class=\"panel-collapse collapse ";
            // line 110
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["myItems"]) ? $context["myItems"] : null), "taken", array())) > 0)) {
                echo "in";
            }
            echo "\" role=\"tabpanel\" aria-labelledby=\"headingReserved\">
                                        <div class=\"panel-body\">
                                            <ul class=\"itemlist\">
                                                ";
            // line 113
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["myItems"]) ? $context["myItems"] : null), "taken", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 114
                echo "                                                <li>
                                                    <a data-target=\"ajax\" href=\"";
                // line 115
                echo $this->env->getExtension('eayo')->getUrl("kiCkila/items/view_item:");
                echo $context["key"];
                echo "\">";
                echo $this->getAttribute($context["item"], "name", array());
                echo "</a> <i>détenu(e) par <b>";
                echo $this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "UserName", array(0 => $this->getAttribute($context["item"], "holder", array())), "method");
                echo "</b></i>
                                                    <span class=\"sub\">Depuis le ";
                // line 116
                echo twig_date_format_filter($this->env, $this->getAttribute($context["item"], "hold_date", array()));
                echo "</span>
                                                    <hr>
                                                </li>
                                                ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 120
                echo "                                                <p>Vous n'avez pas d'objet réservé</p>
                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo "                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                <div class=\"panel panel-default\">
                                    <div class=\"panel-heading\" role=\"tab\" id=\"headingEmpty\" data-toggle=\"collapse\" data-target=\"#collapseEmpty\">
                                        <h4 class=\"panel-title\">
                                            <a role=\"button\" href=\"#collapseEmpty\" aria-expanded=\"true\" aria-controls=\"collapseEmpty\">
                                                Disponible
                                            </a>
                                        </h4>
                                    </div>
                                    <div id=\"collapseEmpty\" class=\"panel-collapse collapse ";
            // line 136
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["myItems"]) ? $context["myItems"] : null), "available", array())) > 0)) {
                echo "in";
            }
            echo "\" role=\"tabpanel\" aria-labelledby=\"headingEmpty\">
                                        <div class=\"panel-body\">
                                            <ul class=\"itemlist\">
                                                ";
            // line 139
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["myItems"]) ? $context["myItems"] : null), "available", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 140
                echo "                                                        <li>
                                                            <a data-target=\"ajax\" href=\"";
                // line 141
                echo $this->env->getExtension('eayo')->getUrl("kiCkila/items/view_item:");
                echo $context["key"];
                echo "\">";
                echo $this->getAttribute($context["item"], "name", array());
                echo "</a> | Depuis le ";
                echo twig_date_format_filter($this->env, $this->getAttribute($context["item"], "hold_date", array()));
                echo "
                                                            <hr>
                                                        </li>
                                                ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 145
                echo "                                                    <p>Vous n'avez pas d'objet disponible</p>
                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 147
            echo "                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                <div class=\"panel panel-default\">
                                    <div class=\"panel-heading\" role=\"tab\" id=\"headingUnavailable\" data-toggle=\"collapse\" data-target=\"#collapseUnavailable\">
                                        <h4 class=\"panel-title\">
                                            <a role=\"button\" href=\"#collapseUnavailable\" aria-expanded=\"true\" aria-controls=\"collapseEmpty\">
                                                Indisponible
                                            </a>
                                        </h4>
                                    </div>
                                    <div id=\"collapseUnavailable\" class=\"panel-collapse collapse ";
            // line 161
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["myItems"]) ? $context["myItems"] : null), "unavailable", array())) > 0)) {
                echo "in";
            }
            echo "\" role=\"tabpanel\" aria-labelledby=\"headingUnavailable\">
                                        <div class=\"panel-body\">
                                            <ul class=\"itemlist\">
                                                ";
            // line 164
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["myItems"]) ? $context["myItems"] : null), "unavailable", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 165
                echo "                                                <li>
                                                    <a data-target=\"ajax\" href=\"";
                // line 166
                echo $this->env->getExtension('eayo')->getUrl("kiCkila/items/view_item:");
                echo $context["key"];
                echo "\">";
                echo $this->getAttribute($context["item"], "name", array());
                echo "</a> <i>détenu(e) par <b>";
                echo $this->getAttribute((isset($context["kiCkila"]) ? $context["kiCkila"] : null), "UserName", array(0 => $this->getAttribute($context["item"], "holder", array())), "method");
                echo "</b></i>
                                                    <span class=\"sub\">Depuis le ";
                // line 167
                echo twig_date_format_filter($this->env, $this->getAttribute($context["item"], "hold_date", array()));
                echo "</span>
                                                    <hr>
                                                </li>
                                                ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 171
                echo "                                                <p>Vous n'avez pas d'objet indisponible</p>
                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 173
            echo "                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                ";
        }
        // line 182
        echo "                <div class=\"container-fluid\" id=\"main-content\" ";
        if (twig_test_empty((isset($context["user"]) ? $context["user"] : null))) {
            echo "style=\"margin:0\"";
        }
        echo ">
                    ";
        // line 183
        $this->displayBlock('content', $context, $blocks);
        // line 186
        echo "                </div>
                ";
        // line 187
        if ( !twig_test_empty((isset($context["user"]) ? $context["user"] : null))) {
            // line 188
            echo "                <aside class=\"sidebar right\">
                    <div class=\"item text-center\">
                        <div class=\"btn-group\" id=\"menuItem\">
                            <div class=\"dropdown\">
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\">
                                    Mes Emprunts
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">
                                    <li><a href=\"#\">Ajouter un objet</a></li>
                                    <li><a href=\"#\">Another action</a></li>
                                    <li><a href=\"#\">Something else here</a></li>
                                    <li class=\"divider\"></li>
                                    <li><a href=\"#\">Separated link</a></li>
                                </ul>
                            </div>
                            <div class=\"dropdown\" id=\"option\">
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\">
                                    <i class=\"fa fa-cogs\"></i>
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">
                                    <li><a href=\"";
            // line 208
            echo $this->env->getExtension('eayo')->getUrl("assets/kiCkila/view_item:");
            echo (isset($context["key"]) ? $context["key"] : null);
            echo "\" data-toggle=\"modal\" data-target=\"#\">En savoir plus</a></li>
                                    <li><a href=\"#\">Another action</a></li>
                                    <li><a href=\"#\">Something else here</a></li>
                                    <li class=\"divider\"></li>
                                    <li><a href=\"#\">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                ";
        }
        // line 219
        echo "            </div>
        </main>
        <!-- CORE SCRIPTS -->
        <script src=\"http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.js\"></script>
        <script src=\"http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js\"></script>
        <script src=\"https://npmcdn.com/masonry-layout@4.1/dist/masonry.pkgd.min.js\"></script>
        <script src=\"https://code.jquery.com/ui/1.12.0/jquery-ui.js\"></script>
        <!-- Admin SCRIPTS  -->
        <script src=\"";
        // line 227
        echo $this->env->getExtension('eayo')->getUrl("js/kiCkila.js", "ASSETS");
        echo "\"></script>
    </body>
</html>";
    }

    // line 183
    public function block_content($context, array $blocks = array())
    {
        // line 184
        echo "                        ";
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
                    ";
    }

    public function getTemplateName()
    {
        return "@kiCkila/default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  400 => 184,  397 => 183,  390 => 227,  380 => 219,  365 => 208,  343 => 188,  341 => 187,  338 => 186,  336 => 183,  329 => 182,  318 => 173,  311 => 171,  302 => 167,  293 => 166,  290 => 165,  285 => 164,  277 => 161,  261 => 147,  254 => 145,  240 => 141,  237 => 140,  232 => 139,  224 => 136,  208 => 122,  201 => 120,  192 => 116,  183 => 115,  180 => 114,  175 => 113,  167 => 110,  142 => 88,  132 => 80,  130 => 79,  115 => 66,  108 => 61,  100 => 58,  96 => 57,  87 => 50,  85 => 49,  80 => 46,  65 => 33,  63 => 32,  47 => 19,  43 => 18,  36 => 14,  22 => 2,  20 => 1,);
    }
}
/* {% set myItems = kiCkila.myItem %}*/
/* <!DOCTYPE html>*/
/* <html xmlns="http://www.w3.org/1999/xhtml">*/
/*     <head>*/
/*         <meta charset="utf-8" />*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />*/
/*         <meta name="description" content="" />*/
/*         <meta name="author" content="" />*/
/*         <!--[if IE]>*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*         <![endif]-->*/
/*         <title>kiCkila</title>*/
/*         <!-- CDN  -->*/
/*         <link href="{{url('css/bootstrap.min.css', 'ASSETS')}}" rel="stylesheet" type="text/css" />*/
/*         <!-- CUSTOM STYLE  -->*/
/*         <link href="http://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet" type="text/css" />*/
/*         <link href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />*/
/*         <link href="{{url('css/style.css', 'ASSETS')}}" rel="stylesheet" type="text/css" />*/
/*         <link href="{{url('css/font-awesome.min.css', 'ASSETS')}}" rel="stylesheet" type="text/css" />*/
/*         <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->*/
/*         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*         <!--[if lt IE 9]>*/
/*         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>*/
/*         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>*/
/*         <![endif]-->*/
/*     </head>*/
/*     <body>*/
/*         <main class="app-main">*/
/*             <nav class="app-nav navbar navbar-inverse navbar-fixed-top no-pm">*/
/*                 <div class="container-fluid">*/
/*                     <div class="navbar-header">*/
/*                         {% if not user is empty %}*/
/*                         <button type="button" class="navbar-toggle collapsed pull-left hidden-xs" data-toggle="offcanvas">*/
/*                             <span class="sr-only">Toggle sidebar</span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                         </button>*/
/*                         <button type="button" class="navbar-toggle collapsed pull-left visible-xs" data-toggle="left-sidebar">*/
/*                             <span class="sr-only">Toggle sidebar</span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                         </button>*/
/*                         {% endif %}*/
/*                         <div class="navbar-brand hidden-xs">*/
/*                             kiCkila*/
/*                         </div>*/
/*                         {% if not user is empty %}*/
/*                         <button type="button" class="navbar-toggle collapsed pull-right visible-xs" style="margin-right:0" data-toggle="right-sidebar">*/
/*                             <span class="sr-only">Toggle sidebar</span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                         </button>*/
/*                         <a href="#" class="navbar-text profile collapsed pull-right">*/
/*                             <img width="40" height="40" src="{{url(user.avatar)}}" alt="My profile" class="img-circle">*/
/*                             <span class="hidden-xs">{{user.firstname}} {{user.lastname | first}}.</span>*/
/*                         </a>*/
/*                         {% else %}*/
/*                         <form class="navbar-form">*/
/*                             <button type="button" class="btn btn-default pull-right">Connexion</button>*/
/*                             <button type="button" class="btn btn-warning pull-right" style="margin: 0 10px;">S'enregistrer</button>*/
/*                         </form>*/
/*                         {% endif %}*/
/*                         <center>*/
/*                             <form class="navbar-form collapsed" role="search">*/
/*                                 <div class="form-group" style="width:35%;">*/
/*                                     <input type="text" style="width:100%;" class="form-control hidden-xs" placeholder="Tapez votre recherche ici...">*/
/*                                     <input type="text" style="width:100%;" class="form-control visible-xs" placeholder="Rechercher...">*/
/*                                 </div>*/
/*                             </form>*/
/*                         </center>*/
/*                     </div>*/
/*                 </div>*/
/*             </nav>*/
/*             <!-- MENU SECTION END-->*/
/*             <div class="wrapper">*/
/*                 {% if not user is empty %}*/
/*                 <aside class="sidebar left">*/
/*                     <div class="item text-center">*/
/*                         <div class="btn-group" id="menuItem">*/
/*                             <div class="dropdown">*/
/*                                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">*/
/*                                     Mes Objects*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" role="menu">*/
/*                                     <li><a data-target="ajax" href="{{url('items/add_item', 'APP')}}">Ajouter un objet</a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/*                             <div class="dropdown" id="option">*/
/*                                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">*/
/*                                     <i class="fa fa-cogs"></i>*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" role="menu">*/
/*                                     <li><a href="#">Trier</a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="item-panel">*/
/*                             <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">*/
/*                                 <div class="panel panel-default">*/
/*                                     <div class="panel-heading" role="tab" id="headingReserved" data-toggle="collapse" data-target="#collapseReserved">*/
/*                                         <h4 class="panel-title">*/
/*                                             <a role="button" href="#collapseReserved" aria-expanded="true" aria-controls="collapseReserved">*/
/*                                                 Réservé*/
/*                                             </a>*/
/*                                         </h4>*/
/*                                     </div>*/
/*                                     <div id="collapseReserved" class="panel-collapse collapse {% if myItems.taken|length > 0 %}in{% endif %}" role="tabpanel" aria-labelledby="headingReserved">*/
/*                                         <div class="panel-body">*/
/*                                             <ul class="itemlist">*/
/*                                                 {% for key, item in myItems.taken %}*/
/*                                                 <li>*/
/*                                                     <a data-target="ajax" href="{{url('kiCkila/items/view_item:')}}{{key}}">{{item.name}}</a> <i>détenu(e) par <b>{{kiCkila.UserName(item.holder)}}</b></i>*/
/*                                                     <span class="sub">Depuis le {{item.hold_date | date}}</span>*/
/*                                                     <hr>*/
/*                                                 </li>*/
/*                                                 {% else %}*/
/*                                                 <p>Vous n'avez pas d'objet réservé</p>*/
/*                                                 {% endfor %}*/
/*                                             </ul>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">*/
/*                                 <div class="panel panel-default">*/
/*                                     <div class="panel-heading" role="tab" id="headingEmpty" data-toggle="collapse" data-target="#collapseEmpty">*/
/*                                         <h4 class="panel-title">*/
/*                                             <a role="button" href="#collapseEmpty" aria-expanded="true" aria-controls="collapseEmpty">*/
/*                                                 Disponible*/
/*                                             </a>*/
/*                                         </h4>*/
/*                                     </div>*/
/*                                     <div id="collapseEmpty" class="panel-collapse collapse {% if myItems.available|length > 0 %}in{% endif %}" role="tabpanel" aria-labelledby="headingEmpty">*/
/*                                         <div class="panel-body">*/
/*                                             <ul class="itemlist">*/
/*                                                 {% for key, item in myItems.available %}*/
/*                                                         <li>*/
/*                                                             <a data-target="ajax" href="{{url('kiCkila/items/view_item:')}}{{key}}">{{item.name}}</a> | Depuis le {{item.hold_date | date}}*/
/*                                                             <hr>*/
/*                                                         </li>*/
/*                                                 {% else %}*/
/*                                                     <p>Vous n'avez pas d'objet disponible</p>*/
/*                                                 {% endfor %}*/
/*                                             </ul>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">*/
/*                                 <div class="panel panel-default">*/
/*                                     <div class="panel-heading" role="tab" id="headingUnavailable" data-toggle="collapse" data-target="#collapseUnavailable">*/
/*                                         <h4 class="panel-title">*/
/*                                             <a role="button" href="#collapseUnavailable" aria-expanded="true" aria-controls="collapseEmpty">*/
/*                                                 Indisponible*/
/*                                             </a>*/
/*                                         </h4>*/
/*                                     </div>*/
/*                                     <div id="collapseUnavailable" class="panel-collapse collapse {% if myItems.unavailable|length > 0 %}in{% endif %}" role="tabpanel" aria-labelledby="headingUnavailable">*/
/*                                         <div class="panel-body">*/
/*                                             <ul class="itemlist">*/
/*                                                 {% for key, item in myItems.unavailable %}*/
/*                                                 <li>*/
/*                                                     <a data-target="ajax" href="{{url('kiCkila/items/view_item:')}}{{key}}">{{item.name}}</a> <i>détenu(e) par <b>{{kiCkila.UserName(item.holder)}}</b></i>*/
/*                                                     <span class="sub">Depuis le {{item.hold_date | date}}</span>*/
/*                                                     <hr>*/
/*                                                 </li>*/
/*                                                 {% else %}*/
/*                                                 <p>Vous n'avez pas d'objet indisponible</p>*/
/*                                                 {% endfor %}*/
/*                                             </ul>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </aside>*/
/*                 {% endif %}*/
/*                 <div class="container-fluid" id="main-content" {% if user is empty %}style="margin:0"{% endif %}>*/
/*                     {% block content %}*/
/*                         {{content}}*/
/*                     {% endblock %}*/
/*                 </div>*/
/*                 {% if not user is empty %}*/
/*                 <aside class="sidebar right">*/
/*                     <div class="item text-center">*/
/*                         <div class="btn-group" id="menuItem">*/
/*                             <div class="dropdown">*/
/*                                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">*/
/*                                     Mes Emprunts*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" role="menu">*/
/*                                     <li><a href="#">Ajouter un objet</a></li>*/
/*                                     <li><a href="#">Another action</a></li>*/
/*                                     <li><a href="#">Something else here</a></li>*/
/*                                     <li class="divider"></li>*/
/*                                     <li><a href="#">Separated link</a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/*                             <div class="dropdown" id="option">*/
/*                                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">*/
/*                                     <i class="fa fa-cogs"></i>*/
/*                                 </button>*/
/*                                 <ul class="dropdown-menu" role="menu">*/
/*                                     <li><a href="{{url('assets/kiCkila/view_item:')}}{{key}}" data-toggle="modal" data-target="#">En savoir plus</a></li>*/
/*                                     <li><a href="#">Another action</a></li>*/
/*                                     <li><a href="#">Something else here</a></li>*/
/*                                     <li class="divider"></li>*/
/*                                     <li><a href="#">Separated link</a></li>*/
/*                                 </ul>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </aside>*/
/*                 {% endif %}*/
/*             </div>*/
/*         </main>*/
/*         <!-- CORE SCRIPTS -->*/
/*         <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.js"></script>*/
/*         <script src="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js"></script>*/
/*         <script src="https://npmcdn.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script>*/
/*         <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>*/
/*         <!-- Admin SCRIPTS  -->*/
/*         <script src="{{url('js/kiCkila.js', 'ASSETS')}}"></script>*/
/*     </body>*/
/* </html>*/
