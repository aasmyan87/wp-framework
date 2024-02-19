<?php
/**
 *  Theme Setup
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fw_setup() {
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on fw, use a find and replace
        * to change 'fw' to the name of your theme in all the template files.
        */
    load_theme_textdomain( 'fw', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.

    //add_theme_support( 'automatic-feed-links' );

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support( 'title-tag' );

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'header_menu' => esc_html__( 'Header', 'fw' ),
            'footer_menu' => esc_html__( 'Footer', 'fw' ),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

}
add_action( 'after_setup_theme', 'fw_setup' );

/**
 * Register widget area.
 */
function fw_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'fw' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'fw' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'fw_widgets_init' );

/**
 * Add Header Menu Walker
 */
require_once get_template_directory() . '/lib/walker.php';
require_once get_template_directory() . '/lib/walker-flipping.php';


/**
 * Headers Policy: Force Load Page On Top
 */
function fw_headers(){

    $REQUEST_URI = $_SERVER['REQUEST_URI'];

    $base = basename($REQUEST_URI);
    if ((is_admin() && stripos($REQUEST_URI, '/wp-admin') !== false) || (stripos($REQUEST_URI, '/feed') !== false && $base == 'feed')) {

        $headers['X-Robots-Tag'] = 'noindex';

    }

    $headers['document-policy'] = 'force-load-at-top';


    return $headers;

}
add_filter('wp_headers', 'fw_headers', 10);



/**
 * Enable the new ACF behavior early
 */
add_filter( 'acf/the_field/escape_html_optin', '__return_true' );

/**
 * Save custom fields
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/acf/';


    // return
    return $path;

}

/**
 * Load custom fields
 */
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {

    // remove original path (optional)
    unset($paths[0]);


    // append path
    $paths[] = get_stylesheet_directory() . '/acf/';


    // return
    return $paths;

}

//  Add Analytics example function
function fw_add_gtag(){
    if ( $_SERVER['SERVER_NAME'] !== 'localhost' && !is_user_logged_in() ) {
        ?>
        <!--<script></script>-->
        <?php
    }
}
add_action('before-body-close', 'fw_add_gtag');