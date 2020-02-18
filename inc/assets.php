<?php
add_action( 'wp_enqueue_scripts', function() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    if (!is_admin()) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
    }

    wp_enqueue_style('css-vendor', get_stylesheet_directory_uri().'/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');

    wp_enqueue_style('css-ps', get_stylesheet_directory_uri().'/css/ps.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/ps.css'), 'all');
}, 1 );

add_action( 'wp_enqueue_scripts', function() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script('js-commons', get_template_directory_uri().'/js/commons.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/commons.js'), true);

    wp_enqueue_script( 'js-ie', get_template_directory_uri().'/js/ie.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ie.js'), false );
    wp_script_add_data( 'js-ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script('js-ps', get_template_directory_uri().'/js/ps.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ps.js'), true);

    if (is_post_type_archive( 'curso' ) || is_tax('modalidade')) {
        wp_enqueue_script('js-cursos', get_template_directory_uri().'/js/cursos.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/cursos.js'), true);
    }

    if (!WP_DEBUG) {
        add_action('wp_head', function() {
            echo '<link rel="preconnect" href="https://barra.brasil.gov.br">';
            echo '<link rel="preconnect" href="https://vlibras.gov.br">';
        }, 0);
        wp_enqueue_script( 'js-barra-brasil', 'https://barra.brasil.gov.br/barra.js', array(), null, true );
    }
}, 1 );
