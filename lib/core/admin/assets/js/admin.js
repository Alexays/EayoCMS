/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    var eayo = window.eayo || {};
    $(document).ready(function () {
        /**/
    });
    $(window).load(function () {
        eayo.init();
    });
    $(window).resize(function () {
        /**/
    });

    eayo.init = function () {
        Waves.attach('nav li a', null);
        Waves.init();
    };
});
