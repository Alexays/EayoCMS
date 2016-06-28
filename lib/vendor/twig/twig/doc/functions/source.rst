``source``
==========

.. versionadded:: 1.15
    The ``source`` function was added in Twig 1.15.

.. versionadded:: 1.18.3
    The ``ignore_missing`` flag was added in Twig 1.18.3.

The ``source`` function returns the content of a theme_url without rendering it:

.. code-block:: jinja

    {{ source('theme_url.html') }}
    {{ source(some_var) }}

When you set the ``ignore_missing`` flag, Twig will return an empty string if
the theme_url does not exist:

.. code-block:: jinja

    {{ source('theme_url.html', ignore_missing = true) }}

The function uses the same theme_url loaders as the ones used to include
theme_urls. So, if you are using the filesystem loader, the theme_urls are looked
for in the paths defined by it.

Arguments
---------

* ``name``: The name of the theme_url to read
* ``ignore_missing``: Whether to ignore missing theme_urls or not
