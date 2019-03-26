<?php
function ps_load_styles() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    wp_enqueue_style('css-ps', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/ps.css' : '/css/ps.min.css'), array(), false, 'all');
}

function ps_load_scripts() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script( 'js-ie', get_template_directory_uri().(WP_DEBUG ? '/js/ie.js' : '/js/ie.min.js'), array(), null, false );
    wp_script_add_data( 'js-ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script('js-ps', get_template_directory_uri().(WP_DEBUG ? '/js/ps.js' : '/js/ps.min.js'), array(), null, true);

    if (is_post_type_archive( 'curso' ) || is_tax('modalidade')) {
        wp_enqueue_script('js-cursos', get_template_directory_uri().(WP_DEBUG ? '/js/cursos.js' : '/js/cursos.min.js'), array(), null, true);
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'js-barra-brasil', '//barra.brasil.gov.br/barra.js', array(), null, true );
    }
}

add_action( 'wp_enqueue_scripts', 'ps_load_styles', 1 );
add_action( 'wp_enqueue_scripts', 'ps_load_scripts', 1 );
