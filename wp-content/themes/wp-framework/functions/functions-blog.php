<?php

/**
 * Post Author
 */
if ( ! function_exists( 'fw_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function fw_posted_by() {
        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'fw' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;


/**
 * Post Date
 */
if ( ! function_exists( 'fw_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function fw_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'fw' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;


/**
 * Get Post Categories
 */
if ( ! function_exists( 'fw_post_cat' ) ) :
    function fw_post_cat() {
        if ( 'post' === get_post_type() ) {
            $categories_list = get_the_category_list( esc_html__( '', 'fw' ) );
            if ( $categories_list ) {
                echo $categories_list;
            }
        }
    }
endif;


/**
 * Get Post Tag
 */
if ( ! function_exists( 'fw_post_tag' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function fw_post_tag() {
        if ( 'post' === get_post_type() ) {
            $tags_list = get_the_tag_list( '', esc_html_x( '', '', 'fw' ) );
            if ( $tags_list ) {
                echo $tags_list;
            }
        }
    }
endif;


/**
 * Pagination
 */
if ( ! function_exists( 'fw_pagination' ) ) :

    function fw_pagination()
    {
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="icon-angle-left"></i>',
            'next_text' => '<i class="icon-angle-right"></i>',
            'class' => __('fw-pagination'),
            'screen_reader_text' => __('')
        ));
    }
endif;

/**
 * Single Post Navigation
 */
if (!function_exists('theme_post_navigation')) :
    function theme_post_navigation()
    {
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'theme_domain') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'theme_domain') . '</span> <span class="nav-title">%title</span>',
                'class' => 'prefix-post-single--nav',
            )
        );
    }
endif;

/**
 * Limit post text on blog page
 */
function theme_excerpt_length(){
    return 20;
}
add_filter('excerpt_length', 'theme_excerpt_length');
