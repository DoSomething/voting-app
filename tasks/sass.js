var gulp = require('gulp');
var sass = require('gulp-ruby-sass')
var autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
	gulp.src('app/assets/stylesheets/app.scss')
		.pipe(sass({
      bundleExec: true
    }))
    .pipe(autoprefixer('last 5 version'))
		.pipe(gulp.dest('public/dist'));
});
