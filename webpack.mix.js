let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    processCssUrls: false,
    uglify: false,
});
mix
    .sass('resources/assets/backend/scss/style.scss', 'public/backend/css')
    .js('resources/assets/backend/js/app.js', 'public/backend/js')
    .sass('resources/assets/frontend/sass/app.sass', 'public/frontend/css')
    .js('resources/assets/frontend/js/app.js', 'public/frontend/js')
    .sourceMaps();

// if(process.env.NODE_ENV.trim() === 'production'){
//     mix.minify('public/frontend/js/app.js');
// }

// if (process.env.NODE_ENV.trim()) {
//     mix.version();
// }

if (process.env.NODE_ENV.trim() === 'production') {

    mix.webpackConfig({
        module: {
            rules: [{
                test: /\.js?$/,
                exclude: /(bower_components)/,
                use: [{
                    loader: 'babel-loader',
                    options: mix.config.babel()
                }]
            }]
        }
    });

    mix.minify('public/frontend/js/app.js');
    mix.minify('public/backend/js/app.js');
}