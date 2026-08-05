<?php
/* Vite Manifest */
$manifestFile = get_theme_file_path('.vite/manifest.json');

if (file_exists($manifestFile)) {
  $manifest_content = file_get_contents($manifestFile);
  $manifest = $manifest_content ? json_decode($manifest_content, true) : null;

  if (!is_array($manifest)) {
    return;
  }

  /**
   * Gutenberg Editor
   */
  add_action('enqueue_block_editor_assets', function () use ($manifest) {
    wp_enqueue_style($manifest['sass/editor.scss']['name'], get_parent_theme_file_uri($manifest['sass/editor.scss']['file']));

    wp_register_script_module($manifest['src/admin_campi-alert.js']['name'], get_parent_theme_file_uri($manifest['src/admin_campi-alert.js']['file']));

    wp_enqueue_script_module($manifest['src/blocks/etapas-timeline-block.js']['name'], get_parent_theme_file_uri($manifest['src/blocks/etapas-timeline-block.js']['file']));
    wp_enqueue_script_module($manifest['src/blocks/intro-helper-block.js']['name'], get_parent_theme_file_uri($manifest['src/blocks/intro-helper-block.js']['file']));
    wp_enqueue_script_module($manifest['src/blocks/publicacoes-list-block.js']['name'], get_parent_theme_file_uri($manifest['src/blocks/publicacoes-list-block.js']['file']));

    if (get_post_type() == 'page') {
      wp_enqueue_script_module($manifest['src/admin_campi-alert.js']['name']);
    }
  });

  /**
   * Fonts Preload
   */
  add_action('wp_head', function() use ($manifest) {
    echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( $manifest['node_modules/@fontsource-variable/open-sans/files/open-sans-latin-standard-normal.woff2']['file'] ) ) . '" as="font" type="font/woff2" crossorigin="anonymous"/>';
    // echo '<link rel="stylesheet" href="https://use.typekit.net/gug5jns.css">'; // Adobe Fonts - Degular Variable
  }, 1);

  /* Frontend Styles and Scripts */
  add_action('wp_enqueue_scripts', function () use ($manifest) {
    /**
     * Styles
     *
     * wp_register_style( string $handle, string|false $src, string[] $deps = array(), string|bool|null $ver = false, string $media ): bool
     * wp_enqueue_style( string $handle, string $src, string[] $deps = array(), string|bool|null $ver = false, string $media )
     */

    wp_enqueue_style($manifest['sass/fonts.scss']['name'], get_parent_theme_file_uri($manifest['sass/fonts.scss']['file']), array(), null, 'screen');

    wp_enqueue_style($manifest['sass/vendor.scss']['name'], get_parent_theme_file_uri($manifest['sass/vendor.scss']['file']), array(), null, 'all');

    wp_enqueue_style($manifest['sass/ps.scss']['name'], get_parent_theme_file_uri($manifest['sass/ps.scss']['file']), array($manifest['sass/vendor.scss']['name']), null, 'all');

    if (function_exists('yoast_breadcrumb')) {
      wp_add_inline_style($manifest['sass/ps.scss']['name'], ':root { --bs-breadcrumb-divider: none;');
    }

    /**
     * Scripts
     *
     * wp_register_script( string $handle, string|false $src, string[] $deps = array(), string|bool|null $ver = false, array|bool $args = array() ): bool
     * wp_enqueue_script( string $handle, string $src, string[] $deps = array(), string|bool|null $ver = false, array|bool $args = array() )
     *
     * wp_register_script_module( string $id, string $src, array $deps = array(), string|false|null $version = false, array $args = array() )
     * wp_enqueue_script_module( string $id, string $src, array $deps = array(), string|false|null $version = false, array $args = array() )
     */

    wp_enqueue_script_module($manifest['src/ps.js']['name'], get_parent_theme_file_uri($manifest['src/ps.js']['file']), array(), null, array('in_footer' => true));

    if (is_post_type_archive('evento')) {
      wp_enqueue_script_module($manifest['src/cronograma.js']['name'], get_parent_theme_file_uri($manifest['src/cronograma.js']['file']), array(), null, array('in_footer' => true));
    }

    if (is_front_page() || is_post_type_archive('chamada')) {
      wp_enqueue_script_module($manifest['src/chamadas.js']['name'], get_parent_theme_file_uri($manifest['src/chamadas.js']['file']), array(), null, array('in_footer' => true));
    }

    if (is_singular('chamada')) {
      wp_enqueue_script_module($manifest['src/chamada.js']['name'], get_parent_theme_file_uri($manifest['src/chamada.js']['file']), array(), null, array('in_footer' => true));
    }

    if (is_post_type_archive('pergunta')) {
      wp_enqueue_script_module($manifest['src/faq.js']['name'], get_parent_theme_file_uri($manifest['src/faq.js']['file']), array('jquery'), null, array('in_footer' => true));
    }

    /* Polyfill: DOM4, ES2020, ES2021, ES2022, ES2023 */
    wp_enqueue_script('polyfill', 'https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=dom4%2Ces2023%2Ces2022%2Ces2021%2Ces2020', array(), null, array('in_footer' => false, 'strategy' => 'defer', 'fetchpriority' => 'high'));
    wp_script_add_data('polyfill', 'nomodule', true);

    /* VLibras */
    if (!WP_DEBUG) {
      wp_enqueue_script('vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, array('in_footer' => true, 'strategy' => 'defer', 'fetchpriority' => 'low'));
      wp_add_inline_script(
        'vlibras',
        "
          document.addEventListener('DOMContentLoaded', function() {
            if (window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app');
          });
        "
      );
    }
  }, 1);
}
