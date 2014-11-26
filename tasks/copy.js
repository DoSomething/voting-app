var gulp = require('gulp');
var changed = require('gulp-changed');

var FILES = {
  './app/assets/fonts/**/*.{ttf,woff,eof,svg}': './public/dist/fonts',
  './app/assets/bower_components/respond/dest/respond.min.js': './public/dist/lib'
};

gulp.task('copy', function() {
  for(file in FILES) {
    gulp.src(file)
      .pipe(changed(FILES[file])) // Ignore unchanged files
      .pipe(gulp.dest(FILES[file]));
  }
});
