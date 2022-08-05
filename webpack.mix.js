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

mix.js('node_modules/flatpickr/dist/flatpickr.js', 'public/node_modules/flatpickr/js')
    .copy('node_modules/flatpickr/dist/flatpickr.css', 'public/node_modules/flatpickr/css/flatpickr.css')
    .js('node_modules/flatpickr/dist/esm/l10n/zh-tw.js', 'public/node_modules/flatpickr/js')
    .copy('node_modules/flatpickr/dist/plugins/monthSelect/index.js', 'public/node_modules/flatpickr/js/index.js')
    .copy('node_modules/flatpickr/dist/plugins/monthSelect/style.css', 'public/node_modules/flatpickr/css/style.css');
