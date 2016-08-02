var gulp = require('gulp');

var config = require('../../../gulp-config.json');

// Dependencies
var browserSync = require('browser-sync');
var rm          = require('gulp-rimraf');
var zip         = require('gulp-zip');

var baseTask  = 'plugins.ajax.ateam';
var extPath   = './src/plugins/ajax/ateam';

// Clean
gulp.task('clean:' + baseTask, function() {
		return gulp.src(config.wwwDir + '/plugins/ajax/ateam', { read: false })
			.pipe(rm({ force: true }));
});

// Copy
gulp.task('copy:' + baseTask, function() {
		return gulp.src([
				extPath + '/**',
			])
			.pipe(gulp.dest(config.wwwDir + '/plugins/ajax/ateam'));
});

// Watch
gulp.task('watch:' + baseTask, function() {
	gulp.watch(extPath + '/**', ['copy:' + baseTask, browserSync.reload]);
});
