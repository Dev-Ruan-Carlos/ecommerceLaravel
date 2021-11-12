const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/style.css', 'public/css')
    .postCss('resources/css/header-admin.css', 'public/css')
    .postCss('resources/css/body-admin.css', 'public/css')
    .postCss('resources/css/style-admin.css', 'public/css')
    .postJs('resources/js/funcoes.js', 'public/js');
