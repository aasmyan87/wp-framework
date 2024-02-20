<?php
/**
 * Hooks For Remove
 */


/**
* Disable block library styles
*/
function disable_default_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'disable_default_styles' );

/**
 * Disable svg filters in head tag
 */
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
* Disable the emoji's
*/
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );


/**
* Remove admin bar html margin
*/
function remove_admin_bar_bump(){
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_bar_bump');

/**
* Remove Paragraph from post excerpt
*/
remove_filter( 'the_excerpt', 'wpautop' );

/**
* Remove “Category:” from category title
*/
function theme_category_title( $title ) {
    if (is_category()) {
        $title = single_cat_title('', false);
    }
    return $title;
}
add_filter('get_the_archive_title', 'theme_category_title');

/**
* Remove jQuery migrate
*/
function isa_remove_jquery_migrate(&$scripts){
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.12.4');
    }
}
add_filter('wp_default_scripts', 'isa_remove_jquery_migrate');

