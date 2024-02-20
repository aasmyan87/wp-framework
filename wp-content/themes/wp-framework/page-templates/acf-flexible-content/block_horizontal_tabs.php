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
            <div class="fw-tb">
                <div class="fw-tb--head">
                    <ul class="fw-tb--nav">
                        <?php $i = 0; while( have_rows('tabs') ): the_row(); ?>
                            <?php
                                $tab_label = get_sub_field('tab_label');
                                $tab_content = get_sub_field('tab_content');
                            ?>
                            <li data-tab="tab-<?php echo $i.'_'.$tab_id; ?>" class="<?php if( $i == 0 ){ echo 'active'; } ?>">
                                <a class="tabs-nav_js" href="#">
                                    <?php echo $tab_label; ?>
                                </a>
                            </li>
                        <?php $i++; endwhile; ?>
                    </ul>
                </div>
                <div class="fw-tb--tabs">
                    <?php $i = 0; while( have_rows('tabs') ): the_row(); ?>
                        <?php
                            $tab_label = get_sub_field('tab_label');
                            $tab_content = get_sub_field('tab_content');
                        ?>

                        <div id="tab-<?php echo $i.'_'.$tab_id; ?>" class="fw-tb--content <?php if( $i == 0 ){ echo 'active'; } ?>">
                            <a class="fw-tb--nav-mob acc-nav_js <?php if( $i == 0 ){ echo 'active'; } ?>" href="#">
                                <span> <?php echo $tab_label; ?> </span>
                                <i class="fw-tb--ico icon-angle-down"></i>

                            </a>
                            <div class="fw-tb--inner">
                                <?php echo $tab_content; ?>
                            </div>
                        </div>

                    <?php $i++; endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
