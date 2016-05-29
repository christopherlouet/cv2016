var appDir = 'app/Resources/assets';
var vendorDir = './vendor';

var clean = require('gulp-clean');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');

var path_js = {
    bootstrap: vendorDir + '/bootstrap/dist/js/bootstrap.min.js',
    tether: vendorDir + '/tether/dist/js/tether.min.js'
};

var path_css = {
    bootstrap: vendorDir + '/bootstrap/dist/css/bootstrap.min.css',
    bootstrap_flat: vendorDir + '/bootstrap-flat/css/bootstrap-flat.min.css',
    tether: vendorDir + "/tether/dist/css/tether.min.css"
};

var path_dest = {
    js: 'web/js/bootstrap',
    css: 'web/css/bootstrap'
};

var path = {
    js: path_js,
    css: path_css,
    dest: path_dest
};

module.exports = {

    clean: function (gulp)
    {
        gulp.src(path.dest.js, {read: false})
            .pipe(clean());

        gulp.src(path.dest.css, {read: false})
            .pipe(clean());

        console.log('clean bootstrap finished');
    },

    build: function (gulp)
    {
        // js
        gulp.src(path.js.bootstrap)
            .pipe(gulp.dest(path.dest.js));

        gulp.src(path.js.tether)
            .pipe(gulp.dest(path.dest.js));

        // css
        gulp.src(path.css.bootstrap)
                .pipe(gulp.dest(path.dest.css));

        gulp.src(path.css.bootstrap_flat)
                .pipe(gulp.dest(path.dest.css));

        gulp.src(path.css.tether)
                .pipe(gulp.dest(path.dest.css));

        console.log('build bootstrap finished');
    }
};