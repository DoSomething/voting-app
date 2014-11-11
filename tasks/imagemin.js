var gulp = require('gulp');
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');

var DEST = './public/dist/images';

gulp.task('imagemin', function() {
	return gulp.src('./app/assets/images/**')
		.pipe(changed(DEST)) // Ignore unchanged files
		.pipe(imagemin())
		.pipe(gulp.dest(DEST));
});
