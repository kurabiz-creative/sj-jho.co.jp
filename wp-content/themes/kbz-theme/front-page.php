<?php
$body_id = 'top-contents';

get_header();
?>

<!-- S: FV -->
<?php get_template_part('parts/fullscreen', 'top'); ?>
<!-- E: FV -->

<!-- S: Service -->
<section id="service" class="block-box !pb-0">
    <div class="container">
        <div class="flex flex-col lg:flex-row max-w-md lg:max-w-none mx-auto">
            <div class="ani-gsap slide-t lg:w-1/2 mb-6 lg:mb-0">
                <div class="rounded-[1.25rem] overflow-hidden"><img src="<?php echo _get_file('/assets/img/service_img.jpg'); ?>" alt=""></div>
            </div>
            <div class="ani-gsap slide-l lg:w-1/2 flex-grow lg:pl-10 xl:pl-14 2xl:pl-16">
                <h2 class="mb-6 lg:mb-9 text-sm leading-normal">
                    <span class="text-5xl lg:text-6xl xl:text-[4rem] leading-none text-accent font-mont">Service</span>
                    <span class="block pl-1 mt-2">サービス内容</span>
                </h2>
                <div class="js-marker-wrap flex flex-col flex-wrap items-start gap-y-2 lg:gap-y-2.5 text-[1.625rem] md:text-[clamp(1.875rem,2.5vw,2.25rem)] tracking-tighter leading-snug">
                    <p class="js-marker pl-2 lg:pl-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-dark-green text-white">誰よりも寄り添い、</p>
                    <p class="js-marker pl-2 lg:pl-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-dark-green text-white ">価値ある一手を届けます。</p>
                </div>
                <p class="mt-5 lg:mt-8 leading-[2.5] lg:leading-[2.75]">
                    損害保険・生命保険のプロフェッショナルとして、<span class="inline-block">日々の小さな不安から万一の備えまで</span><span class="inline-block">あらゆる課題を安心へと変えていきます。</span>
                    <br>時代の変化に柔軟に対応し、あなたの健やかな未来と大切な日常を、<span class="inline-block">一番近くで共に守り抜くことをお約束します。</span>
                </p>
            </div>
        </div>
    </div>

    <div class="pt-20 md:block-box md:!pb-0 relative md:static bg-light-gray md:bg-white overflow-hidden">
        <div class="static md:relative bg-light-gray
            before:absolute before:left-1/2 before:-translate-x-1/2 before:-top-px md:before:-top-12 lg:before:top-[-8%] 3xl:before:top-[-15%] before:z-0 before:block before:aspect-[1366/230] before:w-full sm:before:min-w-[768px] md:before:min-w-[1366px] before:bg-white before:[mask-image:var(--clip-round)] before:mask-center before:mask-no-repeat">
            <div class="container">
                <div class="flex flex-col md:flex-row justify-center space-y-6 md:space-y-0 md:space-x-6 lg:space-x-11 max-w-[58.125rem] mx-auto">
                    <a href="<?php echo home_url('/info-group/okayama-u/'); ?>" class="group flex gap-x-5 items-center md:flex-col md:items-start hover:text-current">
                        <div class="order-2 flex-1 md:mt-6 md:text-center">
                            <div class="text-xl lg:text-2xl leading-normal text-dark-green2 underline decoration-1 decoration-transparent underline-offset-4 transition-all duration-300 group-hover:decoration-current">
                                法人のお客さま
                            </div>
                            <p class="mt-1.5 md:mt-3 text-sm md:text-base">
                                貴社の企業活動を取り巻く<span class="inline-block">リスクをマネジメント</span>
                            </p>
                        </div>
                        <div class="order-1 w-[clamp(6.25rem,30%,9rem)] md:w-full relative aspect-square rounded-full overflow-hidden bg-white shadow-[5px_5px_15px_rgba(0,0,0,0.15)] md:shadow-[10px_10px_25px_rgba(0,0,0,0.15)]">
                            <span class="block absolute inset-1.5 lg:inset-2 bg-light-gray rounded-full transition-all duration-300 group-hover:inset-3 md:group-hover:inset-4"></span>
                            <img class="relative z-[1] w-full object-contain object-bottom" src="<?php echo _get_file('/assets/img/service01_img.png'); ?>" alt="">
                            <div class="absolute z-[2] inset-0 hidden md:flex items-center justify-center bg-main/70 rounded-full [clip-path:circle(0_at_50%_50%)] transition-all duration-500 delay-100 group-hover:[clip-path:circle(50%_at_50%_50%)]">
                                <div class="flex items-center gap-x-2 text-xl text-white opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                                    詳しく見る<i class="shrink-0 aspect-square w-[1em] flex items-center justify-center bg-white rounded-full"><span class="shrink-0 aspect-square w-[28%] border-t border-r border-main rotate-45 -translate-x-px"></span></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo home_url('/info-group/okayama-u/'); ?>" class="group flex gap-x-5 items-center md:flex-col md:items-start hover:text-current">
                        <div class="order-2 flex-1 md:mt-6 md:text-center">
                            <div class="text-xl lg:text-2xl leading-normal text-dark-green2 underline decoration-1 decoration-transparent underline-offset-4 transition-all duration-300 group-hover:decoration-current">
                                個人のお客さま
                            </div>
                            <p class="mt-1.5 md:mt-3 text-sm md:text-base">
                                日々の暮らしに潜む<span class="inline-block">様々なリスクに備える</span>
                            </p>
                        </div>
                        <div class="order-1 w-[clamp(6.25rem,30%,9rem)] md:w-full relative aspect-square rounded-full overflow-hidden bg-white shadow-[5px_5px_15px_rgba(0,0,0,0.15)] md:shadow-[10px_10px_25px_rgba(0,0,0,0.15)]">
                            <span class="block absolute inset-1.5 lg:inset-2 bg-light-gray rounded-full transition-all duration-300 group-hover:inset-3 md:group-hover:inset-4"></span>
                            <img class="relative z-[1] w-full object-contain object-bottom" src="<?php echo _get_file('/assets/img/service02_img.png'); ?>" alt="">
                            <div class="absolute z-[2] inset-0 hidden md:flex items-center justify-center bg-main/70 rounded-full [clip-path:circle(0_at_50%_50%)] transition-all duration-500 delay-100 group-hover:[clip-path:circle(50%_at_50%_50%)]">
                                <div class="flex items-center gap-x-2 text-xl text-white opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                                    詳しく見る<i class="shrink-0 aspect-square w-[1em] flex items-center justify-center bg-white rounded-full"><span class="shrink-0 aspect-square w-[28%] border-t border-r border-main rotate-45 -translate-x-px"></span></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo home_url('/info-group/okayama-u/'); ?>" class="group flex gap-x-5 items-center md:flex-col md:items-start hover:text-current">
                        <div class="order-2 flex-1 md:mt-6 md:text-center">
                            <div class="text-xl lg:text-2xl leading-normal text-dark-green2 underline decoration-1 decoration-transparent underline-offset-4 transition-all duration-300 group-hover:decoration-current">
                                団体のお客さま
                            </div>
                            <p class="mt-1.5 md:mt-3 text-sm md:text-base">
                                テキストが入ります。テキストが入ります。テキストが
                            </p>
                        </div>
                        <div class="order-1 w-[clamp(6.25rem,30%,9rem)] md:w-full relative aspect-square rounded-full overflow-hidden bg-white shadow-[5px_5px_15px_rgba(0,0,0,0.15)] md:shadow-[10px_10px_25px_rgba(0,0,0,0.15)]">
                            <span class="block absolute inset-1.5 lg:inset-2 bg-light-gray rounded-full transition-all duration-300 group-hover:inset-3 md:group-hover:inset-4"></span>
                            <img class="relative z-[1] w-full object-contain object-bottom" src="<?php echo _get_file('/assets/img/service03_img.png'); ?>" alt="">
                            <div class="absolute z-[2] inset-0 hidden md:flex items-center justify-center bg-main/70 rounded-full [clip-path:circle(0_at_50%_50%)] transition-all duration-500 delay-100 group-hover:[clip-path:circle(50%_at_50%_50%)]">
                                <div class="flex items-center gap-x-2 text-xl text-white opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                                    詳しく見る<i class="shrink-0 aspect-square w-[1em] flex items-center justify-center bg-white rounded-full"><span class="shrink-0 aspect-square w-[28%] border-t border-r border-main rotate-45 -translate-x-px"></span></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="mt-16">
                    <a href="<?php echo home_url('/accident/'); ?>" class="relative overflow-hidden block w-full max-w-sm sm:max-w-lg lg:max-w-[46.75rem] mx-auto rounded-[1.25rem] px-3.5 sm:px-6 py-6 sm:py-4 bg-main text-white hover:text-white hover:bg-green">
                        <img class="absolute inset-0 w-full h-full object-cover mix-blend-hard-light" src="<?php echo _get_file('/assets/img/btn_bg.png'); ?>" alt="">
                        <div class="relative z-[1] flex items-center gap-x-[4%] sm:gap-x-[6%]">
                            <div class="relative shrink-0 w-[27%] sm:w-[clamp(6rem,30%,13.9375rem)] pt-[2.5%] ml-2">
                                <img class="absolute left-0 top-0 w-[38%] ani-gsap scale-75" src="<?php echo _get_file('/assets/img/btn_img_obj.png'); ?>" alt="">
                                <img class="relative z-[1] w-full" src="<?php echo _get_file('/assets/img/btn_img_car.png'); ?>" alt="">
                            </div>
                            <div class="flex-grow flex items-center gap-x-[5%] text-lg sm:text-2xl lg:text-4xl leading-normal sm:leading-snug">
                                <p class="block">
                                    <span class="inline-block">もしもの</span><span class="inline-block">事故の場合は</span><span class="inline-block">こちらを</span><span class="inline-block">チェック！</span>
                                </p>
                                <i class="ml-auto shrink-0 aspect-square w-[1em] flex items-center justify-center bg-white rounded-full"><span class="shrink-0 aspect-square w-[26%] border-t border-r border-main rotate-45 -translate-x-px"></span></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- E: Service -->

<!-- S: Advance -->
<section id="advance" class="block-box bg-light-gray overflow-hidden">
    <div class="container">
        <h2 class="mb-6 lg:mb-9 text-sm leading-normal text-center">
            <span class="text-5xl lg:text-6xl xl:text-[4rem] leading-none text-accent font-mont">Advance</span>
            <span class="block pl-1 mt-2">私たちの強み</span>
        </h2>

        <div class="space-y-16 max-w-lg lg:max-w-none mx-auto">
            <div class="grid lg:grid-cols-2 2xl:grid-cols-[1fr_55%] items-center gap-x-12 2xl:gap-x-14 gap-y-12">
                <div class="lg:col-start-2 lg:row-start-1 relative pb-5">
                    <img class="absolute -left-3 lg:-left-9 bottom-0 w-[27.2%] ani-gsap slide-r" src="<?php echo _get_file('/assets/img/advance_img01_obj.png'); ?>" alt="">
                    <div class="rounded-[1.25rem] overflow-hidden"><img src="<?php echo _get_file('/assets/img/advance_img01.jpg'); ?>" alt=""></div>
                </div>
                <div class="lg:col-start-1 lg:row-start-1 relative">
                    <div class="absolute left-0 top-0 -translate-x-4 lg:-translate-x-1/3 -translate-y-1/2 text-8xl xl:text-9xl font-mont font-bold text-light-green leading-none">01</div>
                    <div class="relative text-2xl lg:text-3xl xl:text-4xl text-dark-green leading-relaxed tracking-tight">歴史ある保険専業の<br>代理店としての知識</div>
                    <p class="relative mt-4 md:mt-6">100年の歴史の中で培った豊富な経験と確かなノウハウを糧に、法人・個人のお客様を支える「お守り」のような存在でありたいと願っています。</p>
                    <div class="relative mt-7 md:mt-10">
                        <a href="<?php echo home_url('/history/'); ?>" class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
                            <span class="relative z-[1] flex-grow">会社の歴史</span>
                            <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 2xl:grid-cols-[55%_1fr] items-center gap-x-12 2xl:gap-x-14 gap-y-12">
                <div class="relative pb-5">
                    <img class="absolute -left-3 lg:-left-9 bottom-0 w-[27.2%] ani-gsap slide-r" src="<?php echo _get_file('/assets/img/advance_img02_obj.png'); ?>" alt="">
                    <div class="rounded-[1.25rem] overflow-hidden"><img src="<?php echo _get_file('/assets/img/advance_img02.jpg'); ?>" alt=""></div>
                </div>
                <div class="relative">
                    <div class="absolute left-0 top-0 -translate-x-4 lg:-translate-x-[20%] -translate-y-[55%] text-8xl xl:text-9xl font-mont font-bold text-light-green leading-none">02</div>
                    <div class="relative text-2xl lg:text-3xl xl:text-4xl text-dark-green leading-relaxed tracking-tight">（ダミー）ネットで完結する<br>保険も手厚く対応</div>
                    <p class="relative mt-4 md:mt-6">（ダミー）対面での深い対話だけでなく、手軽で合理的な「ネット保険」という選択肢も大切にしています。</p>
                    <div class="relative mt-7 md:mt-10">
                        <a href="<?php echo home_url('/history/'); ?>" class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
                            <span class="relative z-[1] flex-grow">（ダミー）ネット保険</span>
                            <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- E: Advance -->

<div class="flex overflow-hidden">
    <div class="flex-1">
        <a href="<?php echo home_url('/company/'); ?>" class="group overflow-hidden relative h-full md:min-h-60 py-6 flex items-center justify-center before:block before:absolute before:z-[1] before:inset-0 before:bg-main/75">
            <img class="absolute left-0 top-0 w-full h-full object-cover transition duration-500 md:group-hover:scale-110" src="<?php echo _get_file('/assets/img/bnr_company_bg.jpg'); ?>" alt="">
            <div class="relative z-[2] p-5 text-sm leading-normal text-center">
                <span class="text-3xl md:text-5xl lg:text-6xl xl:text-[4rem] leading-none text-white font-mont">Company</span>
                <span class="block pl-1 mt-2 text-white">会社概要</span>
            </div>
        </a>
    </div>
    <div class="flex-1">
        <a href="<?php echo home_url('/recruit/'); ?>" class="group overflow-hidden relative h-full md:min-h-60 py-6 flex items-center justify-center before:block before:absolute before:z-[1] before:inset-0 before:bg-[#a1b26d]/75">
            <img class="absolute left-0 top-0 w-full h-full object-cover transition duration-500 md:group-hover:scale-110" src="<?php echo _get_file('/assets/img/bnr_recruit_bg.jpg'); ?>" alt="">
            <div class="relative z-[2] p-5 text-sm leading-normal text-center">
                <span class="text-3xl md:text-5xl lg:text-6xl xl:text-[4rem] leading-none text-white font-mont">Recruit</span>
                <span class="block pl-1 mt-2 text-white">採用情報</span>
            </div>
        </a>
    </div>
</div>

<!-- S: News -->
<section id="news" class="py-16 md:py-20">
    <div class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="shrink-0 contents lg:block lg:w-1/4">
                <h2 class="text-sm leading-normal">
                    <span class="text-5xl lg:text-6xl xl:text-[4rem] leading-none text-accent font-mont">News</span>
                    <span class="block pl-1 mt-2">お知らせ</span>
                </h2>
                <div class="mt-9 order-1 lg:order-none text-center lg:text-left">
                    <a href="<?php echo home_url('/news/'); ?>" class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
                        <span class="relative z-[1] flex-grow">一覧を見る</span>
                        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
                    </a>
                </div>
            </div>

            <div class="flex-1 overflow-hidden mt-3 lg:mt-0">
                <?php
                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'order' => 'DESC',
                        'orderby' => 'date'
                    );
                    $news_query = new WP_Query( $args );
                    if($news_query->have_posts()):
                ?>
                <ul class="w-full">
                    <?php while($news_query->have_posts()) : $news_query->the_post();
                        $category = get_the_category();
                        $title = get_the_title();
                    ?>
                    <li class="bg-dot bg-dot-basic">
                        <a href="<?php the_permalink(); ?>" class="flex flex-wrap md:flex-nowrap gap-y-1.5 items-center py-5 md:py-7">
                            <div class="min-w-[5.375em] mr-1 md:mr-2.5 shrink-0 text-sm md:text-base">
                                <time class="font-mont text-accent" datetime="<?php echo get_the_date('Y-n-j'); ?>"><?php echo get_the_date('Y.n.j'); ?></time>
                            </div>
                            <?php if(!empty($category)) : ?>
                            <div class="flex gap-2 mr-2.5 md:mr-5 xl:mr-10 shrink-0">
                                <?php foreach($category as $cat):
                                    $categorySlug = $cat->slug;
                                    $categoryColor = 'bg-accent text-white';
                                    if ($categorySlug === 'event') {
                                        $categoryColor = 'bg-green2 text-white';
                                    }
                                ?>
                                <span class="inline-flex items-center justify-center align-top text-center <?php echo $categoryColor; ?> min-w-[6.124em] py-1 text-xs md:text-sm leading-snug"><?php echo esc_html($cat->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class="md:flex-1 flex items-center gap-x-2 md:gap-x-5 w-full md:w-auto overflow-hidden md:pr-5">
                                <span class="block w-full max-w-lg truncate"><?php echo $title; ?></span>
                                <i class="shrink-0 aspect-square w-5 md:w-6 ml-auto flex items-center justify-center bg-main rounded-full"><span class="shrink-0 aspect-square w-[27%] border-t border-r border-white rotate-45"></span></i>
                            </div>
                        </a>
                    </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-9 mt-16 md:mt-20 justify-items-center">
            <div class="aspect-[356/100] w-full max-w-sm sm:max-w-none">
                <div class="flex justify-center items-center text-center w-full h-full object-cover text-2xl bg-gray-200">バナーが入ります</div>
            </div>
            <div class="aspect-[356/100] w-full max-w-sm sm:max-w-none">
                <div class="flex justify-center items-center text-center w-full h-full object-cover text-2xl bg-gray-200">バナーが入ります</div>
            </div>
            <div class="aspect-[356/100] w-full max-w-sm sm:max-w-none">
                <div class="flex justify-center items-center text-center w-full h-full object-cover text-2xl bg-gray-200">バナーが入ります</div>
            </div>
        </div>
    </div>
</section>
<!-- E: News -->

<?php
get_footer();
?>