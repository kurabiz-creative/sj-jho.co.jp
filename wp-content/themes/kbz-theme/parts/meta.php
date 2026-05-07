<?php
global $base, $origin_options, $pagename, $body_class, $base, $fullscreen_id, $fv, $fv_title, $fv_title_en, $css_name;

// ファーストビューの画像
if(!is_front_page()){
	// ページ指定がない場合、表示中のページが対象
	if(!$fullscreen_id) $fullscreen_id = get_the_ID();

	// ファーストビューの画像取得
	$fv_id = get_post_meta($fullscreen_id, "page_fv", true);
	$fv = wp_get_attachment_image_src($fv_id, 'full');
}
?>
<!doctype html>
<html <?php language_attributes(); ?> style="scroll-behavior: auto;">
<head>
    <?php
get_template_part('parts/gtm', 'meta');
    ?><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" media="handheld" href="#" />
    <title><?php wp_title(); ?></title>
    <?php
wp_head();
    ?>
    <?php get_template_part('parts/web-font'); ?>
</head>
