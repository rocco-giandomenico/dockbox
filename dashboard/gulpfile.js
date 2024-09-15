const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const svgmin = require('gulp-svgmin');
const terser = require('gulp-terser');


// -----------------------------------------------------------------------------
// Utilities for logging

const colors = {
    cyan: '\x1b[36m',
    yellow: '\x1b[33m'
};


function log(message, color = colors.reset) {
    console.log(color + message + colors.reset);
}

function logWatchEvent(event) {
    log(`File ${event.path} was ${event.type}, running tasks...`, colors.yellow);
}

// -----------------------------------------------------------------------------
// TASKS

// Task for SCSS
gulp.task('sass', function() {
    return gulp.src('src/scss/**/*.scss')
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('public/css'))
});

// Task for SVG
gulp.task('svgmin', function () {
    return gulp.src('src/img/*')
      .pipe(svgmin({
          plugins: [
            {
              name: 'removeViewBox',
              active: false
            }
          ]
        }))
    .pipe(gulp.dest('public/img'))
});

// Task for JS
gulp.task('js', function() {
    return gulp.src('src/js/**/*.js')
        .pipe(terser())
        .pipe(gulp.dest('public/js'))
});

// Task for WATCH
gulp.task('watch', function(done) {
    log('Starting watch task...', colors.cyan);
    log('Press Ctrl+C to stop watching', colors.cyan);

    gulp.watch('src/scss/**/*.scss', gulp.series('sass'))
        .on('all', logWatchEvent);

    gulp.watch('src/svg/**/*.svg', gulp.series('svgmin'))
        .on('all', logWatchEvent);

    gulp.watch('src/js/**/*.js', gulp.series('js'))
        .on('all', logWatchEvent);
});

// -----------------------------------------------------------------------------

// Run all tasks
gulp.task('default', gulp.series(
    gulp.parallel('sass', 'svgmin', 'js'),
    'watch'
));