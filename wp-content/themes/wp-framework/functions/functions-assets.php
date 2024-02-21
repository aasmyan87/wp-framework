<?php
/**
 * Check ACF functions on exist
 */


/**
 * Compress CSS Buffer
 */
function fw_compress_css( $buffer, $compress = 0 ) {
    if ( $compress ) {
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '     '], '', $buffer);
        $buffer = preg_replace(['(( )+{)', '({( )+)'], '{', $buffer);
        $buffer = preg_replace(['(( )+})', '(}( )+)', '(;( )*})'], '}', $buffer);
        $buffer = preg_replace(['(;( )+)', '(( )+;)'], ';', $buffer);
    }
    return $buffer;
}

/**
 * Compress CSS files
 */
function fw_compress_style_files( $filename, $replace, $compress = 1 ) {

    if ( file_exists( $filename ) && filesize( $filename ) != 0 ) {
        $handle = fopen( $filename, "r" );

        $contents = fread( $handle, filesize( $filename ) );

        $contents = str_replace( $replace, get_stylesheet_directory_uri() . '/', $contents );
        fclose( $handle );
        if ( $compress ) {

            $contents = fw_compress_css( $contents, $compress );
        }
        echo $contents;
    }
}

/**
 * Convert css styles to inline
 */
function fw_load_styles_inline( $styles ) {
    if ( empty( $styles ) ) {
        return;
    }

    if ( ! is_array( $styles ) ) {
        $styles = array( $styles );
    }

    foreach ( $styles as $style ) {
        if ( ! file_exists( $style ) || filesize( $style ) == 0 ) {
            continue; // Skip empty or non-existent files
        }

        $fil_no_ext = str_replace( '.css', '', basename( $style ) );
        if ( _INLINE_CSS_IDS ) {
            echo "<style id='css-$fil_no_ext'>";
        } else {
            echo "<style>";
        }

        fw_compress_style_files( $style, '../../', false );
        echo "</style>";
    }
}


/**
 * Print inline styles from array of styles
 */
function fw_print_inline_styles( $styles ){
    if( !empty( $styles ) ){
        foreach ($styles as $property => $style){
            if( !empty( $style ) ) {
                echo $property.':'.$style.';';
            }
        }
    }
}

/**
 * Load CSS styles
 */
function fw_load_styles( $css_files = [] )  {
    $files = is_array( $css_files ) ? $css_files : [ $css_files ];

    foreach ( $files as $css_file ) {
        echo '<link rel="stylesheet" href="' . esc_url( $css_file . '?ver=' . _S_VERSION ) .  '" media="all">';
    }
}

/**
 * Preload CSS styles
 */
function fw_preload_styles( $css_files = [] ) {
    $files = is_array( $css_files ) ? $css_files : [ $css_files ];

    foreach ( $files as $css_file ) {
        echo '<link rel="preload" as="style" href="' . esc_url( $css_file . '?ver=' . _S_VERSION ) . '" media="all">';
        echo '<link rel="stylesheet" href="' . esc_url( $css_file . '?ver=' . _S_VERSION ) . '" media="all">';
    }
}

/**
 * Defer JS Loading
 */
function fw_script( $path = '', $defer = false ){
    ?>
    <script <?php if( $defer ){ echo 'defer="defer"'; }  ?> src="<?php echo esc_url( get_stylesheet_directory_uri() . $path ) ?>"></script>
    <?php
}


/**
 * Load ACF content blocks css (flexible content)
 */

function fw_acf_flex_content_block_css(){

    //  ACF: Content Blocks CSS
    if ( have_rows('content_blocks') ) {
        $blocks_css_files = array();
        $css_unique_files = array();

        while (have_rows('content_blocks')) : the_row();

            $row_layout = get_row_layout();

            $file = '/css/acf-flexible-blocks/' . $row_layout . '.css';


            if ( $row_layout == 'block_slider_full' || get_row_layout() == 'block_slider_grid' ) {
                $blocks_css_files[] = '/css/vendor/slick-slider.css';
            }

            if ( file_exists( dirname( dirname( __FILE__ ) ) . '/' . $file ) ) {
                $blocks_css_files[] = $file;
                $css_unique_files = array_unique( $blocks_css_files );
            }

        endwhile;

        $i = 0;
        $preload_position = get_field('css_preload_factor');
        foreach ( $css_unique_files as $css_file ) {
            $i++;
            if ( !empty( $preload_position ) ) {
                if ( $i < $preload_position ) {
                    fw_load_styles_inline(get_stylesheet_directory() . $css_file );
                } else {
                    fw_preload_styles( get_stylesheet_directory_uri() . $css_file );
                }
            } else {
                fw_load_styles_inline(get_stylesheet_directory() . $css_file );
            }
        }
    }
}


/**
 * Load ACF content blocks (flexible content)
 */

function fw_acf_flex_content_block_js(){


    if ( have_rows('content_blocks') ) {

        $blocks_js_files = [];
        $has_vendor_js = [
            'has_slick' => true,
            'has_tabs' => true,
            'has_accordion' => true
        ];

        while ( have_rows( 'content_blocks' ) ) : the_row();

            $row_layout = get_row_layout();
            $file = '/js/acf-flexible-blocks/' . $row_layout . '.js';

            if ( file_exists( dirname( dirname(__FILE__) ) . '/' . $file ) ) {

                $blocks_js_files[] = $file;

            }

            //  Horizontal and Vertical tabs
            if( ( get_row_layout() == 'block_accordion_tabs' )  && $has_vendor_js['has_accordion'] ) {
                $has_vendor_js['has_accordion'] = false;
                fw_script( '/js/theme/accordion.min.js', true );
            }

            //  Accordion
            if( ( get_row_layout() == 'block_horizontal_tabs' || get_row_layout() == 'block_vertical_tabs' )  && $has_vendor_js['has_tabs'] ) {
                $has_vendor_js['has_tabs'] = false;
                fw_script( '/js/theme/tabs.min.js', true );
            }

            //  Slick sliders: Start
            if( ( get_row_layout() == 'block_slider_full' || get_row_layout() == 'block_slider_grid' )  && $has_vendor_js['has_slick'] ) {
                $has_vendor_js['has_slick'] = false;
                fw_script( '/js/vendor/slick.min.js', true );
            }

            //  Slider: Full
            if( get_row_layout() == 'block_slider_full' ){
                $autoplay = get_sub_field('autoplay');
                $dots = get_sub_field('dots');
                $arrows = get_sub_field('arrows');
                $fade = get_sub_field('fade');

                ?>
                <script>
                    jQuery(document).ready(function ($) {
                        let full_slider = $('#<?php echo get_row_layout().'_'.get_row_index();  ?>');
                        let full_slider_dots = $('#<?php echo get_row_layout().'_'.get_row_index();  ?>_dots');
                        full_slider.slick({
                            <?php if( !empty( $fade ) ) { echo 'fade: true,'; } ?>
                            <?php if( !empty( $autoplay ) ) { echo 'autoplay: true,'; } ?>
                            <?php if( !empty( $dots ) ) { echo 'dots: true,'; } ?>
                            <?php if( !empty( $arrows ) ) { echo 'arrows: true,'; }?>
                            prevArrow: $('#<?php echo get_row_layout().'_'.get_row_index();  ?>_arr_prev'),
                            nextArrow: $('#<?php echo get_row_layout().'_'.get_row_index();  ?>_arr_next'),
                            appendDots: full_slider_dots
                        });
                    });
                </script>
                <?php
            }



            // Slider Grid
            else if( get_row_layout() == 'block_slider_grid' ){
                $slides_count = get_sub_field('slides');
                $autoplay = get_sub_field('autoplay');
                $dots = get_sub_field('dots');
                $arrows = get_sub_field('arrows');
                $slides_to_show = get_sub_field('slides_to_show');
                ?>
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        jQuery(document).ready(function ($) {
                            let grid_slider = $('#<?php echo get_row_layout().'_'.get_row_index();  ?>');
                            let grid_slider_dots = $('#<?php echo get_row_layout().'_'.get_row_index();  ?>_dots');
                            grid_slider.on('init', function (event, slick){
                                $('.remove-gsl-preload-height').removeClass('remove-gsl-preload-height');
                                $('.remove-gsl-arrow-preload').removeClass('remove-gsl-arrow-preload');
                            })
                            if (grid_slider.length !== 0){
                                grid_slider.slick({
                                    <?php if( !empty( $autoplay ) ) { echo 'autoplay: true,'; } ?>
                                    <?php if( !empty( $dots ) ) { echo 'dots: true,'; } ?>
                                    <?php if( !empty( $arrows ) ) { echo 'arrows: true,'; }?>
                                    <?php
                                    if( !empty( $slides_to_show ) && count ($slides_count) > $slides_to_show ) {
                                        echo "slidesToShow: $slides_to_show,";
                                    } else {
                                        echo "slidesToShow: 3,";
                                    }
                                    ?>
                                    slidesToScroll: 1,
                                    infinite: true,
                                    rows: 0,
                                    prevArrow: $('#<?php echo get_row_layout().'_'.get_row_index();  ?>_arr_prev'),
                                    nextArrow: $('#<?php echo get_row_layout().'_'.get_row_index();  ?>_arr_next'),
                                    appendDots: grid_slider_dots,
                                    responsive: [
                                        {
                                            breakpoint: 1200,
                                            settings: {
                                                slidesToShow: 2,
                                            }
                                        },
                                        {
                                            breakpoint: 768,
                                            settings: {
                                                slidesToShow: 1,
                                            }
                                        },
                                    ]
                                });
                            }
                        });
                    });
                </script>
                <?php

            }


        endwhile;

        foreach ( array_unique( $blocks_js_files ) as $js_file) {

            $js_handle = str_replace(array("/js/blocks/", ".js"), '', $js_file);

            wp_register_script($js_handle, get_stylesheet_directory_uri() . $js_file, array('jquery'), _S_VERSION, true);
            wp_enqueue_script($js_handle);
        }
    }
}