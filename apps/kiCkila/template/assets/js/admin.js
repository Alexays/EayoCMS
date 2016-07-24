/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    const TabLoaded = Array();
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
            if ($('.sidebar-offcanvas').css('background-color') == 'rgb(255, 255, 255)') {
                $('.list-group-item').attr('tabindex', '-1');
            } else {
                $('.list-group-item').attr('tabindex', '');
            }
            $('.row-offcanvas').toggleClass('active');
        });
        $('[data-toggle="tooltip"]').tooltip();
    };

    /* Retrieve content to Modal (Boostrap) */
    eayo.ajax_nav = function () {
        $('[data-target="ajax"]').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var nameTab = $(this).attr('data-name');
            $.get(url, function (data) {
                if ($.inArray(url, TabLoaded) === -1) {
                    $.merge(TabLoaded, Array(url));
                    $('<li><a href="#tab'+nameTab+'" data-toggle="tab">'+nameTab+'</a></li>').appendTo('#tab-container');
                    $('<div class="tab-pane" id="tab'+nameTab+'">'+data+'</div>').appendTo('.tab-content');
                    $('#tab-container a:last').tab('show');
                } else {
                    $('[href="#tab'+nameTab+'"]').parent('li').fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                }
            });
        });
    };

    /* Send form ajax */
    eayo.form_ajax = function () {
        $('#edit_user').on('submit', function(e) {
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                url: $this.attr('action'),
                type: $this.attr('method'),
                data: $this.serialize(),
                success: function(html) {
                    alert(html); // J'affiche cette réponse
                }
            });
        });
    };
});
