var gulp = require('gulp');

gulp.task('watch', ['browserify-watch'], function() {
	gulp.watch('app/assets/stylesheets/**', ['sass']);
	gulp.watch('app/assets/images/**', ['imagemin']);
});
