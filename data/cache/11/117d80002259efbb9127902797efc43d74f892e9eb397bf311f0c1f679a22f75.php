<?php

/* @frontend/default.html.twig */
class __TwigTemplate_a6814bb9e8375007fdc45f3637ce005c8708bae3a22b7f3baced1f85a027068a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\" />
        <meta name=\"description\" content=\"Développeur Full stack\" />
        <meta name=\"author\" content=\"Alexis Rouillard\" />
        <meta name=\"keywords\" content=\"alexis rouillard, développeur, php, css, html, symphony, cpp, c, nantes\" />
        <!--[if IE]>
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <![endif]-->
        <title>";
        // line 12
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "</title>
        <!-- CDN  -->
        <link href=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- CUSTOM STYLE  -->
        <link href=\"http://fonts.googleapis.com/css?family=Lato|Montserrat\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 18
        echo $this->env->getExtension('eayo')->getUrl("css/style.css?ver=4.9", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
    </head>
    <body>
        <div id=\"wrapper\">
            <div id=\"header\">
                <img data-src=\"https://unsplash.it/800/1500/?random\" class=\"lazyload bg blur-up\" />
                <div class=\"title\">
                    <div class=\"title-header\">
                        <img src=\"";
        // line 32
        echo $this->env->getExtension('eayo')->getUrl("avatar/4875.jpg", "UPLOAD");
        echo "\" />
                    </div>
                    <p>
                        Alexis Rouillard<br>
                        <span class=\"label label-primary\">Développeur 'Full stack'</span>
                    </p>
                </div>
                <div class=\"footer\">
                    <p>Background Copyright <a href=\"https://unsplash.com/\">Unsplash</a>.</p>
                </div>
            </div>
            <div id=\"container\">
                ";
        // line 44
        $this->displayBlock('content', $context, $blocks);
        // line 47
        echo "            </div>
            <div id=\"footer\">
                ";
        // line 49
        $this->displayBlock('footer', $context, $blocks);
        // line 52
        echo "            </div>
        </div>
    </body>
    ";
        // line 55
        $this->displayBlock('script', $context, $blocks);
        // line 60
        echo "</html>";
    }

    // line 44
    public function block_content($context, array $blocks = array())
    {
        // line 45
        echo "                    ";
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
                ";
    }

    // line 49
    public function block_footer($context, array $blocks = array())
    {
        // line 50
        echo "                    <span>&copy; Copyright 2015-";
        echo twig_date_format_filter($this->env, "now", "Y");
        echo " Alexis Rouillard.</span>
                ";
    }

    // line 55
    public function block_script($context, array $blocks = array())
    {
        // line 56
        echo "        <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 58
        echo $this->env->getExtension('eayo')->getUrl("js/main.js?ver=5.6", "ASSETS");
        echo "\"></script>
    ";
    }

    public function getTemplateName()
    {
        return "@frontend/default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 58,  118 => 56,  115 => 55,  108 => 50,  105 => 49,  98 => 45,  95 => 44,  91 => 60,  89 => 55,  84 => 52,  82 => 49,  78 => 47,  76 => 44,  61 => 32,  44 => 18,  35 => 12,  22 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="utf-8" />*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />*/
/*         <meta name="description" content="Développeur Full stack" />*/
/*         <meta name="author" content="Alexis Rouillard" />*/
/*         <meta name="keywords" content="alexis rouillard, développeur, php, css, html, symphony, cpp, c, nantes" />*/
/*         <!--[if IE]>*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*         <![endif]-->*/
/*         <title>{{title}}</title>*/
/*         <!-- CDN  -->*/
/*         <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />*/
/*         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />*/
/*         <!-- CUSTOM STYLE  -->*/
/*         <link href="http://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet" type="text/css" />*/
/*         <link href="{{url('css/style.css?ver=4.9', 'ASSETS')}}" rel="stylesheet" type="text/css" />*/
/*         <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->*/
/*         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*         <!--[if lt IE 9]>*/
/*         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>*/
/*         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>*/
/*         <![endif]-->*/
/*     </head>*/
/*     <body>*/
/*         <div id="wrapper">*/
/*             <div id="header">*/
/*                 <img data-src="https://unsplash.it/800/1500/?random" class="lazyload bg blur-up" />*/
/*                 <div class="title">*/
/*                     <div class="title-header">*/
/*                         <img src="{{url('avatar/4875.jpg', 'UPLOAD')}}" />*/
/*                     </div>*/
/*                     <p>*/
/*                         Alexis Rouillard<br>*/
/*                         <span class="label label-primary">Développeur 'Full stack'</span>*/
/*                     </p>*/
/*                 </div>*/
/*                 <div class="footer">*/
/*                     <p>Background Copyright <a href="https://unsplash.com/">Unsplash</a>.</p>*/
/*                 </div>*/
/*             </div>*/
/*             <div id="container">*/
/*                 {% block content %}*/
/*                     {{content}}*/
/*                 {% endblock %}*/
/*             </div>*/
/*             <div id="footer">*/
/*                 {% block footer %}*/
/*                     <span>&copy; Copyright 2015-{{ "now"|date("Y") }} Alexis Rouillard.</span>*/
/*                 {% endblock %}*/
/*             </div>*/
/*         </div>*/
/*     </body>*/
/*     {% block script %}*/
/*         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>*/
/*         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>*/
/*         <script type="text/javascript" src="{{url('js/main.js?ver=5.6', 'ASSETS')}}"></script>*/
/*     {% endblock %}*/
/* </html>*/
