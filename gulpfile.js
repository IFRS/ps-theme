const argv         = require('minimist')(process.argv.slice(2));
const autoprefixer = require('autoprefixer');
const babel        = require('gulp-babel');
const browserSync  = require('browser-sync').create();
const cssmin       = require('gulp-cssmin');
const concat       = require('gulp-concat');
const del          = require('del');
const gulp         = require('gulp');
const imagemin     = require('gulp-imagemin');
const path         = require('path');
const pixrem       = require('pixrem');
const PluginError  = require('plugin-error');
const postcss      = require('gulp-postcss');
const sass         = require('gulp-sass');
const sourcemaps   = require('gulp-sourcemaps');
const uglify       = require('gulp-uglify');
const webpack      = require('webpack');

const proxyURL = argv.URL || argv.url || 'localhost';

const webpackMode = argv.production ? 'production' : 'development';

gulp.task('clean', function() {
    return del(['css/', 'js/', 'dist/']);
});

gulp.task('vendor-css', function() {
    return gulp.src(['./node_modules/animate.css/animate.css', './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css'])
    .pipe(concat('vendor.css'))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('sass', function() {
    let postCSSplugins = [
        require('postcss-flexibility'),
        pixrem(),
        autoprefixer()
    ];
    return gulp.src('sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
        includePaths: 'sass',
        outputStyle: 'expanded',
        precision: 8
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('vendor-css', 'sass', function css() {
    return gulp.src('css/*.css')
    .pipe(cssmin())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('webpack', function(done) {
    webpack({
        mode: webpackMode,
        devtool: 'source-maps',
        entry: {
            ie: './src/ie.js',
            ps: './src/ps.js',
            cursos: './src/cursos.js'
        },
        output: {
            path: path.resolve(__dirname, 'js'),
            filename: '[name].js'
        },
        resolve: {
            alias: {
                jquery: 'jquery/dist/jquery',
                bootstrap: 'bootstrap/dist/js/bootstrap.bundle'
            }
        },
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery'
            })
        ],
        optimization: {
            minimize: false,
            splitChunks: {
                chunks: 'all',
                cacheGroups: {
                    vendors: false,
                    commons: {
                        name: "commons",
                        chunks: "initial",
                        minChunks: 2
                    }
                }
            }
        },
    }, function(err, stats) {
        if (err) throw new PluginError('webpack', {
            message: stats.toString({
                colors: true
            })
        });
        browserSync.reload();
        done();
    });
});

gulp.task('scripts', gulp.series('webpack', function js() {
    return gulp.src('js/*.js')
    .pipe(babel({
        presets: [
            [
                "@babel/env",
                { "modules": false }
            ]
        ]
    }))
    .pipe(uglify({
        ie8: true,
    }))
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());
}));

gulp.task('images', function() {
    return gulp.src('img/*.{png,jpg,jpeg,svg,gif}')
    .pipe(imagemin())
    .pipe(gulp.dest('img/'));
});

gulp.task('dist', function() {
    return gulp.src([
        '**',
        '!.**',
        '!dist{,/**}',
        '!node_modules{,/**}',
        '!sass{,/**}',
        '!src{,/**}',
        '!gulpfile.js',
        '!package-lock.json',
        '!package.json'
    ])
    .pipe(gulp.dest('dist/'));
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', gulp.parallel('styles', 'scripts', 'images'), 'dist'));
} else {
    gulp.task('build', gulp.series('clean', gulp.parallel('vendor-css', 'sass', 'webpack')));
}

gulp.task('default', gulp.series('build', function watch() {
    browserSync.init({
        ghostMode: false,
        notify: false,
        online: false,
        open: false,
        proxy: proxyURL,
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('src/**/*.js', gulp.series('webpack'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
