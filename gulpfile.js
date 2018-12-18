var gulp = require('gulp');

var sass = require('gulp-sass');

var browserSync = require('browser-sync');


gulp.task('sass', function() {
    return gulp.src("./scss/*.scss")
        .pipe(sass())
        .pipe(gulp.dest("./css"))
        .pipe(browserSync.stream())

});

gulp.task('watch', ['browser-Sync'], function() {
    gulp.watch("./scss/**/*.scss", ['sass']);
    gulp.watch("./**/*.html").on('change', browserSync.reload);
    gulp.watch("./**/*.php").on('change', browserSync.reload);
});

gulp.task('browser-Sync', function() {
    browserSync.init({
        injectChanges: true,
        proxy: 'slum.dev/index.php',
        port: 81,
        open: false
    });
});

gulp.task('default', ['watch', 'sass', 'browser-Sync']);
