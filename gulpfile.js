//require('laravel-elixir-vue-2');

//const elixir = require('laravel-elixir');
var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
    gulp.src('/var/www/html/tstshop/resources/assets/sass/app.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('/var/www/html/tstshop/public/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./sass/**/*.scss', ['sass']);
});

gulp.task('default', function () {
    gulp.run('sass');
});