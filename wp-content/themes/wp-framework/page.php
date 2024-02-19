<?php
/**
 * The template for displaying all pages
*/

get_header();
?>
	<main id="primary" class="fw-main">
        <section class="fw-section has-bg bg-primary">
            <div class="container">
                <h1 class="color-secondary mb-0"><?php single_post_title(); ?></h1>
            </div>
        </section>
        <section class="fw-section">
            <div class="container">
                <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

                    endwhile;
                ?>
            </div>
        </section>
	</main>

<?php

get_footer();
