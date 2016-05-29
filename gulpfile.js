var gulp = require('gulp');
var app = require("./gulp/app.js");
var bootstrap = require("./gulp/bootstrap.js");
var jquery = require("./gulp/jquery.js");
var fontawesome = require("./gulp/fontAwesome.js");

gulp.task('clean', function () {
    app.clean(gulp);
    bootstrap.clean(gulp);
    jquery.clean(gulp);
    fontawesome.clean(gulp);
});

gulp.task('js', function () {
    app.buildJS(gulp);
});

gulp.task('css', function () {
    app.buildCSS(gulp);
});

gulp.task('media', function () {
    app.buildMedia(gulp);
});

gulp.task('libs', function () {
    bootstrap.build(gulp);
    jquery.build(gulp);
    fontawesome.build(gulp);
});

gulp.task('app', ['js', 'css', 'media']);
gulp.task('default', ['app', 'libs']);