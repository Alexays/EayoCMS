<?php

/* @default/default.html.twig */
class __TwigTemplate_a6814bb9e8375007fdc45f3637ce005c8708bae3a22b7f3baced1f85a027068a extends Twig_Template
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
<div id=\"wrapper\">
    <div id=\"header\">
      <div class=\"title\">
        <img src=\"https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/11070975_1605684812999217_1259803236234635137_n.jpg?oh=30ae28afdebf2ab4b3a378939e931e8e&oe=5901DA96\" />
        <p>Alexis Rouillard <sup>Tek1</sup></p>
      </div>
        </div>
    <div id=\"container\">
            ";
        // line 34
        $this->displayBlock('content', $context, $blocks);
        // line 37
        echo "        </div>
    <div id=\"footer\">
            ";
        // line 39
        $this->displayBlock('footer', $context, $blocks);
        // line 42
        echo "        </div>
  </div>
    </body>
</html>
";
    }

    // line 34
    public function block_content($context, array $blocks = array())
    {
        // line 35
        echo "                ";
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
            ";
    }

    // line 39
    public function block_footer($context, array $blocks = array())
    {
        // line 40
        echo "            <span>&copy; Copyright 2016 Alexis Rouillard.</span>
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
        return array (  97 => 40,  94 => 39,  87 => 35,  84 => 34,  76 => 42,  74 => 39,  70 => 37,  68 => 34,  48 => 17,  44 => 16,  38 => 13,  33 => 11,  21 => 1,);
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
/* <div id="wrapper">*/
/*     <div id="header">*/
/*       <div class="title">*/
/*         <img src="https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/11070975_1605684812999217_1259803236234635137_n.jpg?oh=30ae28afdebf2ab4b3a378939e931e8e&oe=5901DA96" />*/
/*         <p>Alexis Rouillard <sup>Tek1</sup></p>*/
/*       </div>*/
/*         </div>*/
/*     <div id="container">*/
/*             {% block content %}*/
/*                 {{content}}*/
/*             {% endblock %}*/
/*         </div>*/
/*     <div id="footer">*/
/*             {% block footer %}*/
/*             <span>&copy; Copyright 2016 Alexis Rouillard.</span>*/
/*             {% endblock %}*/
/*         </div>*/
/*   </div>*/
/*     </body>*/
/* </html>*/
/* */
