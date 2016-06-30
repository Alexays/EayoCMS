/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    var eayo = window.eayo || {};
    $(document).ready(function () {
        eayo.modal_ajax();
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
        // Check if jQuery was initialized and if not (CDN was down for example), then
        // load jQuery from a local source.
        if(typeof jQuery === 'undefined'){
            document.write(unescape("%3Cscript src='lib/core/admin/assets/js/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));
        }
    };
});
