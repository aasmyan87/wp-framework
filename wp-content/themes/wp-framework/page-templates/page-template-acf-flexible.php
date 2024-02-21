<?php
/* Template Name: Content Blocks */
get_header();

?>
    <main id="primary" class="fw-main">
        <?php if ( have_rows('content_blocks') ):
            ?>

            <?php while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
                <?php
                    $file = 'page-templates/acf-flexible-content/' . get_row_layout() . '.php';


                    if ( file_exists( dirname( dirname(__FILE__) ) . '/' . $file ) ) {

                        include( locate_template( $file ) );
                    }
                ?>
            <?php endwhile; ?>

        <?php endif; ?>
    </main>

<?php

get_footer();
