require('laravel-elixir-vue-2');

const elixir = require('laravel-elixir');
var gulp = require('gulp'),
    cssnano = require('gulp-cssnano');

var browsersync = require('browser-sync');
var reload = browsersync.reload;

elixir(function(mix) {
    mix.sass('app.scss')
        .sass('books/a.scss','public/css/css.css')
        .webpack('app.js');
});


//elixir.extend('cssnano', function() {
gulp.task('css_nano', function(){
    return gulp.src('public/css/css.css')
        .pipe(cssnano()) // Using gulp-sass
        .pipe(gulp.dest('public/css/cssnano.css'))
});
//});
gulp.task('browsersync', function(cb) {
    return browsersync({
        proxy: "books2.dev"
    }, cb);
});
