<?php
global $current_term;
$post_type = 'post';
$taxonomy = 'category';
if ($cat_all = get_terms($taxonomy, "fields=all&get=all")): ?>

<div id="side-archives" class="widget widget_archives sidebar_editable">
    <?php if (is_single()): ?>
        <div class="widget_title">アーカイブ</div>
    <?php else: ?>
        <h3 class="widget_title">アーカイブ</h3>
    <?php endif; ?>
    <div class="space-ptit">
        <div class="widget_archives-pulldown">
            <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                <option value="">月を選択</option>
                <?php
                    wp_get_archives([
                        'format' => 'option'
                    ]);
                ?>
            </select>
        </div>
    </div>
</div>

<div id="side-categories" class="widget widget_categories sidebar_editable">
    <?php if (is_single()): ?>
        <div class="widget_title">カテゴリ</div>
    <?php else: ?>
        <h3 class="widget_title">カテゴリ</h3>
    <?php endif; ?>
    <ul>
        <li>
            <a href="<?php echo home_url(); ?>/news/" class="<?php echo (!isset($current_term) ? ' on' : ''); ?>">ALL</a>
        </li>
        <?php foreach ($cat_all as $cat): ?>
            <li>
                <a href="<?php echo get_category_link($cat->term_id); ?>" class="<?php echo (isset($current_term->term_id) && $current_term->term_id == $cat->term_id ? ' on' : ''); ?>">
                    <?php echo esc_html($cat->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php
$new_posts = get_posts([
    'posts_per_page' => 5,
    'post_type'      => $post_type,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
]);
if ($new_posts): ?>
<div id="side-new-posts" class="widget widget_recent_entries sidebar_editable">
    <?php if (is_single()): ?>
        <div class="widget_title">最新記事</div>
    <?php else: ?>
        <h3 class="widget_title">最新記事</h3>
    <?php endif; ?>
    <ul>
        <?php foreach ($new_posts as $post): setup_postdata($post); ?>
            <li>
                <a href="<?php the_permalink(); ?>" class=""><?php the_title(); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); ?>
</div>
<?php endif; ?>
