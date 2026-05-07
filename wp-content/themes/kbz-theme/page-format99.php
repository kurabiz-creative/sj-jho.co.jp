<?php
get_header();
?>
<style>
    code {
        background-color: #ededed;
        border: 1px solid #ccc;
        color: #e7436f;
        font-size: 13px;
        padding: 2px;
        border-radius: 4px;
    }
</style>
<div class="container">
<div class="grid grid-cols-8 mt-6">
    <div class="aspect-square bg-basic text-white">.bg-basic<br>#404040</div>
    <div class="aspect-square bg-main text-white">.bg-main<br>#007e79</div>
    <div class="aspect-square bg-accent text-white">.bg-accent<br>#52a0a0</div>
    <div class="aspect-square bg-green text-white">.bg-green<br>#aed057</div>
    <div class="aspect-square bg-light-green">.bg-light-green<br>#eff2d3</div>
    <div class="aspect-square bg-dark-green text-white">.bg-dark-green<br>#33686f</div>
    <div class="aspect-square bg-dark-green2 text-white">.bg-dark-green2<br>#175e59</div>
    <div class="aspect-square bg-light-gray">.bg-light-gray<br>#f4f5ee</div>
    <div class="aspect-square bg-accent-link text-white">.bg-accent-link<br>#68a8dd</div>
</div>

<!-- lg(block-box) -->
<div class="pt-16 md:pt-20 lg:pt-32">pt-16 md:pt-20 lg:pt-32</div>
<!-- default -->
<div class="pt-8 md:pt-11 lg:pt-16">pt-8 md:pt-11 lg:pt-16</div>
<!-- half -->
<div class="pt-4 md:pt-5 lg:pt-8">pt-4 md:pt-5 lg:pt-8</div>
<!-- mini -->
<div class="pt-2 md:pt-2.5 lg:pt-4">pt-2 md:pt-2.5 lg:pt-4</div>
<!-- ptit -->
<div class="pt-1 lg:pt-2">pt-1 lg:pt-2</div>


<!-- lg(block-box) -->
<div class="block-box">.block-box (py-16 md:py-20 lg:py-32)</div>
<!-- default -->
<div class="py-8 md:py-11 lg:py-16">py-8 md:py-11 lg:py-16</div>
<!-- half -->
<div class="py-4 md:py-5 lg:py-8">py-4 md:py-5 lg:py-8</div>
<!-- mini -->
<div class="py-2 md:py-2.5 lg:py-4">py-2 md:py-2.5 lg:py-4</div>
<!-- ptit -->
<div class="py-1 lg:py-2">py-1 lg:py-2</div>


<div class="block-box">

<h2 class="mb-6 lg:mb-9 text-sm leading-normal">
    <span class="text-5xl lg:text-6xl xl:text-[4rem] leading-none text-accent font-mont">Service</span>
    <span class="block pl-1 mt-2">サービス内容</span>
</h2>

<code>.js-marker-wrap .js-marker</code>
<br><br>
<div class="js-marker-wrap flex flex-col flex-wrap items-start gap-y-2 lg:gap-y-2.5 text-[1.625rem] md:text-[clamp(1.875rem,2.5vw,2.25rem)] tracking-tighter leading-snug">
    <p class="js-marker pl-2 lg:pl-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-dark-green text-white">誰よりも寄り添い、</p>
    <p class="js-marker pl-2 lg:pl-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-dark-green text-white ">価値ある一手を届けます。</p>
</div>
<br><br>
<div class="js-marker-wrap flex flex-col flex-wrap items-start gap-y-2 lg:gap-y-2.5 text-[1.625rem] md:text-[clamp(1.875rem,2.5vw,2.25rem)] tracking-tighter leading-snug">
    <p class="js-marker px-2 lg:px-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-dark-green text-white">誰よりも寄り添い</p>
    <p class="js-marker px-2 lg:px-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-dark-green text-white ">価値ある一手を届けます</p>
</div>
<br><br>
<code>.js-marker-wrap[data-no-anim] .js-marker</code>
<br><br>
<div class="js-marker-wrap flex flex-col flex-wrap items-start gap-y-2 lg:gap-y-2.5 text-[1.625rem] md:text-[clamp(1.875rem,2.5vw,2.25rem)] tracking-tighter leading-snug" data-no-anim>
    <p class="js-marker px-2 lg:px-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-main text-white">誰よりも寄り添い</p>
    <p class="js-marker px-2 lg:px-3 pb-0.5 inline-flex align-top rounded-[0.3125rem] bg-main text-white ">価値ある一手を届けます</p>
</div>

</div>

<div class="block-box">
    <code>.m-btn</code><br>
    <a href="#" class="m-btn group text-center min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <span class="relative z-[1] flex-grow">.m-btn</span>
    </a>
    <a href="#" class="m-btn group text-center min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <span class="relative z-[1] flex-grow">（ダミー）ネット保険</span>
    </a>
    <button type="button" class="m-btn group text-center min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <span class="relative z-[1] flex-grow">button.m-btn</span>
    </button>
    <div class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <input class="text-center" type="submit" value="input.m-btn"/>
    </div>
    <br><br>
    <a href="#" class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <span class="relative z-[1] flex-grow">.m-btn</span>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </a>
    <a href="#" class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <span class="relative z-[1] flex-grow">（ダミー）ネット保険</span>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </a>
    <button type="button" class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <span class="relative z-[1] flex-grow">button.m-btn</span>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </button>
    <div class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <input type="submit" value="input.m-btn"/>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </div>
    <br><br>

    <h2 class="text-2xl">disabled</h2>
    <a href="#" class="m-btn is-disabled group min-w-40 bg-main border-main text-white text-sm">
        <span class="relative z-[1] flex-grow">.m-btn</span>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </a>
    <button type="button" disabled class="m-btn is-disabled group min-w-40 bg-main border-main text-white text-sm">
        <span class="relative z-[1] flex-grow">button.m-btn</span>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </button>
    <div class="m-btn is-disabled group min-w-40 bg-main border-main text-white text-sm">
        <input type="submit" disabled value="input.m-btn"/>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </div>
    <br><br>

    <div class="pt-4 md:pt-5 lg:pt-8"></div>
    <h2 class="text-2xl">form用</h2>
    <div class="m-btn group min-w-40 bg-white border-main text-main text-sm hover:text-white hover:bg-green hover:border-green">
        <button type="submit">修正する</button>
        <i class="m-arr ml-5 w-5 h-5 bg-main border-main group-hover:bg-white group-hover:border-white"><span class="arr border-white group-hover:border-green"></span></i>
    </div>
    <div class="m-btn group min-w-40 bg-main border-main text-white text-sm hover:text-white hover:bg-green hover:border-green">
        <input type="submit" value="送信する"/>
        <i class="m-arr ml-5 w-5 h-5 bg-white border-white"><span class="arr border-main group-hover:border-green"></span></i>
    </div>
</div>

<div class="block-box">
    <code>.m-ul-list</code><br>
    <ul class="m-ul-list">
        <li>多様な人材が<a href="#">テキストリンク</a>活躍できる機会を提供する</li>
        <li>個人の魅力を高めるための支援を行う</li>
        <li>
            一人ひとりの成長と挑戦を大切にする
            <ol class="m-ol-list">
                <li>多様な人材が<a href="#">テキストリンク</a>活躍できる機会を提供する</li>
                <li>個人の魅力を高めるための支援を行う</li>
            </ol>
        </li>
        <li><a href="#">テキストリンクテキストリンクテキストリンク</a></li>
    </ul>

    <br><br>
    <code>.m-ol-list</code><br>
    <ol class="m-ol-list">
        <li>多様な人材が<a href="#">テキストリンク</a>活躍できる機会を提供する</li>
        <li>個人の魅力を高めるための支援を行う</li>
        <li>
            一人ひとりの成長と挑戦を大切にする
            <ul class="m-ul-list">
                <li>多様な人材が<a href="#">テキストリンク</a>活躍できる機会を提供する</li>
                <li>個人の魅力を高めるための支援を行う</li>
            </ul>
        </li>
        <li><a href="#">テキストリンクテキストリンクテキストリンク</a></li>
    </ol>
</div>

<div class="pt-8 md:pt-11 lg:pt-16"></div>
<div class="block-box">
    <h2>テーブル<code>.m-tbl</code></h2>
    <div class="m-tbl text-sm sm:text-base">
        <table>
            <thead>
                <tr>
                    <th style="width: 190px;" class="text-center" scope="col">見出し1</th>
                    <th class="text-center" scope="col">見出し2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">項目</th>
                    <td>テキスト</td>
                </tr>
                <tr>
                    <th scope="row">項目</th>
                    <td>テキスト</td>
                </tr>
                <tr>
                    <th scope="row" class="!border-[#D4E6E3]">項目.!border-[#D4E6E3]</th>
                    <td>テキスト</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    <p class="block text-gray-400 text-xs md:text-sm leading-snug text-right">※横にスクロールしてください。</p>
    <p class="block sm:hidden text-gray-400 text-xs md:text-sm leading-snug text-right">※横にスクロールしてください。</p>
    <div class="m-tbl text-sm sm:text-base overflow-x-auto sm:overflow-hidden">
        <table class="min-w-[640px] sm:min-w-0">
            <thead>
                <tr>
                    <th style="width: 190px;" class="text-center" scope="col">見出し1</th>
                    <th class="text-center" scope="col">見出し2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">項目</th>
                    <td>テキスト</td>
                </tr>
                <tr>
                    <th scope="row">項目</th>
                    <td>テキスト</td>
                </tr>
                <tr>
                    <th scope="row" class="!border-[#D4E6E3]">項目.!border-[#D4E6E3]</th>
                    <td>テキスト</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class="m-tbl type-row-xs">
        <table>
            <thead>
                <tr>
                    <th style="width: 190px;" class="bg-basic text-white text-center" scope="col">見出し1</th>
                    <th class="bg-basic text-white text-center" scope="col">見出し2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="text-left">項目</th>
                    <td>テキスト</td>
                </tr>
                <tr>
                    <th scope="row" class="text-left">項目</th>
                    <td>テキスト</td>
                </tr>
                <tr>
                    <th scope="row" class="text-left">項目</th>
                    <td>テキスト</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="block-box">
    <code>.splide.js-flow-slider</code><br><br>
    <div class="splide js-flow-slider">
        <div class="splide__track">
            <div class="splide__list">
                <div class="splide__slide"><span class="text-[100px] font-bold">TEXT</span></div>
                <div class="splide__slide"><span class="text-[100px] font-bold">TEXT</span></div>
                <div class="splide__slide"><span class="text-[100px] font-bold">TEXT</span></div>
            </div>
        </div>
    </div>
    <br><br><br><code>.splide.js-flow-slider.type-reverse</code><br><br>
    <div class="splide js-flow-slider type-reverse">
        <div class="splide__track">
            <div class="splide__list">
                <div class="splide__slide"><span class="text-[100px] font-bold">TEXT</span></div>
                <div class="splide__slide"><span class="text-[100px] font-bold">TEXT</span></div>
                <div class="splide__slide"><span class="text-[100px] font-bold">TEXT</span></div>
            </div>
        </div>
    </div>
</div>


</div> <!-- /.container -->

<?php
get_footer();
?>