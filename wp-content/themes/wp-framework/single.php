<?php
/**
 * The template for displaying all single posts
*/

get_header();
?>
	<main id="primary" class="fw-main">
        <section class="fw-section">
            <div class="container">
                <div class="row gy-30">
                    <div class="col-lg-8">
                        <?php
                            while ( have_posts() ) :  the_post();
                                get_template_part( 'template-parts/content-single', get_post_type() );
                            endwhile;
                        ?>
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
