/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    var eayo = window.eayo || {};
    $(document).ready(function () {
        eayo.modal_ajax();
        $('nav.app-nav li > a[href="' + document.location.href + '"]').parent('li').addClass('active');
    });
    $(window).load(function () {
        eayo.init();
    });
    $(window).resize(function () {
        /**/
    });

    /* Init Client system */
    eayo.init = function () {
        // Check if jQuery was initialized and if not (CDN was down for example), then
        // load jQuery from a local source.
        if(typeof jQuery === 'undefined'){
            document.write(unescape("%3Cscript src='lib/core/admin/assets/js/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));
        }
    };

    /* Retrieve content to Modal (Boostrap) */
    eayo.modal_ajax = function () {
        $('[data-toggle="modal"]').click(function () {
            var url = $(this).attr('href');
            $.get(url, function (data) {
                var modal = $('<div id="clue-modal" class="modal fade" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content">' + data + '</div></div></div>').modal();
                modal.on("hidden.bs.modal", function () {
                    $(this).remove();
                });
            });
        });
    };
});
