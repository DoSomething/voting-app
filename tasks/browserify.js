var gulp = require('gulp');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var bundleLogger = require('./util/bundleLogger');
var handleErrors = require('./util/handleErrors');
var watchify = require('watchify');

gulp.task('browserify-watch', function() {
	global.isWatching = true;
	return browserifyRunner();
});

gulp.task('browserify', function() {
	return browserifyRunner();
});

function browserifyRunner() {
	var bundler = browserify({
		cache: {}, packageCache: {}, fullPaths: true,
		entries: ['./app/assets/javascripts/app.js'],
		extensions: ['.js'],
		debug: true
	});

  var bundle = function() {
		bundleLogger.start();

		return bundler
			.bundle()
			.on('error', handleErrors)
			.pipe(source('app.js'))
			.pipe(gulp.dest('./public/dist/'))
			.on('end', bundleLogger.end);
	};

	if(global.isWatching) {
		bundler = watchify(bundler);

		// Rebundle with watchify on changes.
		bundler.on('update', bundle);
	}

	return bundle();
}
