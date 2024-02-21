<?php
/**
 * All Media Functions (Images, Videos, Audio)
 */

/**
 * Define image new sizes (examples)
 */
add_image_size('single_post_thumb_1x', 850, 420, true);
add_image_size('single_post_thumb_2x', 1700, 840, true);


/**
 * Get Post thumbnail using thumbnail sizes
 * EX: fw_get_grid_thumb_by_size('medium', 'large', false, true, '')
 */
function fw_get_thumb_by_size( $image_1x = '', $image_2x = '', $fetchpriority = '', $lazy = '', $class = '' ){
    $post_id =  get_the_ID();

    $post_thumb_1x = get_the_post_thumbnail_url( $post_id, $image_1x );
    $post_thumb_2x = get_the_post_thumbnail_url( $post_id, $image_2x );
    $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);

    if( !$image_alt ){
        $image_alt = get_the_title();
    }
    ?>
    <?php if ( !empty( $post_thumb_1x ) && !empty( $post_thumb_2x ) ) :
        $post_thumb_attr_size = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_1x );
        $post_thumb_width = $post_thumb_attr_size[1];
        $post_thumb_height = $post_thumb_attr_size[2];
        ?>

        <picture>
            <?php if( $image_1x && $image_2x ) : ?>
                <source type="image/webp" srcset="<?php echo esc_url( $post_thumb_1x ); ?> 1x, <?php echo esc_url( $post_thumb_2x ); ?> 2x">
            <?php endif;?>
            <img
                width="<?php echo $post_thumb_width ?>"
                height="<?php echo $post_thumb_height ?>"
                src="<?php echo esc_url( $post_thumb_1x ); ?>"
                alt="<?php echo esc_attr( $image_alt ); ?>"
                <?php echo ! empty( $class ) ? 'class="' . esc_attr( $class ) . '"' : '' ?>
                <?php if( $fetchpriority ){ echo 'fetchpriority="high"'; } ?>
                <?php if( $lazy ){ echo 'loading="lazy"'; } ?>
            />
        </picture>

    <?php endif;
}

/**
 *  Get any image [1x,2x,mob]
 */
function fw_get_picture( $image_1x = array('', 'full'), $image_2x = array('', 'full'), $image_mob = array('', 'full'), $fetchpriority = '', $lazy = '', $alt = '', $class = ''  ){

    $image_1x_src = is_array( $image_1x ) ? wp_get_attachment_image_src( $image_1x[0], $image_1x[1] ) : null;
    $image_2x_src = is_array( $image_2x ) ? wp_get_attachment_image_src( $image_2x[0], $image_2x[1] ) : null;
    $image_mobile = is_array( $image_mob ) ? wp_get_attachment_image_src( $image_mob[0], $image_mob[1] ) : null;

    $image_alt = ! empty( $alt ) ? $alt : get_post_meta( $image_1x[0], '_wp_attachment_image_alt', true );

    ?>
    <?php if( !empty( $image_1x[0] ) ) : ?>
        <picture>
            <?php if( is_array( $image_mob ) && ! empty( $image_mobile ) ) : ?>
                <source type="image/webp" media="(max-width: <?php echo esc_html( $image_mobile[1] ) ?>px)" srcset="<?php echo esc_url( $image_mobile[0] ) ?>">
            <?php endif; ?>
            <source type="image/webp" srcset="<?php echo esc_url( $image_1x_src[0] ).' 1x' ?><?php echo ! empty( $image_2x_src ) ? ', ' . esc_url( $image_2x_src[0] ). ' 2x' : '' ?>">
            <img
                    src="<?php echo esc_url( $image_1x_src[0] ) ?>"
                    width="<?php echo esc_attr( $image_1x_src[1] ); ?>"
                    height="<?php echo esc_attr( $image_1x_src[2] ); ?>"
                    alt="<?php echo esc_attr( $image_alt ); ?>"
                    <?php echo empty( $fetchpriority ) ? 'loading="lazy"' : 'fetchpriority="high"' ?>
                    <?php echo ! empty( $class ) ? 'class="' . esc_attr( $class ) . '"' : '' ?>
            />
        </picture>
    <?php endif; ?>
    <?php
}

