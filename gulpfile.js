var gulp          = require('gulp');
var sass          = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var sourcemaps    = require('gulp-sourcemaps');
var cleanCSS      = require('gulp-clean-css');
var svgmin        = require('gulp-svgmin');
var cssmin        = require('gulp-cssmin');
var rename        = require('gulp-rename');
var jsmin         = require('gulp-jsmin');
var imagemin    = require('gulp-imagemin');

gulp.task('sass', function() {
  return gulp.src('./development/sass/main.scss')
      .pipe(sass().on('error', console.log))
      .pipe(autoprefixer())
      .pipe(sourcemaps.write())
      .pipe(rename({basename: 'style'}))
      .pipe(gulp.dest('./'));
});

gulp.task('style_css', function() {
    return gulp.src('./style.css')
      .pipe(cssmin())
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest('./'));
});

gulp.task('css', function() {
    return gulp.src('./development/css/*.css')
      .pipe(cssmin())
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest('./build/css'));
});

gulp.task('jsmin', function () {
    gulp.src('./development/js/*.js')
        .pipe(jsmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./build/js/'));
});

gulp.task('svg', function() {
    return gulp.src('./development/assets/images/icons/*.svg')
      .pipe(svgmin())
      .pipe(gulp.dest('./build/assets/images/icons'))
})

gulp.task('imgopt', () =>
    gulp.src('./development/assets/images/*')
        .pipe(imagemin())
        .pipe(gulp.dest('./build/assets/images/'))
);

gulp.task('watch', function() {
    gulp.watch('./development/sass/**/*.scss', ['sass']);
    gulp.watch('./development/assets/images/icons/*.svg', ['svg']);
    gulp.watch('./development/css/*.css', ['css']);
    gulp.watch('./development/js/*.js', ['jsmin']);
    gulp.watch('./style.css', ['style_css']);
    gulp.watch('./development/assets/images/*', ['imgopt']);

})

gulp.task('default', ['sass', 'style_css', 'css', 'jsmin', 'svg', 'imgopt', 'watch']);