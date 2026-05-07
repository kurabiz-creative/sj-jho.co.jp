let _fixedOffset = 0;
let _isInitHashScroll = false;

document.addEventListener('DOMContentLoaded', () => {
    /* hash scroll */
    const urlHash = window.location.hash;
    // ボタンクリックの場合
    document.querySelectorAll('a[href*="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            const hrefAttr = this.getAttribute('href');
            let url;
            if (!hrefAttr) return;

            // 壊れたURLだったら何もしない
            try {
                url = new URL(hrefAttr, window.location.origin);
            } catch {
                return;
            }

            // 除外設定など
            if (!url.hash || url.hash === '#') return; // hashのみ
            // #から始まる場合
            if (hrefAttr.startsWith('#')) {
                e.preventDefault();
                scrollToHash(hrefAttr);
                return;
            }
            if (url.host !== window.location.host) return; // 外部サイト
            if (url.pathname !== window.location.pathname) return; // 現在のページではない

            e.preventDefault();
            scrollToHash(url.hash);
            return false;
        });
    });
    // urlでアクセスした場合
    if (urlHash) {
        _isInitHashScroll = true;
        window.addEventListener('load', () => {
            scrollToHash(urlHash);
        });
    }

    /* animation */
    loadingAnimation();
    animCommonScroll();
    animCommonParts();

    /* gnav & footer */
    toggleNav();

	/* pagetop */
    updateFixedOffset();
    window.addEventListener('resize', debounce(updateFixedOffset, 100));
    window.addEventListener('scroll', () => updateFixedOffset());

    const pagetop = document.getElementById('pagetop');
    if (pagetop) {
        pagetop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* フォーム */
	setForm();

    /* スライダー */
    flowSlider();

    /* 汎用パーツ */
    bgPin();
    window.addEventListener('resize', debounce(() => {
        bgPin();
        ScrollTrigger.refresh();
    }, 100));
});


/*==================================================
スムーススクロール
==================================================*/
function scrollToHash(hash) {
    const header = document.querySelector('.l-header .logo');
    const targetId = hash.replace('#','');
    const target = document.getElementById(targetId);
    if (!target) {
        console.log('target not found:', targetId);
        return;
    }

    const headerHeight = header?.offsetHeight || 0;
    const offset = target.dataset.scrollOffset ? Number(target.dataset.scrollOffset) : 0;
    const rect = target.getBoundingClientRect();
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const position = rect.top + scrollTop - (headerHeight * 1.7) + offset;

    // del
    // if (_isInitHashScroll) { // ページに入った時に
    //     // window.scrollTo({ top: position, behavior: 'smooth' });
    //     window.lenis.scrollTo(position, {
    //         immediate: false,
    //     });
    //     _isInitHashScroll = false;
    //     return;
    // }

    window.scrollTo({ top: position, behavior: 'smooth' });
}


/*==================================================
ローディング
==================================================*/
function loadingAnimation() {
    const body = document.body;
    const loadingEle = document.querySelector('.l-loading');
    const loadingObj = document.querySelector('.l-loading-obj');

    function doLoadingHide() {
        if (body.classList.contains('is-loading')) {
            if (loadingEle) {
                loadingEle.remove();
            }
            setTimeout(function(){
                body.classList.remove('is-loading');
                // window.lenis?.start(); // lenis 実行 // del
            },100)
        }
        // loadedカスタムイベント追加
        document.dispatchEvent(new Event('app:loaded'));
    }

    function runFadeOutThenHide() { // フェイドアウトのみ
        window.addEventListener('load', () => {
            if (!loadingEle) {
                doLoadingHide();
                return;
            }

            const tl = gsap.timeline({
                defaults: { ease: "power2.out" }
            });
            tl.to(loadingEle, {
                opacity: 0,
                duration: 0.6,
            });
            tl.add(doLoadingHide);
        }, { once: true });
    }
    runFadeOutThenHide();
}

/*==================================================
animation (gsap)
==================================================*/
function animCommonScroll(){
    // マッチメディアの作成
    let mm = gsap.matchMedia();

    /* -- 汎用アニメーション -- */
    // ==============================================
    // 1. アニメーションの定義マップを作成
    //    クラス名に対応する「初期状態」のプロパティを定義します
    // ==============================================
    const animCommonScrollMap = {
        'fadeIn':		{ opacity: 0 },
        'slide-t':		{ y: 50 },
        'slide-l':		{ x: 50 },
        'slide-r':		{ x: -50 },
        'slide-b':		{ y: -50 },
        'scale-0':		{ scale: 0 },
        'scale-25':		{ scale: 0.25 },
        'scale-50':		{ scale: 0.5 },
        'scale-75':		{ scale: 0.75 },
        'scale-90':		{ scale: 0.9 },
        'scale-110':	{ scale: 1.1 },
        'scale-115':	{ scale: 1.15 },
        'scale-120':	{ scale: 1.2 },
        'scale-125':	{ scale: 1.25 },
        'blur-10':		{ filter: 'blur(1.0rem)' },
        'blur-20':		{ filter: 'blur(2.0rem)' },
        'blur-30':		{ filter: 'blur(3.0rem)' },
        'rotate-30':	{ rotate: 30 },
        'rotate-45':	{ rotate: 45 },
        'rotate-60':	{ rotate: 60 },
        'rotate-90':	{ rotate: 90 },
        'rotate-180':	{ rotate: 180 },
        '-rotate-30':	{ rotate: -30 },
        '-rotate-45':	{ rotate: -45 },
        '-rotate-60':	{ rotate: -60 },
        '-rotate-90':	{ rotate: -90 },
        '-rotate-180':	{ rotate: -180 },
    };


    // ==============================================
    // 2. 対象要素をすべて取得してループ処理
    // ==============================================
    // .ani-gsap が付いている要素をすべて取得
    const animCommonScrollTargets = document.querySelectorAll('.ani-gsap');
    animCommonScrollTargets.forEach(target => {

        // この要素に適用する初期設定オブジェクト（空からスタート）
        let fromVars = {};

        // 要素のクラスリストを取得
        const classList = target.classList;

        // 定義マップと照らし合わせて、持っているクラスの設定をマージしていく
        // Object.entries(animMap) は、[ ['fadeIn', {opacity:0}], ... ] のような配列になります
        for (const [className, vars] of Object.entries(animCommonScrollMap)) {
            if (classList.contains(className)) {
                // クラスを持っていたら、その設定を fromVars にマージする
                Object.assign(fromVars, vars);
            }
        }

        // 設定が一つもなければ何もしない
        if (Object.keys(fromVars).length === 0) return;

        // ==============================================
        // 3. 共通設定と合わせてアニメーション実行
        // ==============================================
        gsap.set(target, {
            ...fromVars,
            autoAlpha: 0
        });

        const delay = parseFloat(target.dataset.delay) || 0;
        const startOffset = target.dataset.startOffset || '80%';
        document.addEventListener('app:loaded', () => {
            // console.log('app:loaded!');
            gsap.to(target, {
                autoAlpha: 1,
                y: 0,
                x: 0,
                yPercent: 0,
                xPercent: 0,
                scale: 1,
                filter: 'none',
                rotate: 0,
                duration: 1,
                delay: delay,
                ease: "power3.out",

                // 画面に入ったら再生する設定
                scrollTrigger: {
                    //markers: true
                    trigger: target,
                    start: `top ${startOffset}`, // 画面の下の方に来たら発火
                    toggleActions: "play none none none", // 一度だけ再生
                    // toggleActions: "play none none reverse", // 上下両方
                }
            } );
        }, { once: true });
    });
}
function animCommonParts(){
    // animCheckPop();
    const checksParts = document.querySelectorAll('.js-ani-check');
    if (!checksParts.length) return;

    // init
    checksParts.forEach((parts) => {
        const ico = parts.querySelectorAll('.js-ani-check__ico');
        const text = parts.querySelectorAll('.js-ani-check__text');
        if (!ico.length) return;
        gsap.set(ico, {
            scale: 1.8,
            opacity: 0
        });
        gsap.set(text, {
            opacity: 0,
        });
    });

    document.addEventListener('app:loaded', () => {
        checksParts.forEach((parts) => {
            const ico = parts.querySelectorAll('.js-ani-check__ico');
            const text = parts.querySelectorAll('.js-ani-check__text');
            if (!ico.length) return;

            const tl = gsap.timeline({
                scrollTrigger: {
                    // markers: true,
                    trigger: parts,
                    start: "top 80%",
                    once: true
                }
            });
            tl.to(text, {
                opacity: 1,
                duration: 0.6,
                stagger: 0.15
            })
            .to(ico, {
                scale: 1,
                opacity: 1,
                duration: 0.6,
                ease: "back.out(2)",
                stagger: 0.15
            }, "<");
    });
    }, { once: true });
}

/* TOP animation */
function animTopFvScroll(){
    const wrap = document.querySelector('.fv-wrap');
    if (!wrap) return;

    ScrollTrigger.normalizeScroll(true);

    /* ------------ target elements */
    const header = document.querySelector('#header');
    const headerLogo = header.querySelector('.logo');
    const headerNavBtn = header.querySelector('.l-header-nav .btn-nav');

    const fvMask = wrap.querySelector('.fv-media-box.fv-mask');

    const fvSummarySec = document.querySelector('.fv-summary-sec');
    const fvSummarySecText = fvSummarySec.querySelector('.summary-text-box');
    const fvSummarySecBlur = fvSummarySec.querySelectorAll('.bg-blur');
    const fvTitle = fvSummarySec.querySelector('.fv-title-box');
    const fvTitleImg = fvTitle.querySelector('.fv-title');

    // /* ------------ fvMaskの初期サイズ */
    const initialWidth = 60; // %
    const initialHeight = 75; // %


    /* ------------------------
    ** fvMaskアニメーション
    ------------------------ */
    /* ------------ fvMaskアニメーションのend point */
    const endEl = document.querySelector('[data-fv-end]');
    const endOffset = endEl.offsetTop - window.innerHeight / 3;
    const nextEl = endEl?.nextElementSibling;

    /* ------------ fvMaskアニメーションのscale設定 */
    function getMaxScale() {
        const vw = window.innerWidth;
        if (vw >= 3000) return 10;
        if (vw >= 2000) return 6;
        if (vw >= 640) return 5;
        return 4;
    }
    let maxScale = getMaxScale();
    function getScaleByScroll() {
        const scrollTop = window.scrollY;
        const start = fvMask.getBoundingClientRect().top + window.scrollY;
        const end = endEl.getBoundingClientRect().top + window.scrollY;
        const progress = (scrollTop - start) / (end - start);
        const scale = 1 + (maxScale - 1) * progress;
        return Math.min(Math.max(scale, 1), maxScale);
    }
    // 初期scale
    const initialScale = getScaleByScroll();

    /* ------------ fvMaskサイズ初期化 */
    gsap.set(fvMask, {
        maskSize: `${initialWidth * initialScale}% ${initialHeight * initialScale}%`,
        webkitMaskSize: `${initialWidth * initialScale}% ${initialHeight * initialScale}%`,
        filter: 'brightness(1)'
    });

    /* ------------ fvMaskアニメーション設定 */
    const maskObj = { scale: initialScale };
    gsap.to(maskObj, {
        scale: maxScale,
        ease: "none",
        scrollTrigger: {
            trigger: wrap,
            start: "top top",
            end: "bottom top",
            scrub: true
        },
        onUpdate() {
            const progress = this.progress();
            gsap.set(fvMask, {
                maskSize: `${initialWidth * maskObj.scale}% ${initialHeight * maskObj.scale}%`,
                webkitMaskSize: `${initialWidth * maskObj.scale}% ${initialHeight * maskObj.scale}%`,
                filter: `brightness(${1 - 0.3 * progress})`
            });
            gsap.set([fvTitle, headerLogo, headerNavBtn], {
                filter: `grayscale(${progress}) brightness(${1 - progress}) contrast(1) invert(${progress})`
            });
        },
    });


    /* ------------ fvMask, fvTitleアニメーション設定：レスポンシブ対応 */
    let fvMaskMedia = gsap.matchMedia();
    // PC animation
    fvMaskMedia.add("(min-width:768px)", () => {
        /* ------------------------
        ** fvTitleアニメーション（Scroll fixed）
        ------------------------ */
        function getEndOffset(){
            return fvSummarySec.offsetHeight - fvTitle.offsetHeight;
        }
        gsap.killTweensOf(fvTitleImg); // tween kill
        ScrollTrigger.create({
            // markers: true,
            trigger: fvSummarySec,
            start: "top top",
            end: () => `+=${getEndOffset()}`,
            invalidateOnRefresh: true,

            onEnter: () => {
                gsap.set(fvTitle,{
                    position:"fixed",
                    top: 0,
                });
            },
            onEnterBack: () => {
                gsap.set(fvTitle,{
                    position:"fixed",
                    top: 0,
                });
            },
            onLeave: () => {
                gsap.set(fvTitle,{
                    position:"absolute",
                    top:getEndOffset()
                });
            },
            onLeaveBack: () => {
                gsap.set(fvTitle,{
                    position:"fixed",
                    top: 0,
                });
            }
        });
    });
    // SP animation
    fvMaskMedia.add("(max-width:767px)", () => {
        gsap.to(maskObj, {
            scale: maxScale,
            ease: "power2.out",
            scrollTrigger: {
                // markers: true,
                trigger: fvMask,
                start: endOffset + window.innerHeight * 1.2,
                onEnter: () => {
                    gsap.killTweensOf(fvTitleImg); // tween kill
                    gsap.to(fvTitleImg, {
                        opacity: 0,
                        filter: "blur(20px)",
                        duration: 1.5,
                        ease: "power3.out"
                    });
                },
                onLeaveBack: () => {
                    gsap.killTweensOf(fvTitleImg); // tween kill
                    gsap.to(fvTitleImg, {
                        opacity: 1,
                        filter: "blur(0px)",
                        duration: 0.5,
                        ease: "power3.out"
                    });
                }
            }
        });
    });

    /* ------------------------
    ** summaryテキストのbackdrop filter
    ------------------------ */
    ScrollTrigger.create({
        // markers: true,
        trigger: fvSummarySecText,
        start: "top bottom",
        end: "bottom bottom",
        invalidateOnRefresh: true,

        onEnter: () => {
            gsap.set(fvSummarySecBlur, { opacity: 1 });
        },
        onLeave: () => {
            gsap.set(fvSummarySecBlur, { opacity: 0 });
        },
        onEnterBack: () => {
            gsap.set(fvSummarySecBlur, { opacity: 1 });
        },
        onLeaveBack: () => {
            gsap.set(fvSummarySecBlur, { opacity: 0 });
        },
    });


    /* ------------------------
    ** 次の領域に入る時のヘッダーの変化
    ------------------------ */
    if (nextEl) {
        ScrollTrigger.create({
            // markers: true,
            trigger: nextEl,
            start: `top-=${header.offsetHeight / 2} top`,
            invalidateOnRefresh: true,
            onEnter: () => {
                header.classList.add("is-scroll");
                gsap.set([headerLogo, headerNavBtn], { clearProps: "filter" });
                header.classList.remove("is-reverse");
            },
            onLeaveBack: (self) => {
                header.classList.add("is-reverse");
                header.classList.remove("is-scroll");
            },
        });
    }


    /* ------------------------
    ** resize対応
    ------------------------ */
    window.addEventListener('resize', () => {
        maxScale = getMaxScale();
        ScrollTrigger.refresh();
    });
}


/*==================================================
gnav
==================================================*/
function toggleNav() {
    const headerWrap = document.querySelector('.l-header');
    const navBtn = document.querySelector('.l-header-nav .btn-nav');
    const navLinks = document.querySelectorAll('.nav-link');
    let scrollPosition = 0;

    function openNav(returnScroll) {
        scrollPosition = window.pageYOffset;
        headerWrap.classList.add('is-open');
        navBtn.classList.add('is-open');
        document.body.classList.add('no-scroll');

        // window.lenis?.stop(); // Lenis stop // del
        if (document.querySelector('body#top-contents')) {
            ScrollTrigger.normalizeScroll(false);
        }

        if (returnScroll) {
            document.body.style.top = `-${scrollPosition}px`;
        }
    }

    function closeNav(returnScroll) {
        setTimeout(() => {
            headerWrap.classList.remove('is-open');
            navBtn.classList.remove('is-open');
        }, 100);

        document.body.classList.remove('no-scroll');
        document.body.style.top = '';

        if (document.querySelector('body#top-contents')) {
            ScrollTrigger.normalizeScroll(true);
        }

        if (returnScroll) {
            window.scrollTo(0, scrollPosition);
        }
    }

    if (headerWrap || navBtn) {
        navBtn.addEventListener('click', () => {
            headerWrap.classList.contains('is-open') ? closeNav() : openNav();
        });
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (headerWrap.classList.contains('is-open')) closeNav();
            });
        });
    }

    // scroll時の変化
    function onScrollResize() {
        toggleHeaderScroll(headerWrap);
    }
    onScrollResize();
    window.addEventListener('scroll', onScrollResize);
    window.addEventListener('resize', debounce(onScrollResize));

    // export
    toggleNav.close = closeNav;
    toggleNav.open = openNav;
}
function toggleHeaderScroll(header) {
    const headerEl = header;
    if (!headerEl) return;
    if (document.body.id === 'top-contents') return;

    let tgHeight = 10;
    // let tgHeight = headerEl.offsetHeight;
    // if (document.body.id === 'top-contents') {
    //     tgHeight = headerEl.offsetHeight + 30;
    // }

    if (window.pageYOffset >= tgHeight) {
        headerEl.classList.add('is-scroll');
    } else {
        headerEl.classList.remove('is-scroll');
    }
}


/*==================================================
pagetop
・hasFooter : Boolean
・addOffset : 追加させたい高さ
・tgWrap : セレクター（追従要素）
==================================================*/
function updateFixedOffset() {
    // if (isSp(1000)) {
    //     _fixedOffset = $('.l-header-nav').outerHeight() || 0;
    // } else {
    //     _fixedOffset = 0;
    // }
    handleFixed(true, _fixedOffset);
}
function handleFixed(hasFooter, addOffset, tgWrap) {
    const wrap = tgWrap ? document.querySelector(tgWrap) : document.querySelector('.l-fixed');
    if (!wrap) return;

    let wid = window.innerWidth;
    let wHeight = window.innerHeight;

    const header = document.querySelector('.l-header');
    let showPosition = header ? header.offsetHeight : 0;

    /* 表示タイミング調整 */
    let adjust;
    if (wid <= 640) {
        adjust = wHeight * 0.5;
    } else {
        adjust = wHeight * 0.3;
    }

    const fvWrap = document.querySelector('.fv-grid-wrap');
    if (fvWrap) {
        showPosition = fvWrap.offsetHeight - adjust;
    }

    if (window.pageYOffset > showPosition) {
        wrap.classList.add('is-show');
    } else {
        wrap.classList.remove('is-show');
    }

    const scrollH = document.documentElement.scrollHeight;
    const scrollP = wHeight + window.pageYOffset;

    const footer = document.querySelector('.l-footer');
    const footerH = (hasFooter && footer) ? footer.offsetHeight : 0;

    let position = (wid <= 640) ? 15 : 20;

    if (scrollH - scrollP <= footerH) {
        wrap.style.position = 'absolute';
        wrap.style.right = position + 'px';
        wrap.style.bottom =
            (addOffset !== 0)
                ? footerH + position + addOffset + 'px'
                : footerH + position + 'px';
    } else {
        wrap.style.position = 'fixed';
        wrap.style.right = position + 'px';
        wrap.style.bottom =
            (addOffset !== 0)
                ? position + addOffset + 'px'
                : position + 'px';
    }
}


/*==================================================
フォーム
==================================================*/
function setForm() {
    const inputs = document.querySelectorAll('.form-input');

    if(inputs.length < 1) return;
    inputs.forEach((input, index) => {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                const nextIndex = index + 1;
                if (nextIndex < inputs.length) {
                    inputs[nextIndex].focus();
                } else {
                    input.blur();
                }
            }
        });
    });

    const zipBtn = document.querySelector('.zip-btn');
    if (zipBtn) {
        zipBtn.addEventListener('click', function (e) {
            e.preventDefault();
            AjaxZip3.zip2addr('zip', 'zip1', 'pref', 'addr');
        });
    }
}


/*==================================================
スライダー
==================================================*/
function flowSlider(){
    const sliders = document.getElementsByClassName('js-flow-slider');
    if(!sliders.length) return;

    for (let i = 0; i < sliders.length; i++) {
        const sliderEl = sliders[i];

        const isReverse = sliderEl.classList.contains('type-reverse');
        const autoScrollSpeed = isReverse ? -0.5 : 0.5;

        const splide = new Splide(sliderEl, {
            type: 'loop',
            drag: false,
            arrows: false,
            pagination: false,
            gap: 0,
            perPage: 3,
            padding: '10%',
            breakpoints: {
                1200: {
                    perPage: 2,
                },
                640: {
                    padding: '5%',
                },
            },
            autoScroll: {
                speed: autoScrollSpeed,
                pauseOnHover: false,
                pauseOnFocus: false,
            },
        });

        if (window.splide && window.splide.Extensions) {
            splide.mount(window.splide.Extensions);
        } else {
            splide.mount();
        }

        sliderEl._splide = splide; // DOMに保存
    }
}


/*==================================================
汎用パーツ
==================================================*/
function bgPin(){
    gsap.registerPlugin(ScrollTrigger);
    ScrollTrigger.getAll().forEach(st => {
        if (st.vars.id === 'bgPin') st.kill();
    });

    const tgWrap = document.querySelectorAll('.js-pin-bg');
    if(tgWrap.length){
        tgWrap.forEach(wrap => {
            const pinItem = wrap.querySelector('.js-pin-bg__item');

            // 高さ確認
            const wrapHeight = wrap.offsetHeight;
            const vh = window.visualViewport?.height || window.innerHeight;
            if (wrapHeight <= vh) return;

            gsap.to(pinItem, {
                ease: "none",
                scrollTrigger: {
                    id: "bgPin",
                    // markers: true,
                    trigger: wrap,
                    start: "top top",
                    end: "bottom bottom",
                    scrub: true,
                    pin: pinItem,
                    pinSpacing: false,
                    invalidateOnRefresh: true,
                    anticipatePin: 1,
                }
            });
        });
    }
}