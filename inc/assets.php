<?php
add_action( 'wp_enqueue_scripts', function() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    if (!is_admin()) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
    }

    wp_enqueue_style('vendor', get_stylesheet_directory_uri().'/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');

    wp_enqueue_style('ps', get_stylesheet_directory_uri().'/css/ps.css', array('vendor'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/ps.css'), 'all');
}, 1 );

add_action( 'wp_enqueue_scripts', function() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    wp_enqueue_script( 'ie', get_template_directory_uri().'/js/ie.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ie.js'), false );
    wp_script_add_data( 'ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script('commons', get_template_directory_uri().'/js/commons.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/commons.js'), true);

    wp_enqueue_script('ps', get_template_directory_uri().'/js/ps.js', array('commons'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ps.js'), true);

    if (is_post_type_archive( 'curso' ) || is_tax('modalidade')) {
        wp_enqueue_script('cursos', get_template_directory_uri().'/js/cursos.js', array('commons'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/cursos.js'), true);
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'barra-brasil', 'https://barra.brasil.gov.br/barra.js', array(), null, true );
    }
}, 1 );

add_filter('script_loader_tag', function($tag, $handle) {
    $scripts_to_defer = array('barra-brasil');
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
}, 2, 2);
