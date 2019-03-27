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
const rename       = require('gulp-rename');
const sass         = require('gulp-sass');
const uglify       = require('gulp-uglify');
const webpack      = require('webpack');

const browserslist = [
    'last 5 versions',
    '>= 1%',
    'Chrome >= 45',
    'Firefox >= 38',
    'Edge >= 12',
    'Explorer >= 10',
    'iOS >= 9',
    'Safari >= 9',
    'Android >= 4.4',
    'Opera >= 30',
    'ie 8-10',
    'not ie <= 7'
];

const dist = [
    '**',
    '!dist{,/**}',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!.**',
    '!docker-compose.override.yml',
    '!docker-compose.yml',
    '!Dockerfile',
    '!gulpfile.js',
    '!package-lock.json',
    '!package.json'
];

gulp.task('clean', function() {
    return del(['css/', 'js/', 'dist/']);
});

gulp.task('vendor-css', function() {
    return gulp.src('./node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css')
    .pipe(concat('vendor.css'))
    .pipe(gulp.dest('css/'));
});

gulp.task('sass', function() {
    var postCSSplugins = [
        require('postcss-flexibility'),
        pixrem(),
        autoprefixer({browsers: browserslist})
    ];
    return gulp.src('sass/*.scss')
    .pipe(sass({
        includePaths: 'sass',
        outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('vendor-css', 'sass', function css() {
    return gulp.src(['css/*.css', '!css/*.min.css'])
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('webpack', function(done) {
    webpack({
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
                jquery: 'jquery/src/jquery',
                bootstrap: 'bootstrap/dist/js/bootstrap.bundle',
                popper: 'popper.js'
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
    return gulp.src(['js/*.js', '!js/*.min.js'])
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
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());
}));

gulp.task('images', function() {
    return gulp.src('img/*.{png,jpg,gif}')
    .pipe(imagemin())
    .pipe(gulp.dest('img/'));
});

gulp.task('dist', function() {
    return gulp.src(dist)
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
        host: argv.URL || 'localhost',
        proxy: argv.URL || 'localhost',
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('src/**/*.js', gulp.series('webpack'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
