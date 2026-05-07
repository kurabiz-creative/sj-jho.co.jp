<?php
global $origin_options, $pagename, $body_class, $base, $fullscreen_id, $fv, $fv_title, $fv_title_en, $body_id;
$body_class[] = 'is-loading';
get_template_part('parts/meta');
?>
<body <?php if($body_id): ?>id="<?php echo $body_id; ?>"<?php endif; ?> <?php body_class($body_class); ?>>
	<?php get_template_part('parts/gtm', 'body'); ?>

    <header>
        header.php
        <div class="bg-accent-link h-10">bg-basic</div>
    </header>

	<!-- main start -->
	<main id="main">
<?php if(!is_front_page()):
	get_template_part('parts/fullscreen');
?>
		<!-- breadcrumbs start -->
		<div id="breadcrumbs">
			<div class="container">
				<?php if(function_exists('bcn_display')) bcn_display(); ?>
			</div>
		</div>
		<!-- breadcrumbs end -->
<?php endif; ?>