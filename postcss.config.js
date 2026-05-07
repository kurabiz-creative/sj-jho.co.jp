// module.exports = {
//     map: false,
//     plugins: [
//         require('tailwindcss'),
//         require('postcss-preset-env')({ stage: 3 }),
//         require('autoprefixer'),
//         require('cssnano')({ preset: 'default' })
//     ]
// };

module.exports = {
    map: false,
    plugins: {
        tailwindcss: {},
        'postcss-preset-env': {
            stage: 3
        },
        autoprefixer: {},
        cssnano: {
            preset: 'default'
        }
    }
};