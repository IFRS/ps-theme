<?php
add_action( 'wp_enqueue_scripts', function() {
    /**
     * Styles
     */
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    // wp_enqueue_style('animate', get_stylesheet_directory_uri().'/css/animate.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/animate.css'), 'all');

    wp_enqueue_style('vendor', get_stylesheet_directory_uri().'/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');

    wp_enqueue_style('ps', get_stylesheet_directory_uri().'/css/ps.css', array('vendor'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/ps.css'), 'all');

    if ( function_exists('yoast_breadcrumb') ) {
        wp_add_inline_style( 'ps', ':root { --bs-breadcrumb-divider: none;' );
    }

    /**
     * Scripts
     */
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    $has_commons = file_exists(get_template_directory().'/js/commons.js');
    $commons_deps = $has_commons ? array('commons') : array();

    if ($has_commons) {
        wp_enqueue_script('commons', get_template_directory_uri().'/js/commons.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/commons.js'), true);
    }

    wp_enqueue_script('ps', get_template_directory_uri().'/js/ps.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ps.js'), true);

    if (is_post_type_archive( 'evento' )) {
        wp_enqueue_script('cronograma', get_template_directory_uri().'/js/cronograma.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/cronograma.js'), true);
        wp_add_inline_script('cronograma', "const WP_API = '" . esc_url(get_rest_url(get_current_blog_id())) . "';", 'before');
    }

    if (is_front_page() || is_post_type_archive('chamada')) {
        wp_enqueue_script('chamadas', get_template_directory_uri().'/js/chamadas.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/chamadas.js'), true);
        wp_add_inline_script('chamadas', "const WP_API = '" . esc_url(get_rest_url(get_current_blog_id())) . "';", 'before');
    }

    if (is_singular( 'chamada' )) {
        wp_enqueue_script('chamada', get_template_directory_uri().'/js/chamada.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/chamada.js'), true);
    }

    if (is_post_type_archive( 'pergunta' ) ) {
        wp_enqueue_script('faq', get_template_directory_uri().'/js/faq.js', array_merge($commons_deps, array('jquery')), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/faq.js'), true);
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, true );
        wp_add_inline_script( 'vlibras',
            "
                document.addEventListener('DOMContentLoaded', function() {
                    if (window.VLibras) new window.VLibras.Widget('https://vlibras.gov.br/app');
                });
            "
        );
    }
}, 99 );

add_filter( 'script_loader_tag', function($tag, $handle) {
    $scripts_to_defer = array('vlibras');
    $scripts_to_async = array();

    foreach ($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }

    foreach ($scripts_to_async as $async_script) {
        if ($async_script === $handle) {
            return str_replace(' src', ' async="async" src', $tag);
        }
    }

    return $tag;
}, 99, 2 );

/* Gutenberg Assets */

add_action( 'enqueue_block_editor_assets', function() {
    $editor_style = get_stylesheet_directory() . '/css/editor.css';
    $admin_campi_alert = get_stylesheet_directory() . '/js/admin_campi-alert.js';
    $etapas_timeline_block = get_stylesheet_directory() . '/js/etapas-timeline-block.js';
    $intro_helper_block = get_stylesheet_directory() . '/js/intro-helper-block.js';

    if (file_exists($editor_style)) {
        wp_enqueue_style(
            'ps-editor',
            get_template_directory_uri() . '/css/editor.css',
            array(),
            WP_DEBUG ? null : filemtime($editor_style),
            'all'
        );
    }

    if (file_exists($admin_campi_alert) && get_post_type() == 'page') {
        wp_enqueue_script(
            'ps-admin-notices',
            get_template_directory_uri() . '/js/admin_campi-alert.js',
            array( 'wp-blocks', 'wp-block-editor' ),
            WP_DEBUG ? null : filemtime($admin_campi_alert),
            true
        );
    }

    if (file_exists($etapas_timeline_block)) {
        wp_enqueue_script(
            'ps-etapas-timeline-block',
            get_template_directory_uri() . '/js/etapas-timeline-block.js',
            array('wp-blocks', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-i18n', 'wp-server-side-render'),
            WP_DEBUG ? null : filemtime($etapas_timeline_block),
            true
        );
    }

    if (file_exists($intro_helper_block)) {
        $terms = get_terms(array(
            'taxonomy'   => 'modalidade',
            'hide_empty' => false,
        ));

        if (is_wp_error($terms)) {
            $terms = array();
        }

        $modalidades = array_map(function($term) {
            return array(
                'slug' => $term->slug,
                'name' => $term->name,
            );
        }, $terms);

        wp_enqueue_script(
            'ps-intro-helper-block',
            get_template_directory_uri() . '/js/intro-helper-block.js',
            array('wp-blocks', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-i18n'),
            WP_DEBUG ? null : filemtime($intro_helper_block),
            true
        );

        wp_add_inline_script(
            'ps-intro-helper-block',
            'window.ifrsPsModalidadesTerms = ' . wp_json_encode($modalidades) . ';',
            'before'
        );
    }
}, 99 );
