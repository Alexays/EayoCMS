/*jslint browser: true plusplus: true */
/*global jQuery*/
window.Tether = {};
jQuery(function ($) {
    'use strict';
    const images = [
        "http://arouillard.fr/data/uploads/wolf3d.jpg",
        "http://arouillard.fr/data/uploads/raytracer.jpg",
        "http://arouillard.fr/data/uploads/wireframe.jpg",
        "http://arouillard.fr/data/uploads/AI.jpg",
        "http://arouillard.fr/data/uploads/CMS.jpg"
    ];
    let photos = [];
    let last_height = 0;
    let width_scrollbar = 0;
    let eayo = window.eayo || {};
    $(document).ready(() => {
        eayo.init();
    });
    $(window).on('resize', () => {
        eayo.item_grid();
    });

    /* Init Client system */
    eayo.init = function () {
        let up = 0;
        //Get scrollbar width
        document.getElementById("wrapper").style.overflowY = "scroll";
        const tmp_scroll = document.getElementById('grid').clientWidth;
        document.getElementById("wrapper").style.overflowY = null;
        width_scrollbar = document.getElementById('grid').clientWidth - tmp_scroll;
        //Add Images
        let imageElements = [];
        for (let i = 0; i < images.length; i++) {
            imageElements[i] = new Image();
            imageElements[i].setAttribute("class", "image" + i);
            //lazy-load img.
            imageElements[i].onload = function () {
                photos.push({ src: this.src, ar: this.width / this.height });
                if (++up === images.length) {
                    document.getElementById("spinner").setAttribute("style", "display:none !important");
                    eayo.item_grid();
                }
            }
            imageElements[i].src = images[i];
        }
    };

    /* Grid */
    eayo.item_grid = function () {
        let grid = document.getElementById('grid');
        grid.style.width = "101%";
        grid.innerHTML = "";
        const ideal_height = parseInt(grid.clientHeight / photos.length);
        const summed_width = photos.reduce((sum, p) => sum += p.ar * ideal_height, 0);
        let viewport_width = grid.clientWidth;
        if (document.getElementById('container').clientHeight < last_height)
            viewport_width -= width_scrollbar;
        const rows = Math.ceil(summed_width / viewport_width);
        const weights = photos.map((p) => parseFloat(p.ar * 100));
        const partition = part(weights, rows);
        const x = photos.slice(0);
        let index = 0;
        let row_buffer = [];
        for (let i = 0; i < partition.length; i++) {
            let summed_ratios;
            row_buffer = [];
            for (let j = 0; j < partition[i].length; j++)
                row_buffer.push(photos[index++])
            summed_ratios = row_buffer.reduce((sum, p) => sum += p.ar, 0);
            for (let k = 0; k < row_buffer.length; k++) {
                const photo = row_buffer[k]
                let elem = document.createElement("div");
                elem.style.backgroundImage = "url('" + x.shift().src + "')";
                elem.style.width = parseInt(viewport_width / summed_ratios * photo.ar) + "px";
                elem.style.height = parseInt(viewport_width / summed_ratios) + "px";
                elem.setAttribute("class", "photo");
                grid.appendChild(elem)
            };
        }
        last_height = document.getElementById('container').scrollHeight;
        grid.style.width = "103%";
    };
});