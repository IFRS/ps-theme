import { read, readFileSync } from 'fs';
import { deleteAsync }  from 'del';
import gulp             from 'gulp';
import parseArgs        from 'minimist';
import babel            from 'gulp-babel';
import browserSync      from 'browser-sync';
import csso             from 'gulp-csso';
import * as dartSass    from 'sass-embedded';
import gulpSass         from 'gulp-sass';
import autoprefixer     from 'autoprefixer';
import path             from 'path';
import PluginError      from 'plugin-error';
import postcss          from 'gulp-postcss';
import sourcemaps       from 'gulp-sourcemaps';
import uglify           from 'gulp-uglify';
import webpack          from 'webpack';
import BundleAnalyzer   from 'webpack-bundle-analyzer';

browserSync.create();

const { name } = JSON.parse(readFileSync('./package.json'));
const { src, dest, series, parallel, watch } = gulp;
const sassCompiler = gulpSass(dartSass);
const argv = parseArgs(process.argv.slice(2));

const IS_PRODUCTION = argv.production || argv.prod;

const BROWSERSYNC_URL = argv.URL || argv.url || 'localhost';

let webpackPlugins = [];
if (argv.bundleanalyzer) webpackPlugins.push(new BundleAnalyzer.BundleAnalyzerPlugin());

async function clean() {
  return await deleteAsync(['css/', 'js/', 'dist/']);
}

function vendor() {
  return src('node_modules/animate.css/animate.css')
  .pipe(dest('css/'));
}

function sass() {
  let postCSS_plugins = [
    autoprefixer,
  ];

  let sass_options = {
    loadPaths: ['sass', 'node_modules'],
    style: 'expanded',
    quietDeps: true,
  };

  return src('sass/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sassCompiler.sync(sass_options).on('error', sassCompiler.logError))
  .pipe(postcss(postCSS_plugins))
  .pipe(sourcemaps.write('./'))
  .pipe(dest('css/'))
  .pipe(browserSync.stream());
}

function css() {
  return src('css/*.css')
  .pipe(csso())
  .pipe(dest('css/'))
  .pipe(browserSync.stream());
}

function bundle(done) {
  webpack({
    mode: IS_PRODUCTION ? 'production' : 'development',
    devtool: IS_PRODUCTION ? 'source-map' : 'eval-source-map',
    entry: {
      'ps': './src/ps.js',
      'cursos': './src/cursos.js',
      'cronograma': './src/cronograma.js',
      'chamadas': './src/chamadas.js',
      'chamada': './src/chamada.js',
      'faq': './src/faq.js',
      'admin_campi-alert': './src/admin_campi-alert.js',
    },
    output: {
      path: path.resolve(path.dirname(''), 'js'),
      filename: '[name].js',
    },
    plugins: [
      new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: 'true',
        __VUE_PROD_DEVTOOLS__: 'false',
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'false'
      }),
      ...webpackPlugins
    ],
    externals: {
      jquery: 'jQuery',
    },
    resolve: {
      alias: {
        'vue$': 'vue/dist/vue.esm-bundler.js',
      },
    },
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
    if (err) throw new PluginError('webpack', err.toString({ colors: true }));

    if (stats.hasErrors()) throw new PluginError('webpack', stats.toString({ colors: true }));

    browserSync.reload();

    done();
  });
}

function js() {
  return src('js/*.js')
  .pipe(babel({
    presets: [
      ['@babel/preset-env']
    ]
  }))
  .pipe(uglify())
  .pipe(dest('js/'))
  .pipe(browserSync.stream());
}

function dist() {
  return src([
    '**',
    '!.**',
    '!css/*.map',
    '!dist/**',
    '!js/*.map',
    '!node_modules/**',
    '!sass/**',
    '!src/**',
    '!gulpfile.mjs',
    '!package*.json',
    '!README.md',
  ], {
    encoding: false,
  })
  .pipe(dest('dist/' + name), {
    encoding: false,
  });
}

function serve() {
  browserSync.init({
    ui: argv.ui,
    ghostMode: true,
    open: false,
    notify: false,
    proxy: BROWSERSYNC_URL,
  });

  watch('sass/**/*.scss', sass);

  watch('src/**/*.js', bundle);

  watch('**/*.php').on('change', browserSync.reload);
}

const styles = series(vendor, sass, css);
const scripts = series(bundle, js);
const build = IS_PRODUCTION ? series(clean, parallel(styles, scripts), dist) : series(clean, parallel(vendor, sass, bundle));

export { clean, vendor, sass, bundle, styles, scripts, build };

export default series(build, serve);
