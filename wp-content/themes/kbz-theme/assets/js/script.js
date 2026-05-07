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
    toggleSubNav();
    window.addEventListener('resize', debounce(toggleSubNav, 300));

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

    // /* フォーム */
	setForm();

    // /* スライダー */
    topFvSlider();
    flowSlider();

    // /* 汎用パーツ */
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

    if (_isInitHashScroll) { // ページに入った時に
        window.scrollTo({ top: position, behavior: 'smooth' });
        _isInitHashScroll = false;
        return;
    }

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
    const markerWrap = document.querySelectorAll('.js-marker-wrap');
    if (markerWrap.length < 1) return;
    markerWrap.forEach((title) => {
        if(title.dataset.noAnim !== undefined) return; // 実行したくないもの
        const objs = title.querySelectorAll('.js-marker');
        const triggerEl = title.closest('.ani-gsap') || title;

        if(objs.length < 1) return;
        // 初期化
        gsap.set(objs, {
            webkitMask: 'linear-gradient(to right, #000 0%, #000 0%, transparent 0%)',
            mask: 'linear-gradient(to right, #000 0%, #000 0%, transparent 0%)',
        });

        // アニメーション
        document.addEventListener('app:loaded', () => {
            gsap.to(objs, {
                webkitMask: 'linear-gradient(to right, #000 0%, #000 100%, transparent 100%)',
                mask: 'linear-gradient(to right, #000 0%, #000 100%, transparent 100%)',
                duration: 0.65,
                stagger: 0.2,
                scrollTrigger: {
                    trigger: triggerEl,
                    start: 'top 100%',
                    toggleActions: 'play none none none',
                }
            });
        }, { once: true });
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
        if (!isSp(992)) {
            closeNav();
        }
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

    let tgHeight = 50;
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

function toggleSubNav() {
    const isPc = !isSp(992);
    if (isPc) {
        const nav = document.querySelector('#gnav');
        if (!nav) return;

        document.querySelectorAll('.js-sub-menu').forEach(item => {
            const toggleBtn = item.querySelector('.js-sub-menu__toggle');
            const subNavWrap = item.querySelector('.js-sub-menu__wrap');
            if (!toggleBtn || !subNavWrap) return;

            const subShow = () => {
                item.classList.add('is-active');
            };
            const subHide = (e) => {
                if (!e || !e.relatedTarget || !item.contains(e.relatedTarget)) {
                    item.classList.remove('is-active');
                }
            };

            item.addEventListener('mouseenter', subShow);
            item.addEventListener('mouseleave', subHide);

            item.addEventListener('focusin', subShow);
            item.addEventListener('focusout', subHide);
        });
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
function topFvSlider() {
    const slider = document.querySelector('.top-fv-wrap .fv-slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.splide__slide');
    const isSingle = slides.length <= 1;

    const splide = new Splide(slider, {
        type: isSingle ? 'slide' : 'loop',
        arrows: false,
        pagination: !isSingle,
        drag: !isSingle,
    });
    splide.mount();
}
function flowSlider(){
    const sliders = document.querySelectorAll('.js-flow-slider');
    if(!sliders) return;

    for (let i = 0; i < sliders.length; i++) {
        const sliderEl = sliders[i];

        const isReverse = sliderEl.classList.contains('type-reverse');
        const autoScrollSpeed = isReverse ? -1 : 1;

        const splide = new Splide(sliderEl, {
            type: 'loop',
            autoWidth: true,
            gap: '2.5rem',
            arrows: false,
            pagination: false,
            drag: false,
            breakpoints: {
                640: {
                    gap: '8%',
                },
            },
            autoScroll: {
                speed: autoScrollSpeed,
                pauseOnHover: false,
                pauseOnFocus: false,
            },
        });
        splide.mount(window.splide.Extensions);
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