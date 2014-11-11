var gulp = require('gulp');

gulp.task('build', ['clean', 'sass', 'browserify', 'imagemin', 'copy']);
