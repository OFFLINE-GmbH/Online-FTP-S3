var elixir = require('laravel-elixir');
bootstrap = require('bootstrap-styl');

require('laravel-elixir-vueify');
require('laravel-elixir-stylus');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.browserify('main.js')
        .stylus('app.styl', null, {use: bootstrap()});
});
