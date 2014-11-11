var gulp = require('gulp');
var sass = require('gulp-ruby-sass')

gulp.task('sass', function () {
	gulp.src('app/assets/stylesheets/app.scss')
		.pipe(sass())
		.pipe(gulp.dest('public/dist'));
});
