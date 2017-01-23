<?php

/* @default/default.html.twig */
class __TwigTemplate_4a7475f9b38c26caddcb866f51d99030306137e98d8b79f468053cca934dee49 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
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
        <meta name=\"description\" content=\"\" />
        <meta name=\"author\" content=\"\" />
        <!--[if IE]>
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <![endif]-->
        <title>";
        // line 11
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "</title>
        <!-- CDN  -->
        <link href=\"";
        // line 13
        echo $this->env->getExtension('eayo')->getUrl("css/bootstrap.min.css", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <!-- CUSTOM STYLE  -->
        <link href=\"http://fonts.googleapis.com/css?family=Lato|Montserrat\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 16
        echo $this->env->getExtension('eayo')->getUrl("css/style.css", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 17
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
        <div id=\"content\">
            ";
        // line 27
        $this->displayBlock('content', $context, $blocks);
        // line 30
        echo "        </div>
        <div id=\"footer\">
            ";
        // line 32
        $this->displayBlock('footer', $context, $blocks);
        // line 35
        echo "        </div>
    </body>
</html>
";
    }

    // line 27
    public function block_content($context, array $blocks = array())
    {
        // line 28
        echo "                ";
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
            ";
    }

    // line 32
    public function block_footer($context, array $blocks = array())
    {
        // line 33
        echo "            <center>&copy; Copyright 2016 Alexis Rouillard.</center>
            ";
    }

    public function getTemplateName()
    {
        return "@default/default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 33,  86 => 32,  79 => 28,  76 => 27,  69 => 35,  67 => 32,  63 => 30,  61 => 27,  48 => 17,  44 => 16,  38 => 13,  33 => 11,  21 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="utf-8" />*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />*/
/*         <meta name="description" content="" />*/
/*         <meta name="author" content="" />*/
/*         <!--[if IE]>*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*         <![endif]-->*/
/*         <title>{{title}}</title>*/
/*         <!-- CDN  -->*/
/*         <link href="{{url('css/bootstrap.min.css', 'ASSETS')}}" rel="stylesheet" type="text/css" />*/
/*         <!-- CUSTOM STYLE  -->*/
/*         <link href="http://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet" type="text/css" />*/
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
/*         <div id="content">*/
/*             {% block content %}*/
/*                 {{content}}*/
/*             {% endblock %}*/
/*         </div>*/
/*         <div id="footer">*/
/*             {% block footer %}*/
/*             <center>&copy; Copyright 2016 Alexis Rouillard.</center>*/
/*             {% endblock %}*/
/*         </div>*/
/*     </body>*/
/* </html>*/
/* */
