import { readFileSync } from 'fs';
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

const { name: themeSlug } = JSON.parse(readFileSync('./package.json'));
const { src, dest, series, parallel, watch } = gulp;

const sassCompiler = gulpSass(dartSass);

const knownOptions = {
  string: [
    'url',
  ],
  boolean: [
    'production',
    'bundleanalyzer',
    'ui',
  ],
  alias: {
    'url': 'URL',
    'production': 'prod',
    'bundleanalyzer': ['wpba', 'ba'],
  },
  default: {
    'url': 'localhost',
    'production': false,
    'bundleanalyzer': false,
    'ui': false,
  },
};
const argv = parseArgs(process.argv.slice(2), knownOptions);

const IS_PRODUCTION = argv.production || argv.prod;

const BROWSERSYNC_URL = argv.URL || argv.url;

let webpackPlugins = [];
if (argv.bundleanalyzer) webpackPlugins.push(new BundleAnalyzer.BundleAnalyzerPlugin());

async function cleanBuild() {
  return await deleteAsync(['build/**'])
};
async function cleanDist() {
  return await deleteAsync(['dist/'])
};

function vendor() {
  return src('node_modules/animate.css/animate.css')
  .pipe(dest('build/css/'));
}

function sass() {
  let postCSS_plugins = [
    autoprefixer,
  ];

  let sass_options = {
    loadPaths: ['sass', 'node_modules'],
    style: 'expanded',
    quietDeps: true,
    silenceDeprecations: ['import'],
  };

  return src('sass/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sassCompiler.sync(sass_options).on('error', sassCompiler.logError))
  .pipe(postcss(postCSS_plugins))
  .pipe(sourcemaps.write('./'))
  .pipe(dest('build/css/'))
  .pipe(browserSync.stream());
}

function css() {
  return src('build/css/*.css')
  .pipe(csso())
  .pipe(dest('build/css/'))
  .pipe(browserSync.stream());
}

function bundle(done) {
  webpack({
    mode: IS_PRODUCTION ? 'production' : 'development',
    devtool: IS_PRODUCTION ? 'source-map' : 'eval-source-map',
    entry: {
      'ps': './src/ps.js',
      'cronograma': './src/cronograma.js',
      'chamadas': './src/chamadas.js',
      'chamada': './src/chamada.js',
      'faq': './src/faq.js',
      'admin_campi-alert': './src/admin_campi-alert.js',
      'etapas-timeline-block': './src/blocks/etapas-timeline-block.js',
      'intro-helper-block': './src/blocks/intro-helper-block.js',
      'publicacoes-list-block': './src/blocks/publicacoes-list-block.js',
    },
    output: {
      path: path.resolve(path.dirname(''), 'build/js'),
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
  return src('build/js/*.js')
  .pipe(babel({
    presets: [
      [
        '@babel/preset-env',
        {
          bugfixes: true,
          modules: false,
        },
      ],
    ],
  }))
  .pipe(uglify())
  .pipe(dest('build/js/'))
  .pipe(browserSync.stream());
}

function buildCopy() {
  return src([
    'theme/**/*',
    // 'fonts{,/**}',
    'img{,/**}',
    '!.**',
  ], { encoding: false })
  .pipe(dest('build/'))
}

function dist() {
  return src([
    'build/**/*',
    '!build/css/*.map',
    '!build/js/*.map',
  ], { encoding: false })
  .pipe(dest('dist/' + themeSlug))
}

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

  /* Watch SASS files */
  watch('sass/**/*.scss', sass)

  /* Watch JavaScript source files */
  watch('src/**/*.js', bundle)

  /* Watch theme files (hot reload) */
  watch('theme/**/*')
    .on('change', function(file) {
      return src(file, { base: 'theme' })
        .pipe(dest('build/'))
        .pipe(browserSync.stream())
    })
    .on('add', function(file) {
      return src(file, { base: 'theme' })
        .pipe(dest('build/'))
        .pipe(browserSync.stream())
    })
    .on('unlink', function(file) {
      const buildFile = file.replace(/^theme\//, 'build/')
      deleteAsync([buildFile])
    })

  /* Watch images */
  watch('img/**/*')
    .on('change', function(file) {
      return src(file, { base: '.' })
        .pipe(dest('build/'))
        .pipe(browserSync.stream())
    })
    .on('add', function(file) {
      return src(file, { base: '.' })
        .pipe(dest('build/'))
        .pipe(browserSync.stream())
    })
    .on('unlink', function(file) {
      deleteAsync([`build/${file}`])
    })

  /* Watch build directory */
  watch('build/**/*', { ignoreInitial: true, delay: 500 })
    .on('change', browserSync.reload)
}

const clean = parallel(cleanBuild, cleanDist);
const styles = series(vendor, sass, css);
const scripts = series(bundle, js);
const build = IS_PRODUCTION ? series(clean, parallel(styles, scripts), buildCopy, dist, cleanBuild) : series(clean, parallel(series(sass, vendor), bundle, buildCopy));

export { clean, sass, bundle, styles, scripts, build };

export default series(build, serve);
