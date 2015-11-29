'use strict';

$(document).ready(function () {
    var rt = ($(window).width() - ($("a.tab-item.color-nav-course").offset().left + $('a.tab-item.color-nav-course').outerWidth()));
    var rw = $('a.tab-item.color-nav-course').outerWidth();
    var rheight = $('a.tab-item.color-nav-course').height();

    $('.more-dropdown-menu').css('bottom', rheight);
    $('.more-dropdown-menu').css('right', rt);
    $('.more-dropdown-menu').css('width', rw);

    $('a.tab-item.color-nav-course').click(function() {
        $('.more-dropdown-menu').slideToggle('fast');
    });

    $( window ).resize(function() {
        rt = ($(window).width() - ($("a.tab-item.color-nav-course").offset().left + $('a.tab-item.color-nav-course').outerWidth()));
        rw = $('a.tab-item.color-nav-course').outerWidth();
        rheight = $('a.tab-item.color-nav-course').height();
        $('.more-dropdown-menu').css('bottom', rheight);
        $('.more-dropdown-menu').css('right', rt);
        $('.more-dropdown-menu').css('width', rw);
    });

});

var sdd = function (element) {
    var event;
    event = document.createEvent('MouseEvents');
    event.initMouseEvent('mousedown', true, true, window);
    element.dispatchEvent(event);
};

window.showdropdown = function () {
    var dropdown = document.getElementById('chooseCourse');
    sdd(dropdown);
};