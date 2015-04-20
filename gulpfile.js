var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

  // Styles
  mix.sass('app.scss');

  // Scripts
  mix.browserify('app.js');

  // Copy assets
  mix.copy('resources/assets/fonts', 'public/assets/fonts');
  mix.copy('resources/assets/images', 'public/assets/images');

  // Third-party code
  mix.copy('node_modules/html5shiv/dist/html5shiv.min.js', 'public/assets/vendor/html5shiv.min.js');
  mix.copy('node_modules/respond.js/dest/respond.min.js', 'public/assets/vendor/respond.min.js');

});
