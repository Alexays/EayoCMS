/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    var TabLoaded = {};
    var eayo = window.eayo || {};
    $(document).ready(function () {
        eayo.ajax_nav();
        eayo.form_ajax();
    });
    $(window).load(function () {
        eayo.init();
    });
    $(window).resize(function () {
        //
    });

    /* Init Client system */
    eayo.init = function () {
        // Check if jQuery was initialized and if not (CDN was down for example), then
        // load jQuery from a local source.
        if(typeof jQuery === 'undefined'){
            document.write(unescape("%3Cscript src='lib/core/admin/assets/js/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));
        }
        $('[data-toggle=offcanvas]').click(function () {
            $('.sidebar').toggleClass('active');
        });
        $('[data-toggle=left-sidebar]').click(function () {
            $('.sidebar.left').toggleClass('active');
            $('.sidebar.right').removeClass('active');
        });
        $('[data-toggle=right-sidebar]').click(function () {
            $('.sidebar.left').removeClass('active');
            $('.sidebar.right').toggleClass('active');
        });
        $('[data-toggle="tooltip"]').tooltip();
    };

    /* Retrieve content to Modal (Boostrap) */
    eayo.ajax_nav = function () {
        $('[data-target="ajax"]').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var nameTab = $(this).text();
            var nameTabURI = nameTab.replace(/ /g, '_').toLowerCase();
            $.get(url, function (data) {
                if (typeof TabLoaded[nameTabURI] === 'undefined' && TabLoaded[nameTabURI] !== url) {
                    TabLoaded[nameTabURI] = url;
                    $('<li><a href="#tab'+nameTabURI+'" data-toggle="tab">'+nameTab+' <span href="#" class="close" id="close_tab">×</span></a></li>').appendTo('#tab-container');
                    $('<div class="tab-pane" id="tab'+nameTabURI+'">'+data+'</div>').appendTo('.tab-content');
                    $('#tab-container a:last').tab('show');
                } else {
                    $('[href="#tab'+nameTabURI+'"]').parent('li').fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                }
            });
        });
        $('ul#tab-container').on('mouseover', 'li', function () {
            $(this).children('a').children('span#close_tab').fadeIn('100');
        });
        $('ul#tab-container').on('mouseleave', 'li', function() {
            $(this).children('a').children('span#close_tab').fadeOut('100');
        });
        $('ul#tab-container').on('click', '#close_tab', function () {
            var url = $(this).parent('a').attr('href');
            if (url !== $('ul#tab-container li a').first().attr('href')) {
                if (typeof TabLoaded[url.replace(/^#tab/, '')] === 'undefined') {
                    $(this).remove();
                } else {
                    $(url).remove();
                    var li = $(this).parent('a').parent('li');
                    li.prev().children('a').tab('show');
                    li.remove();
                    delete TabLoaded[url.replace(/^#tab/, '')];
                }
            } else {
                $(this).remove();
            }
        });
    };

    /* Send form ajax */
    eayo.form_ajax = function () {
        $('.tab-content').on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(html) {
                    alert(html); // J'affiche cette réponse
                }
            });
        });
    };
});
