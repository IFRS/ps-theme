const argv           = require('minimist')(process.argv.slice(2));
const babel          = require('gulp-babel');
const browserSync    = require('browser-sync').create();
const csso           = require('gulp-csso');
const concat         = require('gulp-concat');
const del            = require('del');
const gulp           = require('gulp');
const path           = require('path');
const PluginError    = require('plugin-error');
const postcss        = require('gulp-postcss');
const sass           = require('gulp-sass')(require('sass'));
const sourcemaps     = require('gulp-sourcemaps');
const uglify         = require('gulp-uglify');
const webpack        = require('webpack');
const BundleAnalyzer = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

gulp.task('clean', async function() {
    return await del(['css/', 'js/', 'vendor/', 'dist/']);
});

gulp.task('sass', function() {
    let postCSS_plugins = [
        require('postcss-flexibility'),
        require('pixrem'),
        require('autoprefixer'),
    ];

    let sass_options = {
        includePaths: ['sass', 'node_modules'],
        outputStyle: 'expanded',
        precision: 6,
    };

    return gulp.src('sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sass_options).on('error', sass.logError))
    .pipe(postcss(postCSS_plugins))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('sass', function css() {
    return gulp.src('css/*.css')
    .pipe(csso())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

const webpackMode = argv.production ? 'production' : 'development';
let webpackPlugins = [];
argv.bundleanalyzer ? webpackPlugins.push(new BundleAnalyzer()) : null;

gulp.task('webpack', function(done) {
    webpack({
        mode: webpackMode,
        devtool: 'source-map',
        entry: {
            ie: './src/ie.js',
            ps: './src/ps.js',
            cursos: './src/cursos.js',
            cronograma: './src/cronograma.js',
            chamadas: './src/chamadas.js',
        },
        output: {
            path: path.resolve(__dirname, 'js'),
            filename: '[name].js',
        },
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
            }),
            ...webpackPlugins
        ],
        optimization: {
            minimize: false,
            splitChunks: {
                cacheGroups: {
                    vendors: false,
                    commons: {
                        name: 'commons',
                        chunks: 'all',
                        minChunks: 2,
                    },
                },
            },
        },
    }, function(err, stats) {
        if (err) throw new PluginError('webpack', {
            message: err.toString({
                colors: true
            })
        });
        if (stats.hasErrors()) throw new PluginError('webpack', {
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
    .pipe(uglify())
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());
}));

gulp.task('dist', function() {
    return gulp.src([
        '**',
        '!.**',
        '!css/*.map',
        '!dist{,/**}',
        '!js/*.map',
        '!node_modules{,/**}',
        '!sass{,/**}',
        '!src{,/**}',
        '!gulpfile.js',
        '!package-lock.json',
        '!package.json'
    ])
    .pipe(gulp.dest('dist/ifrs-ps-theme/'));
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', gulp.parallel('styles', 'scripts'), 'dist'));
} else {
    gulp.task('build', gulp.series('clean', gulp.parallel('sass', 'webpack')));
}

const proxyURL = argv.URL || argv.url || 'localhost';

gulp.task('default', gulp.series('build', function watch() {
    browserSync.init({
        ghostMode: false,
        notify: false,
        online: false,
        open: false,
        host: proxyURL,
        proxy: proxyURL,
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('src/**/*.js', gulp.series('webpack'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
