let gulp = require('gulp');
let livereload = require('gulp-livereload');
let rename = require("gulp-rename");
let uglify = require('gulp-uglify-es').default;
const babel = require('gulp-babel');
let sass = require('gulp-sass');
let autoprefixer = require('gulp-autoprefixer');
let sourcemaps = require('gulp-sourcemaps');
let imagemin = require('gulp-imagemin');
let pngquant = require('imagemin-pngquant');
let cleanCSS = require('gulp-clean-css');
let svgo = require('gulp-svgo');
var concat = require('gulp-concat');
var order = require("gulp-order");

gulp.task('imagemin', function () {
    gulp.src('./resources/assets/images/**/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('./public/images'));
});

gulp.task('svgopt', () => {

    return gulp.src('./resources/assets/images/**/*.svg')
        .pipe(svgo())
        .pipe(gulp.dest('./public/images/'));
});

gulp.task('minify-css', () => {
    gulp.src('./resources/assets/css/*.css')
        .pipe(cleanCSS({compatibility: '*'}))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('sass', function () {
    gulp.src('./resources/assets/sass/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./public/css'));
});

gulp.task("uglify", function () {
    return gulp.src('./resources/assets/js/**/*.js')
        .pipe(babel({
            "presets": [
                [ "es2015", { "modules": false } ]
            ]
        }))
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

/*gulp.task('uglify', function () {
    gulp.src('./resources/assets/js/*.js')
        .pipe(uglify('main.js'))
        .pipe(gulp.dest('./public/js'));
});*/

gulp.task('watch', function () {
    livereload.listen();

    gulp.watch('./resources/assets/sass/*.scss', ['sass']);
    gulp.watch('./resources/assets/js/*.js', ['uglify']);
    gulp.watch('./resources/assets/css/*.css', ['minify-css']);
    gulp.watch('./resources/assets/images/**/*.svg', ['svgopt']);
    gulp.watch(['./public/css/*.css', './public/images/**/*.jpg', './public/images/**/*.png', './public/images/site_icons/**/*.svg', './resources/views/**/*.php', './public/js/*.js'], function (files) {
        livereload.changed(files);
    });
});