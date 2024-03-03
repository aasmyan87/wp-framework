<?php
/**
 * The header for our theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fw' ); ?></a>

<!--header-fixed, header-jump_js, header-reduce_js, header-transparent_js-->
<header id="masthead" class="fw-header--outer header-jump_js">
    <div class="fw-header">
        <div class="fw-header--container">
            <button aria-label="Open Mobile Menu" class="menu-open-btn menu-open-btn_js">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <?php
                fw_get_desktop_header_logo();
                fw_get_mobile_header_logo();
                fw_flipping_navigation();
            ?>
        </div>
    </div>
</header>
