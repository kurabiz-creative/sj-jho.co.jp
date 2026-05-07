<!-- PC -->
<ul class="nav-list hidden lg:flex flex-wrap items-center gap-x-7 xl:gap-x-9">
    <li><a class="nav-link" href="<?php echo home_url('/company/'); ?>"><div class="text">会社案内</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/history/'); ?>"><div class="text">会社の歴史</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/recruit/'); ?>"><div class="text">採用情報</div></a></li>
</ul>
<!-- SP -->
<ul class="nav-list flex lg:hidden flex-col">
    <li><a class="nav-link" href="<?php echo home_url(); ?>"><div class="text">TOP</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/history/'); ?>"><div class="text">会社の歴史</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/company/'); ?>"><div class="text">会社案内</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/info-indivs/'); ?>"><div class="text">個人のお客さま</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/info-corp/'); ?>"><div class="text">法人のお客さま</div></a></li>
    <li class="js-sub-menu">
        <a class="js-sub-menu__toggle nav-link" href="<?php echo home_url('/info-group/'); ?>"><div class="text">団体のお客さま</div></a>
        <div class="js-sub-menu__wrap lg:bg-white/90 border-green">
            <ul class="nav-list--sub">
                <li><a class="nav-link" href="<?php echo home_url('/info-group/okayama-u/'); ?>"><div class="text">岡山大学会員さま専用サイト</div></a></li>
                <li><a class="nav-link" href="<?php echo home_url('/info-group/dental/'); ?>"><div class="text">歯科医師会会員さま専用サイト</div></a></li>
                <li><a class="nav-link" href="<?php echo home_url('/info-group/kensikai/'); ?>"><div class="text">けんし会会員さま専用サイト</div></a></li>
            </ul>
        </div>
    </li>
    <li><a class="nav-link" href="<?php echo home_url('/accident/'); ?>"><div class="text">事故手続き・ご相談の流れ</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/faq/'); ?>"><div class="text">よくあるご質問</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/recruit/'); ?>"><div class="text">採用情報</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/news/'); ?>"><div class="text">お知らせ</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/contact/'); ?>"><div class="text">お問い合わせ</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/solicitation/'); ?>"><div class="text">勧誘方針ページ</div></a></li>
    <li><a class="nav-link" href="<?php echo home_url('/privacy-policy/'); ?>"><div class="text">プライバシーポリシー</div></a></li>
</ul>