<?php
// 下層ページ用FVブロックの呼び出し
$parent_id = get_page_by_path('news');
$fullscreen_id = $parent_id->ID;

$current_term = get_queried_object();

get_header();
?>

<div class="block-box">
    <div class="container">
        <div class="flex">
            <section class="archive-content">
                <?php
        if(have_posts()):
            while(have_posts()):
                the_post();
                $category = get_the_category();
                $title = get_the_title();
                    ?>
                    <div class="postInfoTitle">
                        <div class="postInfoBox">
                            <div class="date-box">
                                <time class="date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
                            </div>
                            <?php if(!empty($category)) : ?>
                            <div class="m-category-box">
                                <?php foreach($category as $cat): ?>
                                <span class="m-category"><?php echo esc_html($cat->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <h1 class="bold"><?php echo $title; ?></h1>
                    </div>
                    <div class="postContent">
                        <?php the_content(); ?>
                    </div>
                    <?php
                output_pager(get_the_date("Y-m-d H:i:s"));
            endwhile;
        endif;
                ?>
            </section>
            <aside class="archive-side">
                <?php get_sidebar(); ?>
            </aside>
        </div>
	</div>
</div>
<div class="space"></div>
<?php
get_footer();

// ページャの出力
function output_pager($this_date){
	global $wpdb;

	//↓検索クエリ(default)
	$where = array(
		"post_type = 'post'",
		"post_status = 'publish'",
		"post_date < '" . $this_date . "'"
	);

	// ↓現記事より前の記事件数を取得
	$sql = "select count(*) from " . $wpdb->posts . " where " . join(" and ", $where);

	// ↓前記事がある場合
	if($wpdb->get_var($sql) > 0){
		// 現記事から直近の前記事を抽出
		$sql = "select * from " . $wpdb->posts . " where " . join(" and ", $where) . " order by post_date desc limit 0, 1";
		$prev = $wpdb->get_row($sql);
		// URLの生成
		$pager["prev"] = get_the_permalink($prev->ID);
	}
	
	// ↓現記事より次の記事件数を取得
	$where[2] = "post_date > '" . $this_date . "'";
	$sql = "select count(*) from " . $wpdb->posts . " where " . join(" and ", $where);
	
	// ↓次記事がある場合
	if($wpdb->get_var($sql) > 0){
		// 現記事から直近の次記事を抽出
		$sql = "select * from " . $wpdb->posts . " where " . join(" and ", $where) . " order by post_date limit 0, 1";
		$next = $wpdb->get_row($sql);

		// URLの生成
		$pager["next"] = get_the_permalink($next->ID);
	}
?>
    <?php
    if(isset($pager)):
    ?>
    <div class="postPager">
        <div class="flex">
            <?php
            if(!empty($pager["prev"])){
                echo '<div class="post-link__prev"><a class="post_prev btn" href="' . $pager["prev"] . '" rel="prev">前の投稿</a></div>';
            }else{
                echo '<div class="post-link__prev no-link"><span class="post_prev btn">前の投稿</span></div>';
            }
            ?>
            <?php
            if(!empty($pager["next"])){
                echo '<div class="post-link__next"><a class="post_next btn" href="' . $pager["next"] . '" rel="next">次の投稿</a></div>';
            }else{
                echo '<div class="post-link__next no-link"><span class="post_next btn">次の投稿</span></div>';
            }
            ?>
        </div>
        <div class="m-btn-box">
            <a href="<?php echo home_url(); ?>/news/" class="m-btn"><span class="text">お知らせ一覧へ</span><i class="ico-arr"></i></a>
        </div>
    </div>
    <?php
    endif;
    ?>
<?php
} // output_pager
?>