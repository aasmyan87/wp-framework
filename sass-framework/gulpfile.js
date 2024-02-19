const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify-es').default;
const cleanCSS = require('gulp-clean-css');
const gcmq = require('gulp-group-css-media-queries');
const sourcemaps = require('gulp-sourcemaps');

let wp_path = "../wp-content/themes/wp-framework/";


// Copy
gulp.task('copy', function () {
    gulp.src('./src/fonts/**/*')
        .pipe(gulp.dest(`${wp_path}fonts`))
    gulp.src('./src/js/**/*')
        .pipe(gulp.dest(`${wp_path}js`))

});

// Compile Sass files and minify output file
gulp.task('sass', function () {
    return gulp.src([
        'src/sass/**/!(_abstracts)/*.scss'
    ])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(gcmq())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(cleanCSS())
        .pipe(gulp.dest(`${wp_path}css`))

});



// Task for non-minified JavaScript
gulp.task('scripts-clean', function () {
    return gulp.src([
        // Child themes scripts
        './src/js/**/*.js',
    ])
        .pipe(gulp.dest(`${wp_path}js`));
});

// Task for minified JavaScript
gulp.task('scripts-min', function () {
    return gulp.src([
        // Child themes scripts
        './src/js/**/!(*vendor*)/*.js',
    ])
        .pipe(gulp.dest(`${wp_path}js`))
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(`${wp_path}js`));
});

// Watch
gulp.task('watch', function () {

    // SCSS
    gulp.watch([
        './src/sass/**/*'
    ], [
        'sass'
    ]);

    // JS
    gulp.watch([
        './src/js/**/*.js'
    ], [
        'scripts-clean', 'scripts-min'
    ]);


    // Copy
    gulp.watch([
        './src/images/**/*',
        './src/fonts/**/*',
        './src/js/**/*'
    ], [
        'copy'
    ]);
});
gulp.task('run', ['sass', 'scripts-clean', 'scripts-min', 'copy', 'watch']);
gulp.task('default', ['run']);







