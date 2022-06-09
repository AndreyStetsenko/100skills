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

mix
    .js(['resources/js/client/app.js', 'resources/js/client/default.js', 'resources/js/client/script.js', 'resources/js/client/components.js'], 'public/client/js')

    .js(['resources/js/panel/app.js', 'resources/js/panel/default.js', 'resources/js/panel/components.js'], 'public/panel/js')
    .js(['resources/js/panel/app.js', 'resources/js/panel/default.js', 'resources/js/panel/components/page.component.js'], 'public/js/panel/page.component.js')

    .postCss('resources/css/app.css', 'public/css', [
	    require('autoprefixer'),
	]).postCss('resources/css/app.panel.css', 'public/css', [
        require('autoprefixer'),
    ]);
// .sourceMaps();
