<?php
/**
 * Search form
 */
?>

<form class="row gx-10 gy-15" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="col-md">
        <input type="text" class="fw-input input-primary search-input" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>" />
    </div>
    <div class="col-md-auto">
        <button class="fw-btn btn-secondary btn-block" type="submit">
            <?php esc_html_e('Search', 'fw'); ?>
        </button>
    </div>
</form>