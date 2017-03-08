/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    var eayo = window.eayo || {};
    $(document).ready(function () {
        eayo.modal_ajax();
        eayo.form_ajax();
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
        $('nav.app-nav li > a[href="' + document.location.href + '"]').parent('li').addClass('active');
    };

    /* Retrieve content to Modal (Boostrap) */
    eayo.modal_ajax = function () {
        $('[data-toggle="modal"]').click(function () {
            var url = $(this).attr('href');
            $.get(url, function (data) {
                var modal = $('<div id="modal-ajax">' + data + '</div>');
                $('#modal-ajax .modal').modal();
                modal.on("hidden.bs.modal", function () {
                    $(this).remove();
                });
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
