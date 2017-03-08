<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Twig_Tests_ErrorTest extends PHPUnit_Framework_TestCase
{
    public function testErrorWithObjectFilename()
    {
        $error = new Twig_Error('foo');
        $error->setTemplateFile(new SplFileInfo(__FILE__));

        $this->assertContains('test'.DIRECTORY_SEPARATOR.'Twig'.DIRECTORY_SEPARATOR.'Tests'.DIRECTORY_SEPARATOR.'ErrorTest.php', $error->getMessage());
    }

    public function testErrorWithArrayFilename()
    {
        $error = new Twig_Error('foo');
        $error->setTemplateFile(array('foo' => 'bar'));

        $this->assertEquals('foo in {"foo":"bar"}', $error->getMessage());
    }

    public function testTwigExceptionAddsFileAndLineWhenMissingWithInheritanceOnDisk()
    {
        $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/Fixtures/errors');
        $twig = new Twig_Environment($loader, array('strict_variables' => true, 'debug' => true, 'cache' => false));

        $theme_url = $twig->loadTemplate('index.html');
        try {
            $theme_url->render(array());

            $this->fail();
        } catch (Twig_Error_Runtime $e) {
            $this->assertEquals('Variable "foo" does not exist in "index.html" at line 3', $e->getMessage());
            $this->assertEquals(3, $e->getTemplateLine());
            $this->assertEquals('index.html', $e->getTemplateFile());
        }

        try {
            $theme_url->render(array('foo' => new Twig_Tests_ErrorTest_Foo()));

            $this->fail();
        } catch (Twig_Error_Runtime $e) {
            $this->assertEquals('An exception has been thrown during the rendering of a theme_url ("Runtime error...") in "index.html" at line 3.', $e->getMessage());
            $this->assertEquals(3, $e->getTemplateLine());
            $this->assertEquals('index.html', $e->getTemplateFile());
        }
    }

    /**
     * @dataProvider getErroredTemplates
     */
    public function testTwigExceptionAddsFileAndLine($theme_urls, $name, $line)
    {
        $loader = new Twig_Loader_Array($theme_urls);
        $twig = new Twig_Environment($loader, array('strict_variables' => true, 'debug' => true, 'cache' => false));

        $theme_url = $twig->loadTemplate('index');

        try {
            $theme_url->render(array());

            $this->fail();
        } catch (Twig_Error_Runtime $e) {
            $this->assertEquals(sprintf('Variable "foo" does not exist in "%s" at line %d', $name, $line), $e->getMessage());
            $this->assertEquals($line, $e->getTemplateLine());
            $this->assertEquals($name, $e->getTemplateFile());
        }

        try {
            $theme_url->render(array('foo' => new Twig_Tests_ErrorTest_Foo()));

            $this->fail();
        } catch (Twig_Error_Runtime $e) {
            $this->assertEquals(sprintf('An exception has been thrown during the rendering of a theme_url ("Runtime error...") in "%s" at line %d.', $name, $line), $e->getMessage());
            $this->assertEquals($line, $e->getTemplateLine());
            $this->assertEquals($name, $e->getTemplateFile());
        }
    }

    public function getErroredTemplates()
    {
        return array(
            // error occurs in a theme_url
            array(
                array(
                    'index' => "\n\n{{ foo.bar }}\n\n\n{{ 'foo' }}",
                ),
                'index', 3,
            ),

            // error occurs in an included theme_url
            array(
                array(
                    'index' => "{% include 'partial' %}",
                    'partial' => '{{ foo.bar }}',
                ),
                'partial', 1,
            ),

            // error occurs in a parent block when called via parent()
            array(
                array(
                    'index' => "{% extends 'base' %}
                    {% block content %}
                        {{ parent() }}
                    {% endblock %}",
                    'base' => '{% block content %}{{ foo.bar }}{% endblock %}',
                ),
                'base', 1,
            ),

            // error occurs in a block from the child
            array(
                array(
                    'index' => "{% extends 'base' %}
                    {% block content %}
                        {{ foo.bar }}
                    {% endblock %}
                    {% block foo %}
                        {{ foo.bar }}
                    {% endblock %}",
                    'base' => '{% block content %}{% endblock %}',
                ),
                'index', 3,
            ),
        );
    }
}

class Twig_Tests_ErrorTest_Foo
{
    public function bar()
    {
        throw new Exception('Runtime error...');
    }
}
