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
<html <?php language_attributes(); ?>>
<head>
    <?php
get_template_part('parts/gtm', 'meta');
    ?><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="email=no,address=no">
<?php if (has_post_thumbnail()) : ?>
    <meta name="thumbnail" content="<?php the_post_thumbnail_url() ?>" />
<?php endif; ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" media="handheld" href="<?php echo home_url(); ?>" />
    <title><?php wp_title(); ?></title>
    <?php
wp_head();
    ?>
<style>
:root {
    /* ※画像関係の変数のみ */
    /* icon */
    --icon-pagetop: url(<?php tmpImg('icon/icon_pagetop.svg'); ?>);
    --icon-car: url(<?php tmpImg('icon/icon_car.svg'); ?>);
    --icon-msg: url(<?php tmpImg('icon/icon_msg.svg'); ?>);
    --icon-tel: url(<?php tmpImg('icon/icon_tel.svg'); ?>);

    --clip-round: url(<?php tmpImg('icon/clip_round.svg'); ?>);
}
</style>
</head>
