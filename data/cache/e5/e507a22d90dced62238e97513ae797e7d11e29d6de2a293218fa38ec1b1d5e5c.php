<?php

/* @frontend/default.html.twig */
class __TwigTemplate_bc0bfd301570f5eeff43ed5556aea7cb5c75ef210db311d42c87d769da3c9ef3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'footer' => array($this, 'block_footer'),
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\"/>
        <meta name=\"description\" content=\"Développeur DevOps\"/>
        <meta name=\"author\" content=\"Alexis Rouillard\"/>
        <meta name=\"keywords\" content=\"alexis rouillard, développeur, php, css, html, symphony, cpp, c, nantes\"/>
        <!--[if IE]> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"> <![endif]-->
        <title>";
        // line 10
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "</title>
        <!-- CDN -->
        <link href=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
        <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
        <!-- CUSTOM STYLE -->
        <link href=\"https://fonts.googleapis.com/css?family=Exo\" rel=\"stylesheet\">
        <link href=\"";
        // line 16
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("css/style.css?v=2.0", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\"/>
        <link href=\"";
        // line 17
        echo $this->env->getExtension('Core\TwigExtension')->getUrl("css/media.css?v=1.0", "ASSETS");
        echo "\" rel=\"stylesheet\" type=\"text/css\"/>
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]> <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script> <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script> <![endif]-->
        ";
        // line 21
        $this->displayBlock('styles', $context, $blocks);
        // line 22
        echo "    </head>
    <body>
        <div class=\"header-left\">
            <img data-src=\"https://source.unsplash.com/640x360/?nature,water\" class=\"lazyload bg blur-up\"/>
            <div class=\"container-fluid h-100\">
                <div class=\"row h-100\">
                    <div class=\"col-md-12 text-center divImg\">
                        <div class=\"img\"></div>
                        <div class=\"textAbout\">
                            <p>I'm
                                <strong>Alexis Rouillard</strong><br>
                                <small>French DevOps
                                    <strong>Developer</strong>
                                </small>
                            </p>
                            <section class=\"section\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" class=\"svg-filters\">
                                    <defs>
                                        <filter id=\"filter-glitch-2\">
                                            <feturbulence type=\"fractalNoise\" basefrequency=\"0.000001\" numoctaves=\"1\" result=\"warp\"></feturbulence>
                                            <feoffset dx=\"-90\" dy=\"-90\" result=\"warpOffset\"></feoffset>
                                            <fedisplacementmap xchannelselector=\"R\" ychannelselector=\"G\" scale=\"30\" in=\"SourceGraphic\" in2=\"warpOffset\"></fedisplacementmap>
                                        </filter>
                                    </defs>
                                </svg>
                                <a id=\"mylink\" href=\"mailto:contact@arouillard.fr\">
                                    <button id=\"component-10\" class=\"button button--6\">Let's Talk Something
                                        <i class=\"fa fa-envelope fa-lg\"></i>
                                    </button>
                                </a>
                            </section>
                        </div>
                        <div class=\"icons\">
                            <a target=\"_blank\" href=\"https://www.linkedin.com/in/alexis-rouillard-49a590143/\">
                                <i class=\"fa fa-md fa-linkedin\" aria-hidden=\"true\"></i>
                            </a>
                            <a target=\"_blank\" href=\"https://github.com/Alexays\">
                                <i class=\"fa fa-md fa-github\" aria-hidden=\"true\"></i>
                            </a>
                        </div>
                    </div>
                    <div class=\"col-md-12 text-center\">
                        <div class=\"footer\">
                            ";
        // line 65
        $this->displayBlock('footer', $context, $blocks);
        // line 72
        echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"header-right\">
            ";
        // line 78
        $this->displayBlock('content', $context, $blocks);
        // line 81
        echo "        </div>
    </body>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.0.1/lazysizes.min.js\"></script>
    ";
        // line 85
        $this->displayBlock('scripts', $context, $blocks);
        // line 86
        echo "</html>
";
    }

    // line 21
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 65
    public function block_footer($context, array $blocks = array())
    {
        // line 66
        echo "                                <span>&copy; Copyright 2014-";
        echo twig_date_format_filter($this->env, "now", "Y");
        echo "
                                    <span class=\"text-light\">Alexis Rouillard</span><br/>
                                    &copy; Background Copyright
                                    <a class=\"text-light\" target=\"_blank\" href=\"https://unsplash.com/\">Unsplash</a>
                                </span>
                            ";
    }

    // line 78
    public function block_content($context, array $blocks = array())
    {
        // line 79
        echo "                ";
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
            ";
    }

    // line 85
    public function block_scripts($context, array $blocks = array())
    {
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
        return array (  155 => 85,  148 => 79,  145 => 78,  134 => 66,  131 => 65,  126 => 21,  121 => 86,  119 => 85,  113 => 81,  111 => 78,  103 => 72,  101 => 65,  56 => 22,  54 => 21,  47 => 17,  43 => 16,  34 => 10,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\"/>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\"/>
        <meta name=\"description\" content=\"Développeur DevOps\"/>
        <meta name=\"author\" content=\"Alexis Rouillard\"/>
        <meta name=\"keywords\" content=\"alexis rouillard, développeur, php, css, html, symphony, cpp, c, nantes\"/>
        <!--[if IE]> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"> <![endif]-->
        <title>{{title}}</title>
        <!-- CDN -->
        <link href=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
        <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
        <!-- CUSTOM STYLE -->
        <link href=\"https://fonts.googleapis.com/css?family=Exo\" rel=\"stylesheet\">
        <link href=\"{{url('css/style.css?v=2.0', 'ASSETS')}}\" rel=\"stylesheet\" type=\"text/css\"/>
        <link href=\"{{url('css/media.css?v=1.0', 'ASSETS')}}\" rel=\"stylesheet\" type=\"text/css\"/>
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]> <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script> <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script> <![endif]-->
        {% block styles %}{% endblock %}
    </head>
    <body>
        <div class=\"header-left\">
            <img data-src=\"https://source.unsplash.com/640x360/?nature,water\" class=\"lazyload bg blur-up\"/>
            <div class=\"container-fluid h-100\">
                <div class=\"row h-100\">
                    <div class=\"col-md-12 text-center divImg\">
                        <div class=\"img\"></div>
                        <div class=\"textAbout\">
                            <p>I'm
                                <strong>Alexis Rouillard</strong><br>
                                <small>French DevOps
                                    <strong>Developer</strong>
                                </small>
                            </p>
                            <section class=\"section\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" class=\"svg-filters\">
                                    <defs>
                                        <filter id=\"filter-glitch-2\">
                                            <feturbulence type=\"fractalNoise\" basefrequency=\"0.000001\" numoctaves=\"1\" result=\"warp\"></feturbulence>
                                            <feoffset dx=\"-90\" dy=\"-90\" result=\"warpOffset\"></feoffset>
                                            <fedisplacementmap xchannelselector=\"R\" ychannelselector=\"G\" scale=\"30\" in=\"SourceGraphic\" in2=\"warpOffset\"></fedisplacementmap>
                                        </filter>
                                    </defs>
                                </svg>
                                <a id=\"mylink\" href=\"mailto:contact@arouillard.fr\">
                                    <button id=\"component-10\" class=\"button button--6\">Let's Talk Something
                                        <i class=\"fa fa-envelope fa-lg\"></i>
                                    </button>
                                </a>
                            </section>
                        </div>
                        <div class=\"icons\">
                            <a target=\"_blank\" href=\"https://www.linkedin.com/in/alexis-rouillard-49a590143/\">
                                <i class=\"fa fa-md fa-linkedin\" aria-hidden=\"true\"></i>
                            </a>
                            <a target=\"_blank\" href=\"https://github.com/Alexays\">
                                <i class=\"fa fa-md fa-github\" aria-hidden=\"true\"></i>
                            </a>
                        </div>
                    </div>
                    <div class=\"col-md-12 text-center\">
                        <div class=\"footer\">
                            {% block footer %}
                                <span>&copy; Copyright 2014-{{ \"now\"|date(\"Y\") }}
                                    <span class=\"text-light\">Alexis Rouillard</span><br/>
                                    &copy; Background Copyright
                                    <a class=\"text-light\" target=\"_blank\" href=\"https://unsplash.com/\">Unsplash</a>
                                </span>
                            {% endblock %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"header-right\">
            {% block content %}
                {{content}}
            {% endblock %}
        </div>
    </body>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.0.1/lazysizes.min.js\"></script>
    {% block scripts %}{% endblock %}
</html>
", "@frontend/default.html.twig", "/srv/dev-disk-by-id-mmc-SE16G_0x43c0db87-part3/arouillard.fr/apps/frontend/themes/default/default.html.twig");
    }
}
