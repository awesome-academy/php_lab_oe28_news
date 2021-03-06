const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js([
    'resources/assets/js/main.js',
], 'public/js/main.js');

mix.js([
    'resources/assets/js/alert.js',
    'resources/assets/js/photo.js',
], 'public/js/alert.js');

mix.js([
    'resources/assets/js/comment.js',
    'resources/assets/js/like.js',
], 'public/js/like.js');

mix.js([
    'resources/assets/js/chart.js',
], 'public/js/chart.js');

mix.js([
    'resources/assets/js/notify.js',
], 'public/js/notify.js');
