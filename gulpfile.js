var elixir = require('laravel-elixir');
bootstrap = require('bootstrap-styl');

require('laravel-elixir-vueify');
require('laravel-elixir-stylus');

elixir(function (mix) {
    mix.browserify('main.js')
        .stylus('app.styl', null, {use: bootstrap()});
});
