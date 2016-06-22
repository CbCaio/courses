var gulp = require('gulp');
var elixir = require('laravel-elixir');

/**
 * Copy any needed files.
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfiles", function() {

    // Copy jQuery
    gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
     .pipe(gulp.dest("resources/assets/js/"));

    //Bootstrap
    gulp.src("vendor/bower_dl/bootstrap/less/**")
     .pipe(gulp.dest("resources/assets/less/bootstrap"));

    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.js")
     .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/dist/fonts/**")
     .pipe(gulp.dest("public/assets/fonts"));

    gulp.src("vendor/bower_dl/bootstrap/dist/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    //FontAwesome
    gulp.src("vendor/bower_dl/font-awesome/less/**")
        .pipe(gulp.dest("resources/assets/less/font-awesome"));

    gulp.src("vendor/bower_dl/font-awesome/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

 // Combine scripts
 mix.scripts([
      'js/jquery.js',
      'js/bootstrap.js'
     ],
     'public/assets/js/admin.js',
     'resources/assets'
 );

 // Compile Less
 mix.less('admin.less', 'public/assets/css/admin.css');
});