<?php
global $origin_options;
?>

<!-- S: Common Contact -->
<div class="relative bg-light-green overflow-hidden">
    <?php get_template_part('parts/common', 'contact'); ?>
</div>
<!-- E: Common Contact -->

</main>
<!-- main end -->

<div class="l-fixed">
    <button type="button" id="pagetop" class="bg-accent"><span class="sr-only">ページの先頭へ</span></button>
</div>

<footer id="footer" class="l-footer relative z-[2] pb-[var(--fixed-btn-h-sp)] lg:pb-0 bg-white">
	<div class="container flex flex-col lg:flex-row gap-y-6 gap-x-8 pt-12 pb-8">
        <div class="flex-1">
            <div class="logo">
                <a href="<?php echo home_url(); ?>" class="logo-link hover:opacity-70">
                    <img class="w-40 sm:w-[12.375rem]" src="<?php echo _get_file('/assets/img/logo_footer.png'); ?>" alt="株式会社ジャパン保険岡山">
                </a>
            </div>
            <ul class="mt-4 text-sm space-y-1">
                <li>
                    <span class="sr-only">郵便番号：</span>〒700-0913
                </li>
                <li>
                    <span class="sr-only">住所：</span>岡山県岡山市北区大供１-2-10 損保ジャパン岡山ビル5F
                </li>
                <li class="flex flex-wrap gap-x-1.5">
                    <div>
                        <span>TEL：</span><a href="tel:0862312840" class="hover:underline">086-231-2840</a>
                    </div>
                    <span>/</span>
                    <div>
                        <span>FAX：</span>086-231-2890
                    </div>
                </li>
                <li>
                    <span class="sr-only">承認番号：</span>SJ21-10962（承認日：2021/12/7）
                </li>
            </ul>
        </div>
        <div class="w-full lg:max-w-sm xl:max-w-xl lg:ml-auto">
            <?php get_template_part('parts/menu','footer'); ?>
        </div>
	</div>
    <p class="flex flex-wrap items-center justify-center content-center text-center gap-x-5 px-5 h-[2.8125rem] text-xs font-medium">
        &copy; 2026 株式会社ジャパン保険岡山
    </p>
</footer>

<div class="l-loading"><div class="l-loading-obj"></div></div>
<?php
wp_footer();
?>
</body>
</html>