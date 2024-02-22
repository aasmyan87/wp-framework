<?php
/**
 * The template for displaying the footer
 */
$site_title = get_bloginfo('name');

?>

<footer class="fw-footer">
    <div class="container">
        <?php fw_footer_text(); ?> | &copy;
        <?php _e('Copyright', 'fw'); echo date(" Y"); ?>
    </div>
</footer>

<div class="menu-overlay menu-overlay_js"></div>
<?php wp_footer(); ?>

<?php do_action('before-body-close'); ?>
</body>
</html>
