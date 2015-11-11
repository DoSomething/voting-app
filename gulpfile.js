var gulp = require('gulp');
var elixir = require('laravel-elixir');
var eslint = require('gulp-eslint');

/**
 * Configure build pipeline using Laravel Elixir.
 * @see http://laravel.com/docs/5.1/elixir
 */
elixir(function(mix) {

  // Styles
  mix.sass('app.scss');

  // Scripts
  mix.browserify('app.js');

  // Linting
  mix.task('lint', mix.assetsDir + 'js/**/*.js');

  // Copy assets
  mix.copy('resources/assets/fonts', 'public/assets/fonts');
  mix.copy('resources/assets/images', 'public/assets/images');

  // Third-party code
  mix.copy('node_modules/html5shiv/dist/html5shiv.min.js', 'public/assets/vendor/html5shiv.min.js');
  mix.copy('node_modules/respond.js/dest/respond.min.js', 'public/assets/vendor/respond.min.js');

});

/**
 * Custom task to lint scripts using ESLint.
 * @see `.eslintrc`
 */
gulp.task('lint', function() {
  gulp.src(['resources/assets/js/**/*.js'])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
});
