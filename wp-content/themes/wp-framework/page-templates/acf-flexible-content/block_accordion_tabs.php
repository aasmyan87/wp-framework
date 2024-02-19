<?php

$title = get_sub_field('title');
$title_tag = get_sub_field('title_tag');
$title_class = get_sub_field('title_class');
$text = get_sub_field('text');
$extra_id = get_sub_field('extra_id');
$extra_class = get_sub_field('extra_class');

$tab_id = get_row_index();

?>

<section <?php if( !empty( $extra_id ) ) { echo 'id="'.$extra_id.'"'; } ?> class="fw-section <?php if( !empty( $extra_class ) ) { echo $extra_class; }?>">
    <div class="container">
        <?php if( !empty( $title ) ) : ?>
            <header class="fw-section--head">
            <<?php echo $title_tag; ?> class="fw-section--h <?php if( !empty( $title_class ) ) {  echo $title_class; } ?>"><?php echo $title; ?></<?php echo $title_tag; ?>>
            </header>
        <?php endif; ?>
        <?php if( !empty( $title ) ) : ?>
            <?php echo $text; ?>
        <?php endif; ?>

        <?php if( have_rows('tabs') ): ?>
            <div class="fw-acc">
                <?php $i = 0; while( have_rows('tabs') ): the_row(); ?>
                    <?php
                        $tab_label = get_sub_field('tab_label');
                        $tab_content = get_sub_field('tab_content');
                    ?>
                    <div class="fw-acc--item">
                        <a class="fw-acc--nav ac-nav_js <?php if( $i == 0 ){ echo 'active'; } ?>" href="#">
                            <span><?php echo $tab_label; ?></span>
                            <i class="fw-acc--ico icon-angle-down"></i>
                        </a>
                        <div class="fw-acc--content">
                            <?php echo $tab_content; ?>
                        </div>
                    </div>
                <?php $i++; endwhile;  ?>
            </div>
        <?php endif; ?>
    </div>
</section>
