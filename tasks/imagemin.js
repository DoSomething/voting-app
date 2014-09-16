var gulp = require('gulp');
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');

gulp.task('imagemin', function() {
	return gulp.src('./app/assets/images/**')
		.pipe(changed(dest)) // Ignore unchanged files
		.pipe(imagemin())
		.pipe(gulp.dest('./public/dist/images'));
});
