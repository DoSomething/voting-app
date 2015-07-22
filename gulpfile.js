var gulp = require('gulp');
var elixir = require('laravel-elixir');
var eslint = require('gulp-eslint');

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

gulp.task('lint', function() {
  gulp.src(['resources/assets/js/**/*.js'])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
});

elixir(function(mix) {

  // Styles
  mix.sass('app.scss');

  // Scripts
  mix.browserify('app.js');

  // Linting
  mix.task('lint');

  // Copy assets
  mix.copy('resources/assets/fonts', 'public/assets/fonts');
  mix.copy('resources/assets/images', 'public/assets/images');

  // Third-party code
  mix.copy('node_modules/html5shiv/dist/html5shiv.min.js', 'public/assets/vendor/html5shiv.min.js');
  mix.copy('node_modules/respond.js/dest/respond.min.js', 'public/assets/vendor/respond.min.js');

});
