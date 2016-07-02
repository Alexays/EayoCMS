<?php

/* @backend/default.twig */
class __TwigTemplate_06b1f2e33b72c57e8ab4b7d395f2485f672aa0d53a34c2a72d69c6d1a1dde7cd extends Twig_Template
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
            <header class=\"navbar navbar-inverse navbar-static-top\">
                <div class=\"container\">
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\"";
        // line 36
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "admin/\">
                            <img alt=\"Logo EayoCMS\" src=\"";
        // line 37
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "img/logo.png\" height=\"75\" width=\"384\">
                            <p id=\"version\">";
        // line 38
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
        // line 48
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "</span>
                    </div>
                    <div class=\"navbar-collapse collapse\">
                        <ul id=\"menu-top\" class=\"nav navbar-nav navbar-right\">
                            <li class=\"active\"><a href=\"";
        // line 52
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
        // line 65
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "admin/users\">Utilisateurs</a></li>
                            <li><a href=\"forms.html\">Plugins</a></li>
                            <li><a href=\"login.html\">Paramètres</a></li>
                            <li class=\"profile\">
                                <a href=\"#\">
                                    <img width=\"40\" height=\"40\" src=\"";
        // line 70
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "avatar", array());
        echo "\" alt=\"My profile\" class=\"img-circle\">
                                    ";
        // line 71
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
        // line 81
        if ((isset($context["is_markdown"]) ? $context["is_markdown"] : null)) {
            // line 82
            echo "                    ";
            echo $this->env->getExtension('markdown')->parseMarkdown((isset($context["content"]) ? $context["content"] : null));
            echo "
                    ";
        } else {
            // line 84
            echo "                    ";
            echo (isset($context["content"]) ? $context["content"] : null);
            echo "
                    ";
        }
        // line 86
        echo "                </div>
            </div>
        </section>
        <!-- CONTENT-WRAPPER SECTION END-->
        <footer>
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <strong>Eayo</strong>CMS crée avec <i class=\"fa fa-heart\" aria-hidden=\"true\"></i> par Alexis Rouillard<br><sub>Effectuée en ";
        // line 94
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
        // line 106
        echo (isset($context["assets_url"]) ? $context["assets_url"] : null);
        echo "js/admin.js\"></script>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "@backend/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 106,  161 => 94,  151 => 86,  145 => 84,  139 => 82,  137 => 81,  122 => 71,  117 => 70,  109 => 65,  93 => 52,  86 => 48,  73 => 38,  69 => 37,  65 => 36,  43 => 17,  39 => 16,  33 => 13,  19 => 1,);
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
/*                                 <a href="#">*/
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
/*         <script src="{{assets_url}}js/admin.js"></script>*/
/*     </body>*/
/* </html>*/
/* */
