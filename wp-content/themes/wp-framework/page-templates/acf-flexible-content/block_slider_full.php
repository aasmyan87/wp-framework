<?php
$slides_count = get_sub_field('slides');
$dots = get_sub_field('dots');
$arrows = get_sub_field('arrows');
$image_slide_fetchpriority = get_sub_field('image_slide_fetchpriority');

?>
<?php if( $slides_count ): ?>
    <div class="fw-fsl">
        <div id="<?php echo get_row_layout().'_'.get_row_index() ?>" class="slick-slider slick-preloader">
            <?php
            if( have_rows('slides') ):
                while( have_rows('slides') ) : the_row();
                    $slide_image_desktop_1x = get_sub_field('slide_image_desktop_1x');
                    $slide_image_desktop_2x = get_sub_field('slide_image_desktop_2x');
                    $slide_image_mobile = get_sub_field('slide_image_mobile');
                    $slide_extra_class = get_sub_field('slide_extra_class');
                    $slide_extra_id = get_sub_field('slide_extra_id');
                    $slide_title = get_sub_field('slide_title');
                    $slide_title_tag = get_sub_field('slide_title_tag');
                    $slide_title_class = get_sub_field('slide_title_class');
                    $slide_text = get_sub_field('slide_text');
            ?>
            <div class="fw-fsl--slide <?php if( !empty( $slide_extra_class ) ) { echo $slide_extra_class; } ?>">
                <div class="fw-fsl--inner">
                    <div class="fw-fsl--content container">
                        <?php if( !empty( $slide_title ) ): ?>
                            <<?php echo $slide_title_tag ?> <?php if( !empty( $slide_title_class ) ) { echo "class='$slide_title_class'"; } ?>><?php echo $slide_title ?></<?php echo $slide_title_tag ?>>
                        <?php endif; ?>
                        <?php if( !empty( $slide_text ) ): ?>
                            <?php echo $slide_text; ?>
                        <?php endif; ?>
                    </div>
                    <?php
                    fw_get_picture( array( $slide_image_desktop_1x, '' ), array( $slide_image_desktop_2x, '' ), '', $image_slide_fetchpriority, '', $slide_title, '', );
                    ?>
                </div>
            </div>
        <?php
        endwhile;
        endif;
        ?>
        </div>
        <?php if( $slides_count && count( $slides_count ) > 1 ): ?>
            <?php if( !empty( $arrows ) ) : ?>
                <div class="fw-fsl--arrw">
                    <button id="<?php echo get_row_layout().'_'.get_row_index().'_arr_prev' ?>" aria-label="Prev Slide" class="arrw-prev">
                        <i class="icon-angle-left"></i>
                    </button>
                    <button id="<?php echo get_row_layout().'_'.get_row_index().'_arr_next' ?>" aria-label="Next Slide" class="arrw-next">
                        <i class="icon-angle-right"></i>
                    </button>
                </div>
            <?php endif; ?>
            <?php if( !empty( $dots ) ) : ?>
                <div id="<?php echo get_row_layout().'_'.get_row_index().'_dots' ?>" class="fw-fsl--dots"></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>