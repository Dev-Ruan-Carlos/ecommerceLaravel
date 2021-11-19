const { scripts } = require('laravel-mix');
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

mix.js('resources/js/app.js', 'public/js');

mix.postCss('resources/css/style.css', 'public/css')
    .postCss('resources/css/header-admin.css', 'public/css')
    .postCss('resources/css/body-admin.css', 'public/css')
    .postCss('resources/css/style-admin.css', 'public/css')
    .postCss('resources/css/cadproduto-admin.css', 'public/css')
    .postCss('resources/css/global.css', 'public/css')
    .postCss('resources/css/table.css', 'public/css')
    .postCss('resources/css/datatables.css', 'public/css')
    .postCss('resources/css/responsive.css', 'public/css');

mix.scripts('resources/js/sitemix/funcoes.js', 'public/js/funcoes.js')
    .scripts('resources/js/sitemix/datatables.js', 'public/js/datatables.js')
    .scripts('resources/js/sitemix/datatables.sum.js', 'public/js/datatables.sum.js');

