<?php

/**
 *  Load Internal fonts
 */
function fw_load_fonts_internal() {
    $font_path = get_stylesheet_directory_uri() . '/fonts/';
    $font_files = [
        $font_path.'Montserrat-Regular.woff2',
        $font_path.'fontello.woff2',
        $font_path.'Montserrat-Bold.woff2',
        $font_path.'Montserrat-Italic.woff2',
        $font_path.'Montserrat-SemiBold.woff2'
    ];
    foreach ( $font_files as $font_file ){
        echo '<link rel="preload" as="font" href="' . esc_url( $font_file ) .  '" type="font/woff2" crossorigin />';
    }
}
add_action( 'wp_head', 'fw_load_fonts_internal', 3 );

/**
 * Load Google Fonts (Roboto font is as example)
 */
function fw_load_google_fonts(){
    $fonts = 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link rel="stylesheet" href="'.$fonts.'">';
}
//add_action( 'wp_head', 'fw_load_google_fonts', 3 );

/**
 * Load CSS styles using link tag
 */
function fw_css_files(){

    $css_path = get_stylesheet_directory_uri() . '/css/';
    $css_path_inline = get_stylesheet_directory() . '/css/';

    if( is_user_logged_in() ){
        fw_load_styles($css_path.'admin/admin.css');
    }
    fw_load_styles_inline( $css_path_inline.'components/fonts.css' );
    fw_load_styles_inline( $css_path_inline.'vendor/icons.css' );

    //  Base Styles
    $base_css = array(
        $css_path . 'components/normalize.css',
        $css_path . 'vendor/bootstrap.css',
        $css_path . 'layout/header.css',
        //$css_path . 'layout/desktop-menu.css',
        $css_path . 'layout/desktop-menu-flipping.css',
        //$css_path . 'layout/mobile-menu.css',
        $css_path . 'layout/mobile-menu-flipping.css',
        $css_path . 'components/typography.css',
        $css_path . 'components/media.css',
        $css_path . 'components/inputs.css',
        $css_path . 'components/buttons.css',
        $css_path . 'components/switch.css',
        $css_path . 'components/checkbox-radio-out.css',
        $css_path . 'components/checkbox-radio-in.css',
        $css_path . 'components/social.css',
        $css_path . 'components/contacts.css',
        $css_path . 'layout/layout.css',
        $css_path . 'layout/sections.css',
        $css_path . 'layout/sidebar.css',
        $css_path . 'vendor/wordpress.css',
    );
    fw_preload_styles( $base_css );


    if( is_home() || is_archive() || isset( $_GET['s'] ) ){
        fw_load_styles($css_path.'parts/post-loop.css');
    }

    if( is_singular() ){
        fw_load_styles($css_path.'parts/article-content.css');
    }

    fw_acf_flex_content_block_css();

    fw_preload_styles(  $css_path.'components/pagination.css' );
    fw_preload_styles(  $css_path.'vendor/icons.css' );
    fw_preload_styles(  $css_path.'layout/footer.css' );

    //  Empty style.css. Can be used from wordpress theme editor
    fw_preload_styles(  get_stylesheet_directory_uri() . '/style.css' );

    fw_load_styles(  $css_path . 'classes/css-classes.css' );

}
add_action( 'wp_head', 'fw_css_files', 5 );


/**
 * Load CSS styles inline
 */
function fw_css_files_all_inline(){

    $css_path = get_stylesheet_directory() . '/css/';
    $css_path_preload = get_stylesheet_directory_uri() . '/css/';

    if( is_user_logged_in() ){
        fw_load_styles_inline( $css_path.'admin/admin.css' );
    }

    //  Base Styles
    $base_css = array(
        $css_path . 'components/fonts.css',
        $css_path . 'vendor/icons.css',
        $css_path . 'components/normalize.css',
        $css_path . 'vendor/bootstrap.css',
        $css_path . 'layout/header.css',
        //$css_path . 'layout/desktop-menu.css',
        $css_path . 'layout/desktop-menu-flipping.css',
        //$css_path . 'layout/mobile-menu.css',
        $css_path . 'layout/mobile-menu-flipping.css',
        $css_path . 'components/typography.css',
        $css_path . 'components/media.css',
        $css_path . 'components/inputs.css',
        $css_path . 'components/buttons.css',
        $css_path . 'components/switch.css',
        $css_path . 'components/checkbox-radio-out.css',
        $css_path . 'components/checkbox-radio-in.css',
        $css_path . 'components/contacts.css',
        $css_path . 'components/social.css',
        $css_path . 'layout/layout.css',
        $css_path . 'layout/sections.css',
        $css_path . 'layout/sidebar.css',
        $css_path . 'vendor/wordpress.css',
    );
    fw_load_styles_inline( $base_css );


    if( is_home() || is_archive() || isset( $_GET['s'] ) ){
        fw_load_styles_inline($css_path.'parts/post-loop.css');
    }

    if( is_singular() ){
        fw_load_styles_inline($css_path.'parts/article-content.css');
    }

    fw_acf_flex_content_block_css();

    fw_load_styles_inline(  $css_path . 'vendor/icons.css' );
    fw_preload_styles(  $css_path_preload . 'components/pagination.css' );
    fw_preload_styles(  $css_path_preload . 'layout/footer.css');
    fw_load_styles_inline(  get_stylesheet_directory() . '/style.css' );
    fw_load_styles_inline(  $css_path . 'classes/css-classes.css' );

}
//add_action( 'wp_head', 'fw_css_files_all_inline', 5 );