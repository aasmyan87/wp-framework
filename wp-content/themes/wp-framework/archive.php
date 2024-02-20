<?php
/**
 * The template for displaying archive pages
 *
 */

get_header();
?>

	<main id="primary" class="fw-main">
        <section class="fw-section has-bg bg-primary">
            <div class="container">
                <h1 class="color-secondary mb-0"><?php the_archive_title(); ?></h1>
                <div class="color-white mt-15">
                    <?php the_archive_description(); ?>
                </div>
            </div>
        </section>
        <section class="fw-section">
            <div class="container">
                <div class="row gy-30">
                    <div class="col-lg-8">
                        <?php  if ( have_posts() ) : ?>
                            <div class="row gy-30">
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php get_template_part( 'template-parts/content', get_post_type() ); ?>

                                <?php endwhile; ?>
                            </div>

                            <?php fw_pagination() ?>

                        <?php else : ?>

                            <?php get_template_part( 'template-parts/content', 'none' ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </section>
	</main>
<?php
get_footer();
