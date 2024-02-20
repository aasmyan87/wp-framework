<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<main id="primary" class="fw-main">
    <section class="fw-section">
        <div class="container">
            <?php if ( have_posts() ) : ?>

                <h1>
                    <?php printf( esc_html__( 'Search Results for: %s', 'fw' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>

                <div class="row gy-30">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/content', 'search' ); ?>
                    <?php endwhile; ?>
                </div>

            <?php else : ?>

                <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>

        </div>
    </section>
</main>

<?php
get_footer();
