<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-sm-6">
    <div class="fw-post">

        <div class="fw-post--img">
            <a class="fw-obj-img fw-post-img" title="<?php echo esc_attr( get_the_title() ); ?>" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                <?php fw_get_thumb_by_size('medium', 'large', false, true, 'obj-img')  ?>
            </a>
        </div>

        <div class="fw-post--content">

            <h2 class="h5">
                <a title="<?php echo esc_attr( get_the_title() ); ?>" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                    <?php echo get_the_title(); ?>
                </a>
            </h2>

            <div class="fw-post--meta">
                <?php
                fw_posted_on();
                fw_posted_by();
                ?>
            </div>

            <div class="fw-post--excerpt">
                <?php the_excerpt(); ?>
            </div>

            <div class="fw-post--cat link-white">
                <?php fw_post_cat(); ?>
            </div>

            <div class="fw-post--tag link-dark">
                <?php fw_post_tag(); ?>
            </div>
        </div>

    </div>
</article>
