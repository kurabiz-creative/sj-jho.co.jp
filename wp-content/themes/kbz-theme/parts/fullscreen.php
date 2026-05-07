<?php
global $fullscreen_id, $fv, $fv_title, $fv_title_en;

// ファーストビューの見出しテキスト
if(!$fv_title){
	$fv_title = get_post_meta($fullscreen_id, "page_title", true);
	if(!$fv_title) $fv_title = get_the_title($fullscreen_id);
}

// ファーストビューの見出しテキスト（英語）
if(!$fv_title_en){
    $fv_title_en = get_post_meta($fullscreen_id, "page_title_en", true);
    if(!$fv_title_en) {
        $page_slug = '';
        $parent_post = get_post($fullscreen_id);
        if($parent_post) {
            // 親ページがある場合は親のslugを取得
            if($parent_post->post_parent) {
                $parent_post = get_post($parent_post->post_parent);
                $page_slug = $parent_post ? $parent_post->post_name : $parent_post->post_name;
            } else {
                $page_slug = $parent_post->post_name;
            }
        }
        $fv_title_en = ucfirst($page_slug);
    }
}
?>
<!-- h1 -->
<div id="pagettl" class="relative"<?php if($fv): ?> style="background-image: url(<?php echo is_array($fv) ? $fv[0] : $fv; ?>);"<?php endif; ?>>
    <div class="container">
        <?php if(is_single() || ( is_singular() && !is_page() )) : ?>
        <div class="">
            <div class=""><?php echo $fv_title; ?></div>
            <div class=""><?php echo $fv_title_en; ?></div>
        </div>
        <?php elseif(is_page('policy')) : ?>
        <h2 class="">
            <div class=""><?php echo $fv_title; ?></div>
            <div class=""><?php echo $fv_title_en; ?></div>
        </h2>
        <?php else : ?>
        <h1 class="">
            <div class=""><?php echo $fv_title; ?></div>
            <div class=""><?php echo $fv_title_en; ?></div>
        </h1>
        <?php endif; ?>
	</div>
</div>
<!-- //h1 -->