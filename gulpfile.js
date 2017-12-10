var gulp = require('gulp');
//var coffee = require('gulp-coffee');
//var imagemin = require('gulp-imagemin');
//var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var del = require('del');
// new
var plumber = require('gulp-plumber');
var pleeease = require('gulp-pleeease');

var minifyCss = require('gulp-minify-css');
var sass = require('gulp-sass');

var paths = {
  prod_scripts: [

    'dev/js/jquery-2.2.3.min.js',
    'dev/js/bootstrap-3.3.6.min.js',
    'dev/js/swiper.min.js',
    'dev/js/zoom.min.js',
    'dev/js/jquery.scrollbar.min.js',
    'dev/js/highlight.pack.js',
    'dev/js/joelthorner.js'
  ],
  css : ['./dev/sass/**/*.css', './dev/sass/*.css'],
  // css : ['./dev/sass/*.css'],
  scss : './dev/sass/**/*.scss',
  // prod_css:[
  //   //'css/roboto.css',
  //   'css/zoom.css',
  //   'css/animate.css',
  //   //'css/font-awesome-4.5.0.min.css',
  //   //'css/material-design-iconic-font-2.2.0.min.css',
  //   //'css/bttrlazyloading.min.css',
  //   'css/bootstrap-3.3.6.min.css',
  //   'css/main.min.css'
  // ]
};

// Not all tasks need to use streams
// A gulpfile is just another node program and you can use any package available on npm


// gulp.task('clean', function() {
//   // You can use multiple globbing patterns as you would with `gulp.src`
//   return del(['build']);
// });

// gulp.task('minify-css', ['clean'], function() {
//   return gulp.src(paths.css)
//     .pipe(minifyCss())
//     .pipe(concat('joelthorner.min.css'))
//     .pipe(gulp.dest('./css'));
// });
/*---------------------*/
// gulp.task('prod_clean', function() {
//   // You can use multiple globbing patterns as you would with `gulp.src`
//   return del(['css/production','js/production']);
// });

gulp.task('css_production'/*, ['prod_clean']*/, function() {
  return gulp.src(['./dev/sass/libs/*.css', './dev/sass/*.css'])
    // .pipe(minifyCss())------------------------------
    .pipe(concat('joelthorner.min.css'))
    .pipe(gulp.dest('./css'));
});

gulp.task('js_dev'/*, ['prod_clean']*/, function() {
  // Minify and copy all JavaScript (except vendor scripts)
  // with sourcemaps all the way down
  return gulp.src(paths.prod_scripts)
    //.pipe(sourcemaps.init())
      //.pipe(coffee())
      // .pipe(uglify()) ------------------------------
      .pipe(concat('joelthorner.min.js'))
    //.pipe(sourcemaps.write())
    .pipe(gulp.dest('./js'));
});

gulp.task('production'/*, ['prod_clean']*/, function() {
  gulp.src(['./dev/sass/libs/*.css', './dev/sass/*.css'])
    .pipe(minifyCss())//------------------------------
    .pipe(concat('joelthorner.min.css'))
    .pipe(gulp.dest('./css'));
 gulp.src(paths.prod_scripts)
    //.pipe(sourcemaps.init())
      //.pipe(coffee())
      .pipe(uglify()) //------------------------------
      .pipe(concat('joelthorner.min.js'))
    //.pipe(sourcemaps.write())
    .pipe(gulp.dest('./js'));
});

// gulp.task('production', ['css_production', 'js_dev']);

/*---------------------*/

/*gulp.task('scripts', ['clean'], function() {
  // Minify and copy all JavaScript (except vendor scripts)
  // with sourcemaps all the way down
  return gulp.src(paths.scripts)
    //.pipe(sourcemaps.init())
      //.pipe(coffee())
      .pipe(uglify())
      .pipe(concat('amaiga-gallery.min.js'))
    //.pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/js'));
});*/

// gulp.task('sass', function () {
//   gulp.src(paths.scss)
//   .pipe(pleeease({
//       sass: true
//     }))
//   .pipe(plumber())
//     // .pipe(sass().on('error', sass.logError))
    
//     .pipe(sass({outputStyle: 'compressed'}))
//     .pipe(gulp.dest('dev/sass/css_compiled'));
// });

gulp.task('sass_All', function () {
  return gulp.src(paths.scss)
    .pipe(sass(/*{outputStyle: 'expanded'}*/))
    .pipe(pleeease({
      sass: true
    }))
    .pipe(plumber())
    // .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dev/sass'));
});

// Copy all static images
/*gulp.task('images', ['clean'], function() {
  return gulp.src(paths.images)
    // Pass in options to the task
    .pipe(imagemin({optimizationLevel: 5}))
    .pipe(gulp.dest('build/img'));
});*/

// Rerun the task when a file changes
gulp.task('watch', function() {
  //gulp.watch(paths.scripts, ['scripts']);
  gulp.watch(paths.prod_scripts, ['js_dev']);
  gulp.watch(paths.css, ['css_production']);
  gulp.watch(paths.scss, ['sass_All']);
  // gulp.watch(paths.css, ['minify-css']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['watch', 'js_dev', 'css_production', 'sass_All']);