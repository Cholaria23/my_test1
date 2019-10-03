$(document).ready(function($){

    'use strict';

    //Main navigation
    $.navigation = $(document).find('nav > ul.nav');

    $.panelIconOpened = 'icon-arrow-up';
    $.panelIconClosed = 'icon-arrow-down';


    // Add class .active to current link
    $.navigation.find('a').each(function(){

        var cUrl = String(window.location).split('?')[0];

        if (cUrl.substr(cUrl.length - 1) == '#') {
            cUrl = cUrl.slice(0,-1);
        }

        if ($($(this))[0].href==cUrl) {
            $(this).addClass('active');

            $(this).parents('ul').add(this).each(function(){
                $(this).parent().addClass('open');
            });
        }
    });

    function setActiveNavItem() {

        $(document).find('.nav-dropdown').removeClass('open');
        $(document).find('.router-link-active').parents('.nav-dropdown').addClass('open');

        // $(document).find('.router-link-exact-active, .router-link-active').not('.nav-dropdown-toggle').addClass('active');
        $(document).find('.router-link-exact-active, .router-link-active').parent('.nav-item').addClass('open');
    }

    setActiveNavItem();

    // Dropdown Menu
    $.navigation.on('click', 'a', function(e){

        if ($.ajaxLoad) {
            e.preventDefault();
        }

        setActiveNavItem()

        // if ($(this).parent().hasClass('nav') && !$(this).hasClass('nav-dropdown-toggle')) {
        //     $(document).find('.nav-dropdown').removeClass('open');
        // }

        // if ($(this).hasClass('nav-dropdown-toggle')) {
        //     $(this).parent().toggleClass('open');
        //     resizeBroadcast();
        // }

    });

    function resizeBroadcast() {

        var timesRun = 0;
        var interval = setInterval(function(){
            timesRun += 1;
            if(timesRun === 5){
                clearInterval(interval);
            }
            window.dispatchEvent(new Event('resize'));
        }, 62.5);
    }

    /* ---------- Main Menu Open/Close, Min/Full ---------- */
    $('.navbar-toggler').click(function(){

        if ($(this).hasClass('sidebar-toggler')) {
            $('body').toggleClass('sidebar-hidden');
            resizeBroadcast();
        }

        if ($(this).hasClass('aside-menu-toggler')) {
            $('body').toggleClass('aside-menu-hidden');
            resizeBroadcast();
        }

        if ($(this).hasClass('mobile-sidebar-toggler')) {
            $('body').toggleClass('sidebar-mobile-show');
            resizeBroadcast();
        }

    });    

    $('.sidebar-close').click(function(){
        $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
    });

    /* ---------- Disable moving to top ---------- */
    $('a[href="#"][data-top!=true]').click(function(e){
        e.preventDefault();
    });



});
