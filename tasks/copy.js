var gulp = require('gulp');
var changed = require('gulp-changed');

var DEST = './public/dist/fonts';

gulp.task('copy', function() {
	return gulp.src('./app/assets/fonts/**/*.{ttf,woff,eof,svg}')
		.pipe(changed(DEST)) // Ignore unchanged files
		.pipe(gulp.dest(DEST));
});
