<?php
    // FVブロックの呼び出し
    $parent_id = get_page_by_path('news');
    $fullscreen_id = $parent_id->ID;

    $current_term = get_queried_object();
    get_header();
?>
<div class="space-half"></div><div class="space-mini"></div>
<?php get_template_part('parts/archive-list', 'news'); ?>
<div class="space"></div>

<?php get_footer(); ?>