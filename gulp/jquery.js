var vendorDir = './vendor';

// var gulp = require('gulp');
var clean = require('gulp-clean');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

var path_js = {
    jquery: vendorDir+'/jquery/dist/jquery.min.js'
};

var path_dest = {
    js: 'web/js/jquery'
};

var path = {
    js: path_js,
    dest: path_dest
};

module.exports = {

    clean: function (gulp)
    {
        gulp.src(path.dest.js, {read: false})
            .pipe(clean());

        console.log('clean jquery finished');
    },

    build: function (gulp)
    {
        gulp.src(path.js.jquery)
                .pipe(gulp.dest(path.dest.js));

        console.log('build jquery finished');
    }
};