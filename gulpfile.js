var gulp = require('gulp'),
    jshint = require('gulp-jshint');
    concat = require('gulp-concat');
    browserSync = require('browser-sync');
    sass = require('gulp-sass');
    prefix = require('gulp-autoprefixer');
	minifyCSS = require('gulp-minify-css');
//	spritesmith = require('gulp-spritesmith');

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

/*

gulp.task('sprite', function () {
	var spriteData = gulp.src('img/sprites/*.png').pipe(spritesmith({
		imgName: 'spritesheet.png',
		cssName: 'sprites.png'
	}));
	
	spriteData.img.pipe(gulp.dest('img/'));
	spriteData.css.pipe(gulp.dest('img/'));
});

*/

gulp.task('browser-sync', function () {
	
	var config = {
		browser: ["google chrome", "firefox"]
	}

	var files = [
	'*.php',
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