var gulp = require('gulp');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');

gulp.task('browserify', function () {
    return browserify('./public/app/app.js')
        .transform(babelify, {stage: 0})
        .bundle()
        .pipe(source('bundle.js'))
        .pipe(gulp.dest('public/app'));
})
gulp.task('watch', function () {
    gulp.watch('public/**/*.js', ['browserify']);
})