var vendorDir = './vendor';
var clean = require('gulp-clean');

var path_font = {
    fontawesome: vendorDir+'/font-awesome/fonts/*.*'
};

var path_css = {
    fontawesome: vendorDir+'/font-awesome/css/font-awesome.min.css'
};

var path_dest = {
    css: 'web/fontawesome',
    font: 'web/fonts'
};

var path = {
    font: path_font,
    css: path_css,
    dest: path_dest
};

module.exports = {

    clean: function (gulp)
    {
        gulp.src(path.dest.css, {read: false})
            .pipe(clean());

        gulp.src(path.dest.font, {read: false})
            .pipe(clean());

        console.log('clean fontawesome finished');
    },

    build: function (gulp)
    {
        // css
        gulp.src(path.css.fontawesome)
                .pipe(gulp.dest(path.dest.css));

        // font
        gulp.src(path.font.fontawesome)
                .pipe(gulp.dest(path.dest.font));

        console.log('build fontawesome finished');
    }
};