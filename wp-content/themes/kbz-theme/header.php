    <?php
global $origin_options, $pagename, $body_class, $base, $fullscreen_id, $fv, $fv_title, $fv_title_en, $body_id;
$body_class[] = 'is-loading';
get_template_part('parts/meta');
?>
<body <?php if($body_id): ?>id="<?php echo $body_id; ?>"<?php endif; ?> <?php body_class($body_class); ?>>
	<?php get_template_part('parts/gtm', 'body'); ?>

    <header id="header" class="l-header group/header fixed z-50 inset-x-0 top-0">
        <div class="relative z-[1] flex items-center gap-x-4 h-[var(--header-h-sp)] lg:h-[var(--header-scroll-h)] xl:h-[var(--header-h)] xl:group-[.is-scroll]/header:h-[var(--header-scroll-h)] bg-light-green transition-all duration-300">
            <<?php if(is_front_page()){ echo 'h1'; }else{ echo 'div'; } ?> class="logo pl-3.5 xl:pl-7">
                <a href="<?php echo home_url(); ?>" class="hover:opacity-70"><img class="w-[clamp(210px,30vw,430px)]" src="<?php echo _get_file('/assets/img/logo.png'); ?>" alt="株式会社ジャパン保険岡山"></a>
            </<?php if(is_front_page()){ echo 'h1'; }else{ echo 'div'; } ?>>

            <nav id="gnav" class="l-header-nav ml-auto pr-3.5 xl:pr-7">
                <button class="btn-nav lg:hidden group flex flex-col items-center justify-center aspect-square w-10 rounded-full bg-white border border-main transition duration-300">
                    <span class="w-[54%] h-px bg-main transition duration-300
                        before:block before:w-full before:h-full before:bg-main before:-translate-y-[0.4375rem] before:transition before:duration-300
                        after:block after:w-full after:h-full after:bg-main after:translate-y-[0.375rem] after:transition after:duration-300
                        group-[.is-open]:bg-transparent group-[.is-open]:before:rotate-[30deg] group-[.is-open]:before:translate-y-0 group-[.is-open]:after:rotate-[-30deg] group-[.is-open]:after:-translate-y-px">
                    </span>
                    <span class="sr-only">メニューを開く</span>
                </button>
                <div class="l-nav">
                    <div class="l-nav-inner">
                        <?php get_template_part('parts/menu'); ?>
                    </div>
                </div>
                <div class="fixed inset-x-0 bottom-0 lg:static flex lg:gap-x-2 xl:gap-x-4 lg:ml-7 xl:ml-12 w-full lg:w-auto h-[var(--fixed-btn-h-sp)] lg:h-auto">
                    <a href="<?php echo home_url('/accident/'); ?>" class="flex-1 lg:flex-auto flex lg:flex-col items-center justify-center lg:w-[7.5rem] h-full lg:h-auto py-0.5 px-2 text-sm leading-normal text-center bg-white text-accent border border-accent lg:rounded-[0.625rem] hover:text-accent lg:hover:scale-105">
                        <i class="m-ico aspect-[32/18] w-8 lg:mt-0.5 mb-1 mr-1.5 lg:mr-0 bg-accent [mask-image:var(--icon-car)] [-webkit-mask-image:var(--icon-car)]"></i>
                        <span>事故のご連絡</span>
                    </a>
                    <a href="<?php echo home_url('/accident/'); ?>" class="flex-1 lg:flex-auto flex lg:flex-col items-center justify-center lg:w-[7.5rem] h-full lg:h-auto py-0.5 px-2 text-sm leading-normal text-center bg-accent text-white border border-accent lg:rounded-[0.625rem] hover:text-white lg:hover:scale-105">
                        <i class="m-ico aspect-[20/14] w-5 mt-0.5 lg:mb-1 mr-1.5 lg:mr-0 bg-white [mask-image:var(--icon-msg)] [-webkit-mask-image:var(--icon-msg)]"></i>
                        <span>お問い合わせ</span>
                    </a>
                </div>
            </nav><!-- /.header-nav -->
        </div>
        <div class="shadow-[0_0_15px_rgba(0,0,0,0.1)] hidden lg:flex items-center justify-center h-[var(--header-bot-scroll-h)] xl:h-[var(--header-bot-h)] xl:group-[.is-scroll]/header:h-[var(--header-bot-scroll-h)] bg-white transition-all duration-300">
            <?php get_template_part('parts/menu','bottom'); ?>
        </div>
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