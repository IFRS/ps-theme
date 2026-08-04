import { defineConfig, normalizePath } from 'vite'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import { dirname, resolve } from 'path'
import { fileURLToPath } from 'url'
import { glob } from 'tinyglobby'
import vue from '@vitejs/plugin-vue'

const _root = dirname(fileURLToPath(import.meta.url))

/** Registers theme/** files with Rollup's watcher so `vite build --watch` re-copies them on change. */
function watchThemePlugin() {
  return {
    name: 'watch-theme',
    async buildStart() {
      const files = await glob('theme/**/*', { cwd: resolve(_root), absolute: true, onlyFiles: true })
      for (const file of files) {
        this.addWatchFile(file)
      }
    },
  }
}

export default defineConfig(({ mode }) => ({
  base: './', // Generate relative asset URLs so WordPress theme URI prefix from enqueue is preserved.
  resolve: {
    alias: {
      '~': resolve(_root, 'node_modules'),
      'vue': resolve(_root, 'node_modules/vue/dist/vue.esm-bundler.js'),
    },
  },
  css: {
    devSourcemap: true,
    preprocessorOptions: {
      scss: {
        sourceMap: true,
        quietDeps: true,
        silenceDeprecations: [ // Ignore deprecation warnings from dependencies, which we can't fix and which would otherwise spam the console during development.
          'import',
          'color-functions',
          'global-builtin',
        ],
      },
    },
  },
  build: {
    target: 'es2020',
    sourcemap: mode === 'development' ? true : false,
    assetsDir: 'assets',
    manifest: true,
    outDir: normalizePath(resolve(_root, 'build')),
    rollupOptions: {
      input: {
        /* Scripts */
        psScript: normalizePath(resolve(_root, 'src/ps.js')),
        cronogramaScript: normalizePath(resolve(_root, 'src/cronograma.js')),
        chamadasScript: normalizePath(resolve(_root, 'src/chamadas.js')),
        chamadaScript: normalizePath(resolve(_root, 'src/chamada.js')),
        faqScript: normalizePath(resolve(_root, 'src/faq.js')),
        adminCampiAlertScript: normalizePath(resolve(_root, 'src/admin_campi-alert.js')),
        etapasTimelineBlockScript: normalizePath(resolve(_root, 'src/blocks/etapas-timeline-block.js')),
        introHelperBlockScript: normalizePath(resolve(_root, 'src/blocks/intro-helper-block.js')),
        publicacoesListBlockScript: normalizePath(resolve(_root, 'src/blocks/publicacoes-list-block.js')),
        /* Styles */
        psStyle: normalizePath(resolve(_root, 'sass/ps.scss')),
        editorStyle: normalizePath(resolve(_root, 'sass/editor.scss')),
        // fontsStyle: normalizePath(resolve(_root, 'sass/fonts.scss')),
        vendorStyle: normalizePath(resolve(_root, 'sass/vendor.scss')),
      },
    },
  },
  plugins: [
    watchThemePlugin(),
    vue(),
    viteStaticCopy({
      structured: true,
      targets: [
        {
          src: 'theme/**/*',
          dest: '.',
          rename: { stripBase: 1 },
        },
        {
          src: 'LICENSE',
          dest: '.',
          rename: 'license.txt',
        }
      ],
      watch: {
        reloadPageOnChange: true,
      },
    }),
  ],
}))
