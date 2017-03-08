/*jslint browser: true plusplus: true */
/*global jQuery, Waves, alert*/
jQuery(function ($) {
    'use strict';
    var TabLoaded = {};
    var isMobileWindow = null;
    var eayo = window.eayo || {};
    $(document).ready(function () {
        eayo.nav();
        eayo.item_grid();
        eayo.form_ajax();
        eayo.date_picker();
    });
    $(window).load(function () {
        eayo.init();
    });
    $(window).resize(function () {
        eayo.mobile_friendly();
    });

    /* Init Client system */
    eayo.init = function () {
        // Check if jQuery was initialized and if not (CDN was down for example), then
        // load jQuery from a local source.
        if (typeof jQuery === 'undefined') {
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

        //Set isMobileWindows
        if ($( window ).width() < 768) {
            isMobileWindow = true;
        } else {
            isMobileWindow = false;
        }
    };

    /* Retrieve content to Modal (Boostrap) */
    eayo.nav = function () {
        //CLOSE SIDEBAR IF ON MOBILE
        $('a').click(function (e) {
            if ($('.sidebar').hasClass('active')) {
                $('.sidebar').removeClass('active');
            }
        });

        //AJAX NAV
        $('[data-target="ajax"]').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (typeof $(this).attr('data-name') != "undefined") {
                var nameTab = $(this).attr('data-name');
            } else if ($(this).text().length <= 30) {
                var nameTab = $(this).text();
            } else {
                var nameTab = 'Unknow';
            }
            var nameTabURI = nameTab.replace(/ /g, '_').toLowerCase();
            $.get(url, function (data) {
                if (typeof TabLoaded[nameTabURI] === 'undefined' && TabLoaded[nameTabURI] !== url) {
                    TabLoaded[nameTabURI] = url;
                    $('<li><a href="#tab' + nameTabURI + '" data-toggle="tab">' + nameTab + ' <span href="#" class="close" id="close_tab">×</span></a></li>').appendTo('#tab-container');
                    $('<div class="tab-pane" id="tab' + nameTabURI + '">' + data + '</div>').appendTo('.tab-content');
                    $('#tab-container a:last').tab('show');
                } else {
                    $('[href="#tab' + nameTabURI + '"]').parent('li').fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                }
            });
        });
        $('ul#tab-container').on('mouseover', 'li', function () {
            $(this).children('a').children('span#close_tab').fadeIn('100');
        });
        $('ul#tab-container').on('mouseleave', 'li', function () {
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

    /**
     * Send form ajax
     * @author Alexis Rouillard
     * @returns {boolean}
     */
    eayo.form_ajax = function () {
        $('.tab-content').on('submit', 'form', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (response) {
                    alert(response);
                }
            });

            return false;
        });
    };

    eayo.date_picker = function () {
        var dateFormat = "mm/dd/yy";
        $('.tab-content').on('mouseenter mouseleave', 'input', function (e) {
            var from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });
        });
    };

    eayo.item_grid = function () {
        $('.grid').masonry({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.grid-item',
            // use element for option
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
    };

    eayo.mobile_friendly = function() {
        var width = $( window ).width();
        if (width < 768 && isMobileWindow === false) {
            isMobileWindow = true;
        } else if (isMobileWindow === true) {
            isMobileWindow = false;
        }
    }

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});
