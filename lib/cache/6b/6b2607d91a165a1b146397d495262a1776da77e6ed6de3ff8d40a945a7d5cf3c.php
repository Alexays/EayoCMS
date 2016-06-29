<?php

/* @admin/default.twig */
class __TwigTemplate_c8e5d353c1a889aea7e283d99bf1e3b840eca1227852fce1c8f3957becd92f4e extends Twig_Template
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
        <title>Admin</title>
        <!-- CDN  -->
        <link href=\"";
        // line 13
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- CUSTOM STYLE  -->
        <link href=\"http://fonts.googleapis.com/css?family=Lato|Montserrat\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 16
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 17
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 18
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "css/waves.min.css\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
<script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
<![endif]-->
    </head>
    <body>
        <section class=\"wrapper\">
            <!-- HEADER -->
            <div class=\"navbar navbar-static-top header\">
                <div class=\"container\">
                   <div class=\"row pull-left\">
                       <div class=\"col-md-12\">
                            Eayo
                        </div>
                   </div>
                    <div class=\"row pull-right\">
                        <div class=\"col-md-12\">
                            <strong>Email: </strong>info@yourdomain.com
                            &nbsp;&nbsp;
                            <strong>Support: </strong>+90-897-678-44
                        </div>
                    </div>
                </div>
            </div>
            <header class=\"navbar navbar-inverse navbar-static-top\">
                <div class=\"container\">
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\"";
        // line 53
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "admin/\">
                            <img alt=\"Logo EayoCMS\" src=\"";
        // line 54
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "img/logo.png\" height=\"75\" width=\"384\">
                            <p id=\"version\">";
        // line 55
        echo (isset($context["version"]) ? $context["version"] : null);
        echo "</p>
                            <p id=\"sub\">Administration</p>
                        </a>
                    </div>
                </div>
            </header>
            <!-- HEADER END-->
            <nav class=\"navbar navbar-default\">
                <div class=\"container\">
                    <div class=\"navbar-header\">
                        <span class=\"navbar-brand page-title\">";
        // line 65
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "</span>
                    </div>
                    <div class=\"navbar-collapse collapse\">
                        <ul id=\"menu-top\" class=\"nav navbar-nav navbar-right\">
                            <li class=\"active\"><a href=\"";
        // line 69
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "admin/\">Tableaux de bord</a></li>
                            <li class=\"dropdown\">
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Pages</a>
                                <ul class=\"dropdown-menu\">
                                    <li><a href=\"#\">Action</a></li>
                                    <li><a href=\"#\">Another action</a></li>
                                    <li><a href=\"#\">Something else here</a></li>
                                    <li role=\"separator\" class=\"divider\"></li>
                                    <li><a href=\"#\">Separated link</a></li>
                                    <li role=\"separator\" class=\"divider\"></li>
                                    <li><a href=\"#\">One more separated link</a></li>
                                </ul>
                            </li>
                            <li><a href=\"";
        // line 82
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "admin/users\">Utilisateurs</a></li>
                            <li><a href=\"forms.html\">Plugins</a></li>
                            <li><a href=\"login.html\">Paramètres</a></li>
                            <li class=\"profile\">
                                <a href=\"blank.html\">
                                    <img width=\"40\" height=\"40\" src=\"";
        // line 87
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "avatar", array());
        echo "\" alt=\"My profile\" class=\"img-circle\">
                                    ";
        // line 88
        echo $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "firstname", array());
        echo " ";
        echo twig_first($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "surname", array()));
        echo ".
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- MENU SECTION END-->
            <div class=\"content-wrapper\">
                <div class=\"container-fluid\">
                    ";
        // line 98
        if ((isset($context["is_markdown"]) ? $context["is_markdown"] : null)) {
            // line 99
            echo "                    ";
            echo $this->env->getExtension('markdown')->parseMarkdown((isset($context["content"]) ? $context["content"] : null));
            echo "
                    ";
        } else {
            // line 101
            echo "                    ";
            echo (isset($context["content"]) ? $context["content"] : null);
            echo "
                    ";
        }
        // line 103
        echo "                </div>
            </div>
        </section>
        <!-- CONTENT-WRAPPER SECTION END-->
        <footer>
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <strong>Eayo</strong>CMS crée avec <i class=\"fa fa-heart\" aria-hidden=\"true\"></i> par Alexis Rouillard<br><sub>Effectuée en ";
        // line 111
        echo (isset($context["load_time"]) ? $context["load_time"] : null);
        echo " secondes</sub>
                    </div>

                </div>
            </div>
        </footer>
        <!-- FOOTER SECTION END-->
        <!-- CORE JQUERY SCRIPTS -->
        <script src=\"http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.js\"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src=\"http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js\"></script>
        <!-- Admin SCRIPTS  -->
        <script src=\"";
        // line 123
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "js/waves.min.js\"></script>
        <script src=\"";
        // line 124
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "js/admin.js\"></script>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "@admin/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 124,  196 => 123,  181 => 111,  171 => 103,  165 => 101,  159 => 99,  157 => 98,  142 => 88,  137 => 87,  129 => 82,  113 => 69,  106 => 65,  93 => 55,  89 => 54,  85 => 53,  47 => 18,  43 => 17,  39 => 16,  33 => 13,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html xmlns="http://www.w3.org/1999/xhtml">*/
/*     <head>*/
/*         <meta charset="utf-8" />*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />*/
/*         <meta name="description" content="" />*/
/*         <meta name="author" content="" />*/
/*         <!--[if IE]>*/
/* <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/* <![endif]-->*/
/*         <title>Admin</title>*/
/*         <!-- CDN  -->*/
/*         <link href="{{assets_url}}css/bootstrap.min.css" rel="stylesheet" type="text/css" />*/
/*         <!-- CUSTOM STYLE  -->*/
/*         <link href="http://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet" type="text/css" />*/
/*         <link href="{{assets_url}}css/style.css" rel="stylesheet" type="text/css" />*/
/*         <link href="{{assets_url}}css/font-awesome.min.css" rel="stylesheet" type="text/css" />*/
/*         <link href="{{assets_url}}css/waves.min.css" rel="stylesheet" type="text/css" />*/
/*         <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->*/
/*         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*         <!--[if lt IE 9]>*/
/* <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>*/
/* <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>*/
/* <![endif]-->*/
/*     </head>*/
/*     <body>*/
/*         <section class="wrapper">*/
/*             <!-- HEADER -->*/
/*             <div class="navbar navbar-static-top header">*/
/*                 <div class="container">*/
/*                    <div class="row pull-left">*/
/*                        <div class="col-md-12">*/
/*                             Eayo*/
/*                         </div>*/
/*                    </div>*/
/*                     <div class="row pull-right">*/
/*                         <div class="col-md-12">*/
/*                             <strong>Email: </strong>info@yourdomain.com*/
/*                             &nbsp;&nbsp;*/
/*                             <strong>Support: </strong>+90-897-678-44*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <header class="navbar navbar-inverse navbar-static-top">*/
/*                 <div class="container">*/
/*                     <div class="navbar-header">*/
/*                         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                             <span class="icon-bar"></span>*/
/*                         </button>*/
/*                         <a class="navbar-brand" href="{{base_url}}admin/">*/
/*                             <img alt="Logo EayoCMS" src="{{assets_url}}img/logo.png" height="75" width="384">*/
/*                             <p id="version">{{version}}</p>*/
/*                             <p id="sub">Administration</p>*/
/*                         </a>*/
/*                     </div>*/
/*                 </div>*/
/*             </header>*/
/*             <!-- HEADER END-->*/
/*             <nav class="navbar navbar-default">*/
/*                 <div class="container">*/
/*                     <div class="navbar-header">*/
/*                         <span class="navbar-brand page-title">{{ title }}</span>*/
/*                     </div>*/
/*                     <div class="navbar-collapse collapse">*/
/*                         <ul id="menu-top" class="nav navbar-nav navbar-right">*/
/*                             <li class="active"><a href="{{base_url}}admin/">Tableaux de bord</a></li>*/
/*                             <li class="dropdown">*/
/*                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>*/
/*                                 <ul class="dropdown-menu">*/
/*                                     <li><a href="#">Action</a></li>*/
/*                                     <li><a href="#">Another action</a></li>*/
/*                                     <li><a href="#">Something else here</a></li>*/
/*                                     <li role="separator" class="divider"></li>*/
/*                                     <li><a href="#">Separated link</a></li>*/
/*                                     <li role="separator" class="divider"></li>*/
/*                                     <li><a href="#">One more separated link</a></li>*/
/*                                 </ul>*/
/*                             </li>*/
/*                             <li><a href="{{base_url}}admin/users">Utilisateurs</a></li>*/
/*                             <li><a href="forms.html">Plugins</a></li>*/
/*                             <li><a href="login.html">Paramètres</a></li>*/
/*                             <li class="profile">*/
/*                                 <a href="blank.html">*/
/*                                     <img width="40" height="40" src="{{base_url}}{{user.avatar}}" alt="My profile" class="img-circle">*/
/*                                     {{user.firstname}} {{user.surname | first}}.*/
/*                                 </a>*/
/*                             </li>*/
/*                         </ul>*/
/*                     </div>*/
/*                 </div>*/
/*             </nav>*/
/*             <!-- MENU SECTION END-->*/
/*             <div class="content-wrapper">*/
/*                 <div class="container-fluid">*/
/*                     {% if is_markdown %}*/
/*                     {{markdown(content)}}*/
/*                     {% else %}*/
/*                     {{content}}*/
/*                     {% endif %}*/
/*                 </div>*/
/*             </div>*/
/*         </section>*/
/*         <!-- CONTENT-WRAPPER SECTION END-->*/
/*         <footer>*/
/*             <div class="container">*/
/*                 <div class="row">*/
/*                     <div class="col-md-12">*/
/*                         <strong>Eayo</strong>CMS crée avec <i class="fa fa-heart" aria-hidden="true"></i> par Alexis Rouillard<br><sub>Effectuée en {{load_time}} secondes</sub>*/
/*                     </div>*/
/* */
/*                 </div>*/
/*             </div>*/
/*         </footer>*/
/*         <!-- FOOTER SECTION END-->*/
/*         <!-- CORE JQUERY SCRIPTS -->*/
/*         <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.js"></script>*/
/*         <!-- BOOTSTRAP SCRIPTS  -->*/
/*         <script src="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js"></script>*/
/*         <!-- Admin SCRIPTS  -->*/
/*         <script src="{{assets_url}}js/waves.min.js"></script>*/
/*         <script src="{{assets_url}}js/admin.js"></script>*/
/*     </body>*/
/* </html>*/
/* */
