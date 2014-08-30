var gulp = require('gulp'),
    concat = require('gulp-concat');
    browserSync = require('browser-sync');
    sass = require('gulp-sass');
    prefix = require('gulp-autoprefixer');
    minifyCSS = require('gulp-minify-css');
    // jshint = require('gulp-jshint');
    jslint = require('gulp-jslint');

gulp.task('sass', function () {
    gulp.src('*.scss')
        .pipe(sass({includePaths: ['scss']}))
        .pipe(gulp.dest('./'))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('prefix', function () {
    gulp.src('style.css')
        .pipe(prefix("last 2 versions", "> 1%", "ie 8", "ie 7", {cascade:true} ))
        .pipe(gulp.dest('./'));
});

gulp.task('minify-css', function() {
	gulp.src('*.css')
		.pipe(minifyCSS({keepBreaks:true}))
		.pipe(gulp.dest('./dist/'))
});

/*gulp.task('lint', function() {
  return gulp.src('assets/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});*/

gulp.task('jslint', function () {
    return gulp.src(['assets/*.js'])

        .pipe(jslint({
            node: true,
            evil: true,
            nomen: true,
            errorsOnly: false
        }))

        .on('error', function (error) {
            console.error(String(error));
        });
});

gulp.task('browser-sync', function () {

	var config = {
		browser: ["google chrome", "firefox"]
	}

	var files = [
	'*.php',
    'assets/*.js',
	'resources/*',
	'img/*'
	]

   browserSync.init(files, {
      proxy: "localhost/boca"
   });
});

// Default task to be run with `gulp`
gulp.task('default', ['sass', 'prefix', 'browser-sync'], function () {
    gulp.watch("*.scss", ['sass']);
});

gulp.task('js', ['jslint'], function () {
    gulp.watch("assets/*.js",['jslint']);
});