/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function($) {
    'use strict';
    var images = [];
    var photos = [];
    var eayo = window.eayo || {};
    $(document).ready(function() {
        eayo.item_grid();
    });
    $(window).on('load', function() {
        eayo.init();
    });
    $(window).on('resize', function() {
        eayo.mobile_friendly();
    });
    /* Init Client system */
    eayo.init = function() {
    };
    eayo.item_grid = function() {
        var isotopeImagesReveal = function() {
            // hide by default
            $(".widget").hide();
            $(".widget").imagesLoaded().progress(function(imgLoad, image) {
                $(image.img).parents($(".widget")).delay(10).fadeIn();
            });

            return this;
        };
        var colWidth = function() {
            var w = $('.grid').width(),
                columnNum = 1,
                columnWidth = 0;
            if (w > 1200) {
                columnNum = 3;
            } else if (w > 900) {
                columnNum = 3;
            } else if (w > 600) {
                columnNum = 3;
            } else if (w > 300) {
                columnNum = 2;
            }
            if ($('.grid .widget').length < columnNum) {
                columnWidth = Math.floor(w / $('.grid .widget').length);
            } else {
                columnWidth = Math.floor(w / columnNum);
            }
            $('.grid').find('.widget').each(function() {
                var $item = $(this),
                    width = columnWidth,
                    height = columnWidth;
                $item.css({
                    width: width
                });
            });
            return columnWidth;
        };
        var isotope = function() {
            $('.grid').isotope({
                // set itemSelector so .grid-sizer is not used in layout
                itemSelector: '.widget',
                masonry: {
                    columnWidth: colWidth()
                }
            });
        };
        isotope()
        isotopeImagesReveal();
        $(window).on('debouncedresize', isotope);
    };
    eayo.mobile_friendly = function() {
        var width = $(window).width();
        if (width < 768 && isMobileWindow === false) {
            isMobileWindow = true;
        } else if (isMobileWindow === true) {
            isMobileWindow = false;
        }
    };
});