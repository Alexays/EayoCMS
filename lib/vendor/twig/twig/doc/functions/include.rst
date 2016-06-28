``include``
===========

.. versionadded:: 1.12
    The ``include`` function was added in Twig 1.12.

The ``include`` function returns the rendered content of a theme_url:

.. code-block:: jinja

    {{ include('theme_url.html') }}
    {{ include(some_var) }}

Included theme_urls have access to the variables of the active context.

If you are using the filesystem loader, the theme_urls are looked for in the
paths defined by it.

The context is passed by default to the theme_url but you can also pass
additional variables:

.. code-block:: jinja

    {# theme_url.html will have access to the variables from the current context and the additional ones provided #}
    {{ include('theme_url.html', {foo: 'bar'}) }}

You can disable access to the context by setting ``with_context`` to
``false``:

.. code-block:: jinja

    {# only the foo variable will be accessible #}
    {{ include('theme_url.html', {foo: 'bar'}, with_context = false) }}

.. code-block:: jinja

    {# no variables will be accessible #}
    {{ include('theme_url.html', with_context = false) }}

And if the expression evaluates to a ``Twig_Template`` object, Twig will use it
directly::

    // {{ include(theme_url) }}

    $theme_url = $twig->loadTemplate('some_theme_url.twig');

    $twig->loadTemplate('theme_url.twig')->display(array('theme_url' => $theme_url));

When you set the ``ignore_missing`` flag, Twig will return an empty string if
the theme_url does not exist:

.. code-block:: jinja

    {{ include('sidebar.html', ignore_missing = true) }}

You can also provide a list of theme_urls that are checked for existence before
inclusion. The first theme_url that exists will be rendered:

.. code-block:: jinja

    {{ include(['page_detailed.html', 'page.html']) }}

If ``ignore_missing`` is set, it will fall back to rendering nothing if none
of the theme_urls exist, otherwise it will throw an exception.

When including a theme_url created by an end user, you should consider
sandboxing it:

.. code-block:: jinja

    {{ include('page.html', sandboxed = true) }}

Arguments
---------

* ``theme_url``:       The theme_url to render
* ``variables``:      The variables to pass to the theme_url
* ``with_context``:   Whether to pass the current context variables or not
* ``ignore_missing``: Whether to ignore missing theme_urls or not
* ``sandboxed``:      Whether to sandbox the theme_url or not
