var appDir = 'app/Resources/assets';

// var gulp = require('gulp');
var clean = require('gulp-clean');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var imagemin = require('gulp-imagemin');
var imageminJpegRecompress = require('imagemin-jpeg-recompress');

var path_js = {
    common: appDir+'/js/common/*.js'
};

var path_less = {
    app: appDir+'/less/app/*.less',
    common: appDir+'/less/common/*.less'
};

var path_media = {
    images: appDir+'/img/**/*.*',
    favicons: appDir+'/favicons/**/*.*'
};

var path_dest = {
    js_common: 'web/bundles/app/js/common',
    css: 'web/bundles/app/css',
    img: 'web/bundles/app/img',
    favicons: 'web/favicons'
};

var path = {
    js: path_js,
    less: path_less,
    media: path_media,
    dest: path_dest
};

module.exports = {

    clean: function (gulp)
    {
        gulp.src(path.dest.js_common, {read: false})
            .pipe(clean());

        gulp.src(path.dest.css, {read: false})
            .pipe(clean());

        gulp.src(path.dest.img, {read: false})
            .pipe(clean());

        gulp.src(path.dest.favicons, {read: false})
            .pipe(clean());

        console.log('clean app finished');
    },

    buildJS: function (gulp)
    {
        gulp.src(path.js.common)
            .pipe(rename({suffix: '.min'}))
            // .pipe(uglify())
            .pipe(gulp.dest(path.dest.js_common));

        console.log('build js app finished');
    },

    buildCSS: function (gulp)
    {
        gulp.src(path.less.app)
            .pipe(less())
            .pipe(rename({suffix: '.min'}))
            .pipe(uglifycss())
            .pipe(gulp.dest(path.dest.css));

        gulp.src(path.less.common)
            .pipe(less())
            .pipe(concat('app.css'))
            .pipe(rename({suffix: '.min'}))
            .pipe(uglifycss())
            .pipe(gulp.dest(path.dest.css));

        console.log('build css app finished');
    },

    buildMedia: function (gulp)
    {
        gulp.src(path.media.images)
            .pipe(imagemin({
                optimisationLevel: 3,
                progressive: true,
                interlaced: true,
                use: [imageminJpegRecompress()]
            }))
            .pipe(gulp.dest(path.dest.img));

        gulp.src(path.media.favicons)
            .pipe(gulp.dest(path.dest.favicons));

        console.log('build media app finished');
    }
};