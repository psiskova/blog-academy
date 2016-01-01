'use strict';

var toggleDropdown = function () {
    $('.more-dropdown-menu').stop().slideToggle('fast');
};

$(document).ready(function () {
    var rt = ($(window).width() - ($("a.tab-item.color-nav-course").offset().left + $('a.tab-item.color-nav-course').outerWidth()));
    var rw = $('a.tab-item.color-nav-course').outerWidth();
    var rheight = $('a.tab-item.color-nav-course').height();

    $('.more-dropdown-menu').css('bottom', rheight);
    $('.more-dropdown-menu').css('right', rt);
    $('.more-dropdown-menu').css('width', rw);

    $('a.tab-item.color-nav-course').click(function () {
        toggleDropdown();
    });

    $(window).resize(function () {
        rt = ($(window).width() - ($("a.tab-item.color-nav-course").offset().left + $('a.tab-item.color-nav-course').outerWidth()));
        rw = $('a.tab-item.color-nav-course').outerWidth();
        rheight = $('a.tab-item.color-nav-course').height();
        $('.more-dropdown-menu').css('bottom', rheight);
        $('.more-dropdown-menu').css('right', rt);
        $('.more-dropdown-menu').css('width', rw);
    });

    $(window).on('click', function (e) {
        if (!$(e.target).hasClass('more-tab') && !$(e.target).closest('.more-dropdown-menu').length) {
            if ($('.more-dropdown-menu').is(':visible')) {
                toggleDropdown();
            }
        }
    });

});