import { readFileSync } from 'fs';
import { deleteAsync }  from 'del';
import gulp             from 'gulp';
import parseArgs        from 'minimist';
import babel            from 'gulp-babel';
import browserSync      from 'browser-sync';
import csso             from 'gulp-csso';
import dartSass         from 'sass';
// import dartSass         from 'sass-embedded';
import gulpSass         from 'gulp-sass';
import pixrem           from 'pixrem';
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
};

function sass() {
  let postCSS_plugins = [
    pixrem,
    autoprefixer,
  ];

  let sass_options = {
    includePaths: ['sass', 'node_modules'],
    outputStyle: 'expanded',
  };

  return src('sass/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sassCompiler.sync(sass_options).on('error', sassCompiler.logError))
  .pipe(postcss(postCSS_plugins))
  .pipe(sourcemaps.write('./'))
  .pipe(dest('css/'))
  .pipe(browserSync.stream());
};

function css() {
  return src('css/*.css')
  .pipe(csso())
  .pipe(dest('css/'))
  .pipe(browserSync.stream());
};


function bundle(done) {
  webpack({
    mode: IS_PRODUCTION ? 'production' : 'development',
    devtool: IS_PRODUCTION ? 'source-map' : 'eval-source-map',
    entry: {
      'ps': './src/ps.js',
      'cursos': './src/cursos.js',
      'cronograma': './src/cronograma.js',
      'chamada': './src/chamada.js',
    },
    output: {
      path: path.resolve(path.dirname(''), 'js'),
      filename: '[name].js',
    },
    plugins: [...webpackPlugins],
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
};

function js() {
  return src('js/*.js')
  .pipe(babel({
    presets: [
      [
        '@babel/env',
        { 'modules': false }
      ]
    ]
  }))
  .pipe(uglify())
  .pipe(dest('js/'))
  .pipe(browserSync.stream());
};

function dist() {
  return src([
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
  .pipe(dest('dist/' + name));
};

function serve() {
  browserSync.init({
    ui: argv.ui,
    ghostMode: false,
    online: false,
    open: false,
    notify: false,
    host: BROWSERSYNC_URL,
    proxy: BROWSERSYNC_URL,
  });

  watch('sass/**/*.scss', sass);

  watch('src/**/*.js', bundle);

  watch('**/*.php').on('change', browserSync.reload);
};

const styles = series(sass, css);
const scripts = series(bundle, js);
const build = IS_PRODUCTION ? series(clean, parallel(styles, scripts), dist) : series(clean, parallel(sass, bundle));

export { clean, sass, bundle, styles, scripts, build };

export default series(build, serve);
