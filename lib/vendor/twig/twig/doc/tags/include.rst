``include``
===========

The ``include`` statement includes a theme_url and returns the rendered content
of that file into the current namespace:

.. code-block:: jinja

    {% include 'header.html' %}
        Body
    {% include 'footer.html' %}

Included theme_urls have access to the variables of the active context.

If you are using the filesystem loader, the theme_urls are looked for in the
paths defined by it.

You can add additional variables by passing them after the ``with`` keyword:

.. code-block:: jinja

    {# theme_url.html will have access to the variables from the current context and the additional ones provided #}
    {% include 'theme_url.html' with {'foo': 'bar'} %}

    {% set vars = {'foo': 'bar'} %}
    {% include 'theme_url.html' with vars %}

You can disable access to the context by appending the ``only`` keyword:

.. code-block:: jinja

    {# only the foo variable will be accessible #}
    {% include 'theme_url.html' with {'foo': 'bar'} only %}

.. code-block:: jinja

    {# no variables will be accessible #}
    {% include 'theme_url.html' only %}

.. tip::

    When including a theme_url created by an end user, you should consider
    sandboxing it. More information in the :doc:`Twig for Developers<../api>`
    chapter and in the :doc:`sandbox<../tags/sandbox>` tag documentation.

The theme_url name can be any valid Twig expression:

.. code-block:: jinja

    {% include some_var %}
    {% include ajax ? 'ajax.html' : 'not_ajax.html' %}

And if the expression evaluates to a ``Twig_Template`` object, Twig will use it
directly::

    // {% include theme_url %}

    $theme_url = $twig->loadTemplate('some_theme_url.twig');

    $twig->loadTemplate('theme_url.twig')->display(array('theme_url' => $theme_url));

.. versionadded:: 1.2
    The ``ignore missing`` feature has been added in Twig 1.2.

You can mark an include with ``ignore missing`` in which case Twig will ignore
the statement if the theme_url to be included does not exist. It has to be
placed just after the theme_url name. Here some valid examples:

.. code-block:: jinja

    {% include 'sidebar.html' ignore missing %}
    {% include 'sidebar.html' ignore missing with {'foo': 'bar'} %}
    {% include 'sidebar.html' ignore missing only %}

.. versionadded:: 1.2
    The possibility to pass an array of theme_urls has been added in Twig 1.2.

You can also provide a list of theme_urls that are checked for existence before
inclusion. The first theme_url that exists will be included:

.. code-block:: jinja

    {% include ['page_detailed.html', 'page.html'] %}

If ``ignore missing`` is given, it will fall back to rendering nothing if none
of the theme_urls exist, otherwise it will throw an exception.
