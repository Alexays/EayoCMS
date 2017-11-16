/*jslint browser: true plusplus: true */
/*global jQuery*/
window.Tether = {};
jQuery(function ($) {
    'use strict';
    const images = [
        {
            src: "http://arouillard.fr/data/uploads/wolf3d.jpg",
            title: "Wolf3D",
            desc: "Ray casting is the use of ray–surface intersection tests to solve a variety of problems in computer graphics and computational geometry."
        },
        {
            src: "http://arouillard.fr/data/uploads/raytracer.jpg",
            title: "Raytracer",
            desc: "Ray tracing is a technique for generating an image by tracing the path of light through pixels in an image plane and simulating the effects of its encounters with virtual objects."
        },
        {
            src: "http://arouillard.fr/data/uploads/wireframe.jpg",
            title: "Wireframe",
            desc: "This project consists of displaying the relief of a terrain, in an on-screen graphic window, by using a parallel projection."
        },
        {
            src: "http://arouillard.fr/data/uploads/AI.jpg",
            title: "Anna",
            desc: "A new personal assistant for everyone."
        },
        {
            src: "http://arouillard.fr/data/uploads/CMS.jpg",
            title: "EayoCMS",
            desc: "A blazing fast flat file CMS."
        }
    ];
    let photos = [];
    let last_height = 0;
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
        //Add Images
        let imageElements = [];
        for (let i = 0; i < images.length; i++) {
            imageElements[i] = new Image();
            imageElements[i].setAttribute("class", "image" + i);
            //lazy-load img.
            imageElements[i].onload = function () {
                photos.push({ src: this.src, ar: this.width / this.height, title: images[i].title, desc: images[i].desc });
                if (++up === images.length && document.getElementById("spinner")) {
                    document.getElementById("spinner").setAttribute("style", "display:none !important");
                    eayo.item_grid();
                }
            }
            imageElements[i].src = images[i].src;
        }
    };

    /* Grid */
    eayo.item_grid = function () {
        $('#grid').css("height", "+=50px");
        let grid = document.getElementById('grid');
        if (!grid)
            return;
        grid.innerHTML = "";
        const ideal_height = parseInt(document.getElementById('container').offsetHeight / 3);
        const summed_width = photos.reduce((sum, p) => sum += p.ar * ideal_height, 0);
        let viewport_width = grid.offsetWidth;
        const rows = Math.round(summed_width / viewport_width);
        const weights = photos.map((p) => parseInt(p.ar * 100));
        const partition = part(weights, rows);
        const x = photos.slice(0);
        let index = 0;
        for (let i = 0; i < partition.length; i++) {
            let summed_ratios;
            let row_buffer = [];
            for (let j = 0; j < partition[i].length; j++)
                row_buffer.push(photos[index++])
            summed_ratios = row_buffer.reduce((sum, p) => sum += p.ar, 0);
            for (let k = 0; k < row_buffer.length; k++) {
                const photo = row_buffer[k]
                let elem = document.createElement("div");
                let img = document.createElement("img");
                const obj = x.shift();
                img.src = obj.src;
                img.style.width = parseInt(viewport_width / summed_ratios * photo.ar) + "px";
                img.style.height = parseInt(viewport_width / summed_ratios) + "px";
                elem.setAttribute("class", "photo");
                elem.appendChild(img);
                elem.innerHTML += '<div id="desc">' + obj.title + '<p>' + obj.desc + '</p></div>';
                grid.appendChild(elem);
            };
        }
    };
});