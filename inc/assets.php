<?php
add_action( 'wp_enqueue_scripts', function() {
    /**
     * Styles
     */
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('vendor', get_stylesheet_directory_uri().'/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');

    wp_enqueue_style('ps', get_stylesheet_directory_uri().'/css/ps.css', array('vendor'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/ps.css'), 'all');

    /**
     * Scripts
     */
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    $has_commons = file_exists(get_template_directory_uri().'/js/commons.js');
    $commons_deps = $has_commons ? array('commons') : array();

    if ($has_commons) {
        wp_enqueue_script('commons', get_template_directory_uri().'/js/commons.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/commons.js'), true);
    }

    wp_enqueue_script('ps', get_template_directory_uri().'/js/ps.js', array_merge($commons_deps, array('jquery')), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ps.js'), true);

    if (is_post_type_archive( 'curso' ) || is_tax('modalidade')) {
        wp_enqueue_script('cursos', get_template_directory_uri().'/js/cursos.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/cursos.js'), true);
    }

    if (is_post_type_archive( 'evento' )) {
        wp_enqueue_script('cronograma', get_template_directory_uri().'/js/cronograma.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/cronograma.js'), true);
    }

    if (is_singular( 'chamada' )) {
        wp_enqueue_script('chamada', get_template_directory_uri().'/js/chamada.js', array_merge($commons_deps, array()), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/chamada.js'), true);
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

add_filter('script_loader_tag', function($tag, $handle) {
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
}, 99, 2);
