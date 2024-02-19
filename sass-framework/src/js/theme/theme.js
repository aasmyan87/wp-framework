window.addEventListener('DOMContentLoaded', function() {
    jQuery(document).ready(function ($) {

        //  Global variables
        let html_document = $('html');
        let menu_body_cover = $('.menu-overlay_js');
        let mobile_nav = $('.mobile-nav_js');
        let menu_open_button = $(".menu-open-btn_js");
        let menu_close_button = $(".menu-close-btn_js");
        let menu_close_sub_button = $(".menu-close-sub-btn_js");
        let menu_collapse_breakpoint = 1024;

        function fw_detect_screen_type(){
            if ('ontouchstart' in document.documentElement) {
                // the device has a touchscreen
                html_document.addClass('touch-screen');
                html_document.removeClass('no-touch-screen');
            } else {
                // the device does not have a touchscreen
                html_document.addClass('no-touch-screen');
                html_document.removeClass('touch-screen')
            }
        }
        fw_detect_screen_type();

        //  Clickable element is all link
        function fw_mobile_menu(){
            //  Menu Button Open
            menu_open_button.click(function () {
                $('body').addClass("no-ovrf");
                mobile_nav.addClass("active");
                menu_body_cover.addClass('active');
            });
            //  Menu Button Close
            menu_close_button.click(function () {
                $('body').removeClass("no-ovrf");
                mobile_nav.removeClass("active");
                menu_body_cover.removeClass('active');
            });
            // Close menu click on Cover
            menu_body_cover.click(function () {
                $(this).removeClass('active');
                mobile_nav.removeClass("active");
                $('body').removeClass("no-ovrf");
            });
            $(".general-menu_js > li > a").click(function (e) {
                let menu_item = $(this).parent();
                let menu_item_active = $('.general-menu_js li.active');
                let menu_item_all = $('.general-menu_js > li');
                let submenu = $(this).next();
                let submenu_active = $('li.active .sub-menu_js')
                if( $(this).next().length > 0 ){
                    if( html_document.hasClass('touch-screen') || $( window ).width() < menu_collapse_breakpoint ){
                        e.preventDefault();
                    }
                }

                menu_item_all.removeClass('active');
                if(menu_item.hasClass('active')){
                    submenu.removeClass('active');
                    submenu.slideUp(200);
                }else {
                    menu_item.addClass('active');
                    menu_item_active.removeClass('active');
                    submenu.slideDown(200);
                    submenu_active.slideUp(200);
                }
            });
            $(".sub-menu_js > li > a").click(function (e) {
                let submenu_item = $(this).parent();
                let submenu_sub = $(this).next();
                submenu_item.toggleClass('active');
                submenu_sub.slideToggle(200);
                if( $(this).next().length > 0 ){
                    if( html_document.hasClass('touch-screen') || $( window ).width() < menu_collapse_breakpoint ){
                        e.preventDefault();
                    }
                }

            });
            $(window).resize(function () {
                $('.sub-menu_js').removeAttr('style');
                $('.general-menu_js *').removeClass('active');
            });
        }
        // fw_mobile_menu();

        //  Flipping Menu
        function fw_mobile_flipping_menu(){
            //  Menu Button Open
            menu_open_button.click(function () {
                $('body').addClass("no-ovrf");
                mobile_nav.addClass("active");
                menu_body_cover.addClass('active');
            });
            //  Menu Button Close
            menu_close_button.click(function () {
                $('body').removeClass("no-ovrf");
                mobile_nav.removeClass("active");
                menu_body_cover.removeClass('active');
                $('.general-menu_js li').removeClass("active");
            });
            // Close submenu items
            menu_close_sub_button.click(function () {
                if(!$(this).hasClass('menu-close-sub-btn_js_2')){
                    $('.general-menu_js > li').removeClass('active');
                    menu_close_button.removeClass('hide');
                    $(this).removeClass('active');
                }
            });
            //  Close menu click on Cover
            menu_body_cover.click(function () {
                $(this).removeClass('active');
                mobile_nav.removeClass("active");
                $('body').removeClass("no-ovrf");
                $('.general-menu_js li').removeClass("active");
                menu_close_sub_button.removeClass('active')
                menu_close_button.removeClass('hide');
            });
            //  Main Menu
            $(".general-menu_js > li > a").click(function (e) {
                let menu_item = $(this).parent();
                let menu_item_active = $('.general-menu_js li.active');
                let menu_item_all = $('.general-menu_js > li');
                let submenu = $(this).next();
                if( $(this).next().length > 0 ){
                    menu_close_button.addClass('hide');
                    menu_close_sub_button.addClass('active');
                    if( html_document.hasClass('touch-screen') || $( window ).width() < menu_collapse_breakpoint ){
                        e.preventDefault();
                    }
                }


                menu_item_all.removeClass('active');
                if(menu_item.hasClass('active')){
                    submenu.removeClass('active');

                }else {
                    menu_item.addClass('active');
                    menu_item_active.removeClass('active');
                }
            });
            //  Submenu
            $(".sub-menu_js li  a").click(function (e) {
                let submenu_item = $(this).parent();
                submenu_item.toggleClass('active');
                if( $(this).next().length > 0 ){
                    menu_close_sub_button.addClass('menu-close-sub-btn_js_2');
                    menu_close_sub_button.removeClass('menu-close-sub-btn_js');
                    if( html_document.hasClass('touch-screen') || $( window ).width() < menu_collapse_breakpoint ){
                        e.preventDefault();
                    }
                }
                $('.menu-close-sub-btn_js_2').click(function (){
                    $('.sub-menu_js li').removeClass('active');
                    $(this).removeClass('menu-close-sub-btn_js_2')
                    $(this).addClass('menu-close-sub-btn_js')
                })
            });

            $(window).resize(function () {
                $('.sub-menu_js').removeAttr('style');
                $('.general-menu_js *').removeClass('active');
            });
        }
        fw_mobile_flipping_menu();


        function fw_desktop_menu_keyboard_support(){
            $(document).keydown(function(event) {
                html_document.addClass('keyboard');
                if(html_document.hasClass('keyboard')){
                    $(".general-menu_js > li > a").attr('href', '#');
                }
            });
            $(document).click(function(event) {
                html_document.removeClass('keyboard');
            });

        }
        fw_desktop_menu_keyboard_support();

        //  Function: detect scroll up/down
        function fw_add_scrolled_class(elements, scroll_up_down_point) {
            let scrollStart;
            if (window.scrollY > scroll_up_down_point) {
                $(elements).addClass('scrl');
            }
            window.addEventListener('scroll', function () {
                let scrollHeight = window.scrollY;

                if (scrollHeight > scrollStart && scrollHeight > scroll_up_down_point) {
                    $(elements).addClass('scrl-d');
                    $(elements).removeClass('scrl-u');

                } else {
                    $(elements).removeClass('scrl-d');
                }

                if (scrollHeight < scrollStart) {
                    $(elements).addClass('scrl-u');
                }
                if (scrollHeight < scroll_up_down_point) {
                    $(elements).removeClass('scrl-u');
                }
                //  Always scrolled
                if (scrollStart > 0) {
                    $(elements).removeClass('scrl');
                }
                scrollStart = scrollHeight;
            })
        }

        // fw_add_scrolled_class('.header-reduce_js', 500);
        // fw_add_scrolled_class('.header-transparent_js', 500);


        // Function: jump header on scroll
        function fw_header_jump(element_class, jump_start = 100) {
            let scrollStart;
            const fix_header = 100;
            let header_jump_start = jump_start;
            if(jump_start <= fix_header){
                header_jump_start = fix_header*5;
            } else{
                header_jump_start = fix_header + jump_start;
            }

            if (window.scrollY > header_jump_start) {
                $(element_class).addClass('scrl');
            }
            document.addEventListener('scroll', function () {
                let scrollHeight = window.scrollY;

                //  Add class on scroll up/down
                if (scrollHeight > scrollStart && scrollHeight > fix_header) {
                    $(element_class).addClass('scrl-d');
                    $(element_class).removeClass('scrl-u');

                } else {
                    $(element_class).removeClass('scrl-d');
                }

                if (scrollHeight < scrollStart) {
                    $(element_class).addClass('scrl-u');
                }
                if (scrollHeight < fix_header || scrollHeight === 0) {
                    $(element_class).removeClass('scrl-u');
                }

                //  Header jump start animation
                if (scrollHeight > scrollStart && scrollHeight > header_jump_start) {
                    $(element_class).addClass('start');

                } else {
                    $(element_class).removeClass('start');
                }

                //  Header jump end animation
                if (scrollHeight < jump_start) {
                    $(element_class).addClass('end');
                }
                if (scrollHeight > scrollStart || scrollHeight < 100) {
                    $(element_class).removeClass('end');
                }
                //  Header always scrolled
                if (scrollStart > 0) {
                    $(element_class).removeClass('scrl');
                }

                scrollStart = scrollHeight;
            });
        }
        fw_header_jump('.header-jump_js', 1000);

        function fw_change_select_color(){
            $('select').on('change', function (){
                $(this).removeClass('selected_active');
                if($(this).val() !== ''){
                    $(this).addClass('selected_active');
                }
            });
        }
        fw_change_select_color()

        //  Remove all transitions on resize
        $(window).resize(function () {
            $('body').addClass('no-transition_js');
            setTimeout(function () {
                $('body').removeClass('no-transition_js');
            }, 100);

        });
        //  Remove all transitions on load
        setTimeout(function () {
            $('body').removeClass('no-transition_js');
        }, 500);


    });

});





