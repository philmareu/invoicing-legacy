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
        '../bower/uikit/js/components/form-select.js',
        '../bower/uikit/js/components/datepicker.js',
        'socket.js',
        'scripts.js'
    ], 'public/js/scripts.js');
    mix.scripts([
        'workorders.js',
        'tasks.js',
        'time.js',
        'notes.js'
    ], 'public/js/workorder.js');
    mix.copy('resources/assets/bower/uikit/fonts', 'public/fonts/');
    mix.less([
        'styles.less'
    ], 'public/css/styles.css');
});
