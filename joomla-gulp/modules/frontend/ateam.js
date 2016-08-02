var gulp = require('gulp');

var config = require('../../../gulp-config.json');

// Dependencies
var browserSync = require('browser-sync');
var minifyCSS   = require('gulp-minify-css');
var rename      = require('gulp-rename');
var rm          = require('gulp-rimraf');
var less        = require('less');
var uglify      = require('gulp-uglify');
var zip         = require('gulp-zip');

var baseTask  = 'modules.frontend.ateam';
var extPath   = './src/modules/site/ateam';
var mediaPath = extPath + '/assets';

// Clean
gulp.task('clean:' + baseTask, function() {
	return gulp.src(config.wwwDir + '/modules/mod_ateam', { read: false })
		.pipe(rm({ force: true }));
});

// Copy module
gulp.task('copy:' + baseTask, ['clean:' + baseTask], function() {
	return gulp.src([
		extPath + '/**',
	])
	.pipe(gulp.dest(config.wwwDir + '/modules/mod_ateam'));
});

// less
gulp.task('less:' + baseTask, function () {
	return gulp.src([
			mediaPath + '/less/ateam.less',
			mediaPath + '/less/ateam-admin.less'
		])
		.pipe(less({loadPath: [mediaPath + '/less']}))
		.pipe(gulp.dest(mediaPath + '/css'))
		.pipe(gulp.dest(config.wwwDir + '/media/mod_ateam/css'))
		.pipe(minifyCSS())
		// .pipe(rename(function (path) {
		// 		path.basename += '.min';
		// }))
		.pipe(gulp.dest(mediaPath + '/css'))
		.pipe(gulp.dest(config.wwwDir + '/media/mod_ateam/css'));
});

// Watch
gulp.task('watch:' + baseTask,
	[
		'watch:modules.frontend.ateam:module',
		'watch:modules.frontend.ateam:less'
	],
	function() {
});

// Watch: Styles
gulp.task('watch:' + baseTask + ':less',
	function() {
		gulp.watch(
			[
				mediaPath + '/less/**'
			],
			['less:' + baseTask, browserSync.reload]
		);
});

// Watch: Module
gulp.task('watch:' + baseTask + ':module', function() {
	gulp.watch([
			extPath + '/**',
		],
		['copy:' + baseTask, browserSync.reload]);
});