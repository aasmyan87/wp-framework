<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

	<main id="primary" class="fw-main">
        <section class="fw-section">
            <div class="container">
                <h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fw' ); ?></h1>
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'fw' ); ?></p>
                <?php
                get_search_form();

                /* translators: %1$s: smiley */
                $fw_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'fw' ), convert_smilies( ':)' ) ) . '</p>';
                ?>
            </div>
        </section>
	</main>

<?php
get_footer();
