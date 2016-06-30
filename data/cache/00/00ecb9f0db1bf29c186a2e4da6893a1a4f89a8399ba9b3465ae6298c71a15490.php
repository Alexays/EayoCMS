<?php

/* @frontend/default.twig */
class __TwigTemplate_ddbfa4e7e94641a34dd97a4172fb86382bce9b84eea4a18ea149d1dd3dbb88ff extends Twig_Template
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
        <div id=\"content\">
            ";
        // line 27
        $this->displayBlock('content', $context, $blocks);
        // line 34
        echo "        </div>
        <div id=\"footer\">
            ";
        // line 36
        $this->displayBlock('footer', $context, $blocks);
        // line 39
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
        if ((isset($context["is_markdown"]) ? $context["is_markdown"] : null)) {
            // line 29
            echo "                    ";
            echo $this->env->getExtension('markdown')->parseMarkdown((isset($context["content"]) ? $context["content"] : null));
            echo "
                ";
        } else {
            // line 31
            echo "                    ";
            echo (isset($context["content"]) ? $context["content"] : null);
            echo "
                ";
        }
        // line 33
        echo "            ";
    }

    // line 36
    public function block_footer($context, array $blocks = array())
    {
        // line 37
        echo "            &copy; Copyright 2011 by <a href=\"http://domain.invalid/\">you</a>.
            ";
    }

    public function getTemplateName()
    {
        return "@frontend/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 37,  98 => 36,  94 => 33,  88 => 31,  82 => 29,  79 => 28,  76 => 27,  69 => 39,  67 => 36,  63 => 34,  61 => 27,  48 => 17,  44 => 16,  38 => 13,  33 => 11,  21 => 1,);
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
/*         <link href="{{assets_url}}css/bootstrap.min.css" rel="stylesheet" type="text/css" />*/
/*         <!-- CUSTOM STYLE  -->*/
/*         <link href="http://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet" type="text/css" />*/
/*         <link href="{{assets_url}}css/style.css" rel="stylesheet" type="text/css" />*/
/*         <link href="{{assets_url}}css/font-awesome.min.css" rel="stylesheet" type="text/css" />*/
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
/*                 {% if is_markdown %}*/
/*                     {{markdown(content)}}*/
/*                 {% else %}*/
/*                     {{content}}*/
/*                 {% endif %}*/
/*             {% endblock %}*/
/*         </div>*/
/*         <div id="footer">*/
/*             {% block footer %}*/
/*             &copy; Copyright 2011 by <a href="http://domain.invalid/">you</a>.*/
/*             {% endblock %}*/
/*         </div>*/
/*     </body>*/
/* </html>*/
/* */
