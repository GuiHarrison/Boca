var gulp = require('gulp'),
    concat = require('gulp-concat');
    browserSync = require('browser-sync');
    sass = require('gulp-sass');
    prefix = require('gulp-autoprefixer');
    minifyCSS = require('gulp-minify-css');
    jslint = require('gulp-jslint');
    uglify = require('gulp-uglify');

gulp.task('sass', function () {
    gulp.src('*.scss')
        .pipe(sass({includePaths: ['scss']}))
        .pipe(gulp.dest('./'))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('prefix', function () {
    gulp.src('style.css')
        .pipe(prefix("last 2 versions", "> 1%", "ie 8", "ie 7", {cascade:true} ))
        .pipe(gulp.dest('./dist/'));
});

gulp.task('minify-css', function() {
	gulp.src('*.css')
		.pipe(minifyCSS({
            keepSpecialComments:1
        }))
		.pipe(gulp.dest('./dist/'));
});

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

gulp.task('compress', function() {
  gulp.src('assets/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('dist'));
});

gulp.task('browser-sync', function () {

	var config = {
		browser: ["google chrome", "firefox"]
	};

	var files = [
	'*.php',
    'assets/*.js',
	'resources/*',
	'img/*'
	];

   browserSync.init(files, {
      proxy: "localhost/boca"
   });
});

// Default task to be run with `gulp`
gulp.task('default', ['sass', 'prefix', 'browser-sync'], function () {
    gulp.watch("*.scss", ['sass']);
});

gulp.task('z', ['compress', 'minify-css']);