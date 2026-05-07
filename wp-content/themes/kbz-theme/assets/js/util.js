/*==================================================
Util
==================================================*/
(function () {
    /**
     * DOM準備できたら、関数実行
     * docReady(function () { });
     */
    window.docReady = function (fn) {
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(fn, 1);
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    };

    /**
     * SPサイズ判定
     * @param {number} width - 画面幅（default: 640）
     */
    window.isSp = function (width) {
        const screenWidth = width || 640;
        return window.innerWidth < screenWidth;
    };

    /**
     * resizeとかで連続ではなく、1回のみ実行するように
     * @param {Function} func - 実行する関数
     * @param {number} wait - 待つ秒数（ms）
     */
    window.debounce = function (func, wait = 300) {
        let timeout;
        return function (...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    };

    /**
     * slide Up / Down
     */
    window.slideUp = function (target, duration = 400, callback) {
        if (!target) return;

        target.classList.add('is-sliding');

        target.style.transitionProperty = 'height, margin, padding';
        target.style.transitionDuration = duration + 'ms';
        target.style.boxSizing = 'border-box';
        target.style.height = target.offsetHeight + 'px';

        target.offsetHeight; // reflow

        target.style.overflow = 'hidden';
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;

        setTimeout(() => {
            target.style.display = 'none';
            target.style.removeProperty('height');
            target.style.removeProperty('padding-top');
            target.style.removeProperty('padding-bottom');
            target.style.removeProperty('margin-top');
            target.style.removeProperty('margin-bottom');
            target.style.removeProperty('overflow');
            target.style.removeProperty('transition-duration');
            target.style.removeProperty('transition-property');
            target.classList.remove('is-sliding');

            callback && callback();
        }, duration);
    };
    window.slideDown = function (target, duration = 400, callback) {
        if (!target) return;

        target.classList.add('is-sliding');

        target.style.removeProperty('display');
        let display = getComputedStyle(target).display;
        if (display === 'none') display = 'block';
        target.style.display = display;

        const height = target.offsetHeight;

        target.style.overflow = 'hidden';
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;

        target.offsetHeight; // reflow

        target.style.boxSizing = 'border-box';
        target.style.transitionProperty = 'height, margin, padding';
        target.style.transitionDuration = duration + 'ms';
        target.style.height = height + 'px';

        target.style.removeProperty('padding-top');
        target.style.removeProperty('padding-bottom');
        target.style.removeProperty('margin-top');
        target.style.removeProperty('margin-bottom');

        setTimeout(() => {
            target.style.removeProperty('height');
            target.style.removeProperty('overflow');
            target.style.removeProperty('transition-duration');
            target.style.removeProperty('transition-property');
            target.classList.remove('is-sliding');

            callback && callback();
        }, duration);
    };
})();