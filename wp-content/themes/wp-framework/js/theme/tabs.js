window.addEventListener('DOMContentLoaded', function() {
    jQuery(document).ready(function ($) {
        /** Tabs --> Accordion **/
        function fw_tab_acc(){
            let tab_item = $('.tabs-nav_js');
            tab_item.on('click', function (e) {
                e.preventDefault();
                let tab_item_active = $(this).parent().attr('data-tab');
                let active_content = $('#'+tab_item_active);
                $(this).parent().addClass('active').siblings().removeClass('active');
                $(active_content).addClass('active').siblings().removeClass('active');
            });

            let acc_item = $('.acc-nav_js');
            acc_item.on('click', function (e) {
                e.preventDefault();
                $(this).next().slideDown(200);
                $(this).parent().siblings().children().removeClass('active');
                $(this).parent().siblings().children().next().slideUp(200);
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                    $(this).next().slideUp(200);
                }else{
                    $(this).addClass('active');
                }
            });
        }
        fw_tab_acc()
    });
});


