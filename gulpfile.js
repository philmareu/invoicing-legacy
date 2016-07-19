var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.scripts([
        '../bower/jquery/dist/jquery.js',
        '../bower/uikit/js/uikit.js',
        'scripts.js'
    ], 'public/js/scripts.js');
    mix.copy('resources/assets/bower/uikit/fonts', 'public/fonts/');
    mix.less([
        'vendor/uikit/uikit.less',
        'styles.less'
    ], 'public/css/styles.css');
});
