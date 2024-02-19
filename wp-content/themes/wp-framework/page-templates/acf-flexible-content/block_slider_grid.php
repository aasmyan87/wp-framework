<?php

$slides_count = get_sub_field('slides');
$slides_to_show = get_sub_field('slides_to_show');
$dots = get_sub_field('dots');
$arrows = get_sub_field('arrows');
$no_arrows = '';
if( empty( $arrows ) ) {
    $no_arrows = "style='max-width: inherit;'";
}
?>
<section class="fw-section">
    <div class="container">
        <div class="fw-gsl">
            <div class="fw-gsl--track">
                <?php if( $slides_count && count( $slides_count ) > $slides_to_show ): ?>
                    <?php if( !empty( $arrows ) ) : ?>
                        <button  id="<?php echo get_row_layout().'_'.get_row_index().'_arr_prev' ?>"  aria-label="Prev Slide" class="arrw-prev remove-gsl-arrow-preload">
                            <i class="icon-angle-left"></i>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                <div <?php echo $no_arrows; ?> class="fw-gsl--outer remove-gsl-preload-height">
                    <div id="<?php echo get_row_layout().'_'.get_row_index() ?>" class="slick-slider slick-preloader">
                        <?php
                        if( have_rows('slides') ):
                            while( have_rows('slides') ) : the_row();
                            $slide_title = get_sub_field('slide_title');
                            $slide_title_tag = get_sub_field('slide_title_tag');
                            $slide_title_class = get_sub_field('slide_title_class');
                            $slide_text = get_sub_field('slide_text');
                            $slide_extra_class = get_sub_field('slide_extra_class');
                        ?>
                        <div class="fw-gsl--slide <?php if( !empty( $slide_extra_class ) ) { echo $slide_extra_class; } ?>">
                            <div class="fw-gsl--inner">
                                <?php if( !empty( $slide_title ) ): ?>
                                <<?php echo $slide_title_tag ?> <?php if( !empty( $slide_title_class ) ) { echo "class='$slide_title_class'"; } ?>><?php echo $slide_title ?></<?php echo $slide_title_tag ?>>
                            <?php endif; ?>
                            <?php if( !empty( $slide_text ) ): ?>
                                <?php echo $slide_text; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php endwhile;
                    endif; ?>
                </div>
            </div>
            <?php if( $slides_count && count( $slides_count ) > $slides_to_show ): ?>
                <?php if( !empty( $arrows ) ) : ?>
                    <button id="<?php echo get_row_layout().'_'.get_row_index().'_arr_next' ?>" aria-label="Next Slide" class="arrw-next remove-gsl-arrow-preload">
                        <i class="icon-angle-right"></i>
                    </button>
                <?php endif; ?>
            <?php endif; ?>
            </div>
            <?php if( $slides_count && count( $slides_count ) > $slides_to_show ): ?>
                <?php if( !empty( $dots ) ) : ?>
                    <div id="<?php echo get_row_layout().'_'.get_row_index().'_dots' ?>" class="fw-gsl--dots"></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>