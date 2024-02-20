<?php
/**
 * Template part for displaying page content in single.php
 */

?>

<article id="post-<?php the_ID(); ?>">

    <div class="fw-article--img fw-obj-img fw-spost-img">
        <?php fw_get_thumb_by_size('single_post_thumb_1x', 'single_post_thumb_2x', true, false, '')  ?>
    </div>

    <h1 class="h2"><?php echo get_the_title(); ?></h1>
    <?php
        the_content();
    ?>
</article>
