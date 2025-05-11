const mix = require('laravel-mix');
const path = require('path'); // Importando o módulo path

/*
 |---------------------------------------------------------------------------
 | Mix Asset Management
 |---------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version(); // Isso adiciona um hash ao nome do arquivo compilado

// Definir aliases
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '@assets': path.resolve(__dirname, 'resources/assets') // Novo alias
        }
    }
});
