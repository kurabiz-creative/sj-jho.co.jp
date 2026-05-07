/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./wp-content/themes/kbz-theme/**/*.php",
        "./wp-content/themes/kbz-theme/**/*.js",
        // "!/**/node_modules/**",
    ],
    theme: {
        // カスタムブレークポイントの定義（★★編集しない★★）
        screens: {
            'sm': '640px',   // Tailwind CSSのデフォルト 'sm'
            'md': '768px',   // ユーザー指定のBP
            'lg': '992px',   // ユーザー指定のBP
            'xl': '1200px',  // ユーザー指定のBP
            '2xl': '1367px', // ユーザー指定のBP
            '3xl': '1500px', // ユーザー指定のBP
        },
        // .container クラスのカスタマイズ
        container: {
            center: true, // コンテナを中央揃えにする
            padding: {
                DEFAULT: '1.5rem',
                md: '15px'
            },
            screens: { /* ★★screensは編集しない★★ */
                sm: '640px',
                md: '650px',
                lg: '870px',
                xl: '1070px',
                '2xl': '1200px',
            },
        },
        extend: {
            // screens: {
            //     hoverable: { raw: '(hover: hover) and (pointer: fine)' }, // hoverを「PCにだけ」適用したい(https://revisnote.com/stories/blog/hoverable-media-query/)
            // },
            colors: {
                'basic': '#404040',
                'main': '#007e79',
                'accent': '#52a0a0',
                'green': '#a0ba52',
                'light-green': '#eff2d3',
                'dark-green': '#33686f',
                'dark-green2': '#175e59',
                'light-gray': '#f4f5ee',
                'accent-link': '#68a8dd',
            },
            fontSize: { /* ★★fontSizeは編集しない★★ */
                xxs: ['0.625rem'],
                xs: ['0.75rem'],
                sm: ['0.875rem'],
                base: ['1rem'],
                lg: ['1.125rem'],
                xl: ['1.25rem'],
                '3xs': ['0.5rem'],
                '2xs': ['0.65rem'],
                '2xl': ['1.5rem'],
                '3xl': ['1.875rem'],
                '4xl': ['2.25rem'],
                '5xl': ['3rem'],
                '6xl': ['3.75rem'],
                '7xl': ['4.5rem'],
                '8xl': ['6rem'],
                '9xl': ['8rem'],
            },
            fontFamily: {
                /* S: ★★デザインに合わせて適宜に変更★★ */
                sans: [
                    '"Zen Kaku Gothic New"',
                    '"游ゴシック体"',
                    '"Yu Gothic"',
                    'YuGothic',
                    '"ヒラギノ角ゴ Pro"',
                    '"Hiragino Kaku Gothic Pro"',
                    '"メイリオ"',
                    'Meiryo',
                    '"MS Pゴシック"',
                    '"MS PGothic"',
                    'sans-serif'
                ],
                serif: [
                    '"Noto Serif JP"',
                    'serif'
                ],
                mont: [
                    '"Montserrat"',
                    'sans-serif'
                ],
                // inter: [
                //     '"Inter"',
                //     'sans-serif'
                // ],
                /* E: ★★デザインに合わせて適宜に変更★★ */

                gothic: [
                    '"游ゴシック体"',
                    '"Yu Gothic"',
                    'YuGothic',
                    '"ヒラギノ角ゴ Pro"',
                    '"Hiragino Kaku Gothic Pro"',
                    '"メイリオ"',
                    'Meiryo',
                    '"MS Pゴシック"',
                    '"MS PGothic"',
                    'sans-serif'
                ],
                mincho: [
                    '"游明朝体"',
                    '"Yu Mincho"',
                    'YuMincho',
                    '"ヒラギノ明朝 Pro"',
                    '"Hiragino Mincho Pro"',
                    '"MS P明朝"',
                    '"MS PMincho"',
                    'serif'
                ]
            },
            keyframes: {
                shiny: {
                    '0%': {
                        transform: 'scale(0) rotate(25deg)',
                        opacity: '0',
                    },
                    '10%': {
                        transform: 'scale(1) rotate(25deg)',
                        opacity: '1',
                    },
                    '100%': {
                        transform: 'scale(50) rotate(25deg)',
                        opacity: '0',
                    },
                },
            },
            animation: {
                shiny: 'shiny 3s ease-in-out infinite',
            },
        },
    },
    plugins: [],
}