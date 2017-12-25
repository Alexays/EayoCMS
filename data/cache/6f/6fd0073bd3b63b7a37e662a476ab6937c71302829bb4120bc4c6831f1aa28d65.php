<?php

/* @default_views/index.twig */
class __TwigTemplate_91f150c4940832afb4c3e481114f49ee4d41482574fedf526c1e7baeb22ed2d9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@frontend/default.html.twig", "@default_views/index.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@frontend/default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["title"] = "Alexis Rouillard | Developer";
        // line 3
        $context["head_title"] = "CV";
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <div class=\"container-fluid mt-5\">
        <div class=\"row w-100\">
            <div class=\"col-md-3 col-sm-12 titleText\">
                <span class=\"titleText\">About me</span></div>
            <div class=\"col-md-9 div-text text-about-me\">
                <p>Self-taught developer for six years, self-motivated, ability overcome difficulties and the ability to learn. These skills help me along the way to assimilate new programming and more:</p>
                <ul class=\"skils\">
                    <li>
                        <span>HTML, CSS, LESS, SASS, JavaScript</span></li>
                    <li>
                        <span>Node.JS</span>
                    </li>
                    <li>
                        <span>C, C++, C#, Objective-C</span>
                    </li>
                    <li>
                        <span>Java, Kotlin</span>
                    </li>
                    <li>
                        <span>Python</span>
                    </li>
                    <li>
                        <span>PHP, Symfony</span>
                    </li>
                    <li>
                        <span>Rust</span>
                    </li>
                    <li>
                        <span>Dart, Flutter</span>
                    </li>
                    <li>
                        <span>Angular JS, TypeScript, Ionic</span>
                    </li>
                    <li>
                        <span>React JS, React Native</span>
                    </li>
                    <li>
                        <span>Cisco/HP Routers, Switchs</span>
                    </li>
                    <li>
                        <span>Web Design</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class=\"container-fluid mt-4\">
        <div class=\"row w-100\">
            <div class=\"col-md-3 titleText\">
                <span class=\"titleText\">Education</span></div>
            <div class=\"col-md-9 div-text div-small\">
                <span class=\"bachelor-text\">Master Epitech</span>
                <span class=\"yers\">2016-2021</span>
                <p class=\"software-text\">Expert of Information Technologies</p>
                <span id=\"college\">Baccalauréat Professionnel</span>
                <span class=\"yers\">2013-2016</span>
                <p class=\"software-text\">Systèmes électronique numériques</p>
            </div>
        </div>
    </div>
    <div class=\"container-fluid mt-4\">
        <div class=\"row w-100\">
            <div class=\"col-md-3 titleText\">
                <span class=\"titleText\">Experience</span></div>
            <div class=\"col-md-9 div-text div-small\">
                <span class=\"bachelor-text\">Developer intern</span>
                <span class=\"yers\">2017</span>
                <p class=\"software-text\">LiveE</p>

                <span id=\"college\">Technician intern</span>
                <span class=\"yers\">2015</span>
                <p class=\"software-text\">Polyclinique de l'Atlantique</p>

                <span id=\"college\">Technician intern</span>
                <span class=\"yers\">2015</span>
                <p class=\"software-text\">GFI Informatique</p>
            </div>
        </div>
    </div>
";
    }

    // line 85
    public function block_scripts($context, array $blocks = array())
    {
        // line 86
        echo "    ";
        $this->displayParentBlock("scripts", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "@default_views/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 86,  120 => 85,  37 => 5,  34 => 4,  30 => 1,  28 => 3,  26 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"@frontend/default.html.twig\" %}
{% set title = 'Alexis Rouillard | Developer' %}
{% set head_title = 'CV' %}
{% block content %}
    <div class=\"container-fluid mt-5\">
        <div class=\"row w-100\">
            <div class=\"col-md-3 col-sm-12 titleText\">
                <span class=\"titleText\">About me</span></div>
            <div class=\"col-md-9 div-text text-about-me\">
                <p>Self-taught developer for six years, self-motivated, ability overcome difficulties and the ability to learn. These skills help me along the way to assimilate new programming and more:</p>
                <ul class=\"skils\">
                    <li>
                        <span>HTML, CSS, LESS, SASS, JavaScript</span></li>
                    <li>
                        <span>Node.JS</span>
                    </li>
                    <li>
                        <span>C, C++, C#, Objective-C</span>
                    </li>
                    <li>
                        <span>Java, Kotlin</span>
                    </li>
                    <li>
                        <span>Python</span>
                    </li>
                    <li>
                        <span>PHP, Symfony</span>
                    </li>
                    <li>
                        <span>Rust</span>
                    </li>
                    <li>
                        <span>Dart, Flutter</span>
                    </li>
                    <li>
                        <span>Angular JS, TypeScript, Ionic</span>
                    </li>
                    <li>
                        <span>React JS, React Native</span>
                    </li>
                    <li>
                        <span>Cisco/HP Routers, Switchs</span>
                    </li>
                    <li>
                        <span>Web Design</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class=\"container-fluid mt-4\">
        <div class=\"row w-100\">
            <div class=\"col-md-3 titleText\">
                <span class=\"titleText\">Education</span></div>
            <div class=\"col-md-9 div-text div-small\">
                <span class=\"bachelor-text\">Master Epitech</span>
                <span class=\"yers\">2016-2021</span>
                <p class=\"software-text\">Expert of Information Technologies</p>
                <span id=\"college\">Baccalauréat Professionnel</span>
                <span class=\"yers\">2013-2016</span>
                <p class=\"software-text\">Systèmes électronique numériques</p>
            </div>
        </div>
    </div>
    <div class=\"container-fluid mt-4\">
        <div class=\"row w-100\">
            <div class=\"col-md-3 titleText\">
                <span class=\"titleText\">Experience</span></div>
            <div class=\"col-md-9 div-text div-small\">
                <span class=\"bachelor-text\">Developer intern</span>
                <span class=\"yers\">2017</span>
                <p class=\"software-text\">LiveE</p>

                <span id=\"college\">Technician intern</span>
                <span class=\"yers\">2015</span>
                <p class=\"software-text\">Polyclinique de l'Atlantique</p>

                <span id=\"college\">Technician intern</span>
                <span class=\"yers\">2015</span>
                <p class=\"software-text\">GFI Informatique</p>
            </div>
        </div>
    </div>
{% endblock %}
{% block scripts %}
    {{ parent() }}
{% endblock %}
", "@default_views/index.twig", "/srv/dev-disk-by-id-mmc-SE16G_0x43c0db87-part3/arouillard.fr/apps/frontend/views/index.twig");
    }
}
