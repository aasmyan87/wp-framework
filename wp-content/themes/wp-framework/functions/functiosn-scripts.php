<?php
/**
 * Load JS
 */
function fw_load_scripts(){
    wp_register_script('scripts', get_stylesheet_directory_uri() . '/js/theme/theme.min.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('scripts');
}
add_action('wp_enqueue_scripts', 'fw_load_scripts', 5);

/**
 * Load ACF flexible content js
 */
function fw_load_blocks_script(){
    fw_acf_flex_content_block_js();
}
add_action('wp_footer', 'fw_load_blocks_script', 1);

/**
 * Add Defer attr to script tags
 */
function add_defer_attribute( $tag, $handle ){
    // Add defer="defer" attribute only to specific script handles
    if ( 'scripts' === $handle ) {
        $tag = str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);