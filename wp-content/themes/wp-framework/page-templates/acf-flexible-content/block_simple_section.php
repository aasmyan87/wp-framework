<?php

$title = get_sub_field('title');
$title_tag = get_sub_field('title_tag');
$title_class = get_sub_field('title_class');
$text = get_sub_field('text');
$extra_id = get_sub_field('extra_id');
$extra_class = get_sub_field('extra_class');
$bg_img_1x = get_sub_field('background_desktop_1x');
$bg_img_2x = get_sub_field('background_desktop_2x');
$bg_img_mob = get_sub_field('background_mobile');
$bg_fetchpriority = get_sub_field('fetchpriority');
$has_bg = '';
if( !empty( $bg_img_1x ) ){
    $has_bg = "has-bg ";
}




/**
If you add to section extra class contains background color, add "has-bg" class too
 */
?>

<section <?php if( !empty( $extra_id ) ) { echo 'id="'.$extra_id.'"'; } ?> class="fw-section <?php echo $has_bg;  if( !empty( $extra_class ) ) { echo $extra_class; }?>">

    <div class="container">
        <?php if( !empty( $title ) ) : ?>
            <header class="fw-section--head">
                <<?php echo $title_tag; ?> class="fw-section--h <?php if( !empty( $title_class ) ) {  echo $title_class; } ?>"><?php echo $title; ?></<?php echo $title_tag; ?>>
            </header>
        <?php endif; ?>
        <?php if( !empty( $text ) ) : ?>
            <?php echo $text; ?>
        <?php endif; ?>
    </div>
    <?php
        fw_get_picture( array( $bg_img_1x, ''),  array( $bg_img_2x, ''), array( $bg_img_mob, 'thumbnail' ), $bg_fetchpriority, '', $title, 'bg-img' );
    ?>
</section>
