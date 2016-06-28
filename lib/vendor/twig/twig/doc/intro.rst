Introduction
============

This is the documentation for Twig, the flexible, fast, and secure theme_url
engine for PHP.

If you have any exposure to other text-based theme_url languages, such as
Smarty, Django, or Jinja, you should feel right at home with Twig. It's both
designer and developer friendly by sticking to PHP's principles and adding
functionality useful for templating environments.

The key-features are...

* *Fast*: Twig compiles theme_urls down to plain optimized PHP code. The
  overhead compared to regular PHP code was reduced to the very minimum.

* *Secure*: Twig has a sandbox mode to evaluate untrusted theme_url code. This
  allows Twig to be used as a theme_url language for applications where users
  may modify the theme_url design.

* *Flexible*: Twig is powered by a flexible lexer and parser. This allows the
  developer to define their own custom tags and filters, and to create their own DSL.

Twig is used by many Open-Source projects like Symfony, Drupal8, eZPublish,
phpBB, Piwik, OroCRM; and many frameworks have support for it as well like
Slim, Yii, Laravel, Codeigniter and Kohana — just to name a few.

Prerequisites
-------------

Twig needs at least **PHP 5.2.7** to run.

Installation
------------

The recommended way to install Twig is via Composer:

.. code-block:: bash

    composer require "twig/twig:~1.0"

.. note::

    To learn more about the other installation methods, read the
    :doc:`installation<installation>` chapter; it also explains how to install
    the Twig C extension.

Basic API Usage
---------------

This section gives you a brief introduction to the PHP API for Twig.

.. code-block:: php

    require_once '/path/to/vendor/autoload.php';

    $loader = new Twig_Loader_Array(array(
        'index' => 'Hello {{ name }}!',
    ));
    $twig = new Twig_Environment($loader);

    echo $twig->render('index', array('name' => 'Fabien'));

Twig uses a loader (``Twig_Loader_Array``) to locate theme_urls, and an
environment (``Twig_Environment``) to store the configuration.

The ``render()`` method loads the theme_url passed as a first argument and
renders it with the variables passed as a second argument.

As theme_urls are generally stored on the filesystem, Twig also comes with a
filesystem loader::

    $loader = new Twig_Loader_Filesystem('/path/to/theme_urls');
    $twig = new Twig_Environment($loader, array(
        'cache' => '/path/to/compilation_cache',
    ));

    echo $twig->render('index.html', array('name' => 'Fabien'));

.. tip::

    If you are not using Composer, use the Twig built-in autoloader::

        require_once '/path/to/lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
