<?php

$title = get_sub_field('title');
$title_tag = get_sub_field('title_tag');
$title_class = get_sub_field('title_class');
$text = get_sub_field('text');
$extra_id = get_sub_field('extra_id');
$extra_class = get_sub_field('extra_class');
$columns_per_row = get_sub_field('columns_per_row');
$brk = '';
switch ($columns_per_row) {
    case 4:
        $brk = 'col-xl-3 col-lg-4 col-md-6 col-sm-6';
        break;
    case 3:
        $brk = 'col-xl-4 col-lg-4 col-md-6 col-sm-6';
        break;
    case 2:
        $brk = 'col-xl-6 col-lg-6 col-md-6 col-sm-6';
        break;
    case 1:
        $brk = 'col-12';
        break;
}

?>

<section <?php if( !empty( $extra_id ) ) { echo 'id="'.$extra_id.'"'; } ?> class="fw-section <?php if( !empty( $extra_class ) ) { echo $extra_class; }?>">
    <div class="container">
        <?php if( !empty( $title ) ) : ?>
            <header class="fw-section--head">
                <<?php echo $title_tag; ?> class="fw-section--h <?php if( !empty( $title_class ) ) {  echo $title_class; } ?>"><?php echo $title; ?></<?php echo $title_tag; ?>>
            </header>
        <?php endif; ?>
        <?php if( !empty( $text ) ) : ?>
            <?php echo $text; ?>
        <?php endif; ?>

        <?php if( have_rows('columns') ): ?>
            <div class="row gy-30">
                <?php $i = 0; while( have_rows('columns') ): the_row(); ?>
                    <?php
                        $column_title = get_sub_field('column_title');
                        $column_content = get_sub_field('column_content');
                        $column_title_tag = get_sub_field('column_title_tag');
                        $column_title_class = get_sub_field('column_title_class');
                        $col_size = get_sub_field('columns_size');

                    ?>
                    <div class="<?php echo $brk; ?>">
                        <div class="fw-col--inner">
                            <<?php echo $column_title_tag; ?> class="fw-column--h <?php if( !empty( $column_title_class ) ) {  echo $column_title_class; } ?>"><?php echo $column_title; ?></<?php echo $column_title_tag; ?>>
                            <?php echo $column_content; ?>
                        </div>
                    </div>
                    <?php $i++; endwhile;  ?>
            </div>
        <?php endif; ?>
    </div>
</section>
