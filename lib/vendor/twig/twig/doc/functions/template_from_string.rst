``theme_url_from_string``
========================

.. versionadded:: 1.11
    The ``theme_url_from_string`` function was added in Twig 1.11.

The ``theme_url_from_string`` function loads a theme_url from a string:

.. code-block:: jinja

    {{ include(theme_url_from_string("Hello {{ name }}")) }}
    {{ include(theme_url_from_string(page.theme_url)) }}

.. note::

    The ``theme_url_from_string`` function is not available by default. You
    must add the ``Twig_Extension_StringLoader`` extension explicitly when
    creating your Twig environment::

        $twig = new Twig_Environment(...);
        $twig->addExtension(new Twig_Extension_StringLoader());

.. note::

    Even if you will probably always use the ``theme_url_from_string`` function
    with the ``include`` function, you can use it with any tag or function that
    takes a theme_url as an argument (like the ``embed`` or ``extends`` tags).

Arguments
---------

* ``theme_url``: The theme_url
