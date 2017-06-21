<?php
function ps_load_styles() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    wp_enqueue_style('css-ps', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/ps-style.css' : '/css/ps-style.min.css'), array(), false, 'all');

    wp_enqueue_style( 'css-fancybox', get_stylesheet_directory_uri().'/vendor/fancybox/source/jquery.fancybox.css', array(), false, 'screen' );

    wp_register_style( 'css-datatables', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/datatables/media/css/jquery.dataTables.css' : '/vendor/datatables/media/css/jquery.dataTables.min.css'), array(), false, 'screen' );

    wp_register_style( 'css-datatables-bootstrap', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/datatables/media/css/dataTables.bootstrap.css' : '/vendor/datatables/media/css/dataTables.bootstrap.min.css'), array(), false, 'screen' );

    if (is_post_type_archive( 'curso' ) || is_tax( 'campus' ) || is_tax( 'modalidade' )) {
        wp_enqueue_style('css-datatables-bootstrap');
    }
}

function ps_load_scripts() {
    if ( ! is_admin() ) {
        wp_deregister_script('jquery');
    }

    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */

    wp_enqueue_script( 'html5shiv', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/html5shiv/dist/html5shiv.js' : '/vendor/html5shiv/dist/html5shiv.min.js'), array(), false, false );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'html5shiv-print', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/html5shiv/dist/html5shiv-printshiv.js' : '/vendor/html5shiv/dist/html5shiv-printshiv.min.js'), array(), false, false );
    wp_script_add_data( 'html5shiv-print', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'respond', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/respond/dest/respond.src.js' : '/vendor/respond/dest/respond.min.js'), array(), false, false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'respond-matchmedia', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/respond/dest/respond.matchmedia.addListener.src.js' : '/vendor/respond/dest/respond.matchmedia.addListener.min.js'), array(), false, false );
    wp_script_add_data( 'respond-matchmedia', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri().'/js/modernizr.min.js', array(), false, false );

    wp_enqueue_script( 'jquery', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/jquery/dist/jquery.js' : '/vendor/jquery/dist/jquery.min.js'), array(), false, false );

    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/bootstrap-sass/assets/javascripts/bootstrap.js' : '/vendor/bootstrap-sass/assets/javascripts/bootstrap.min.js'), array('jquery'), false, false );

    wp_enqueue_script( 'bootstrap-accessibility', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/bootstrapaccessibilityplugin/plugins/js/bootstrap-accessibility.js' : '/vendor/bootstrapaccessibilityplugin/plugins/js/bootstrap-accessibility.min.js'), array('bootstrap'), false, false );

    wp_enqueue_script( 'jquery-fancybox', get_stylesheet_directory_uri().'/vendor/fancybox/source/jquery.fancybox.pack.js', array('jquery'), false, true );
    wp_enqueue_script('fancybox-config', get_stylesheet_directory_uri().(WP_DEBUG ? '/src/fancybox-config.js' : '/js/fancybox-config.min.js'), array('jquery-fancybox'), false, true);

    wp_register_script( 'jquery-datatables', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/datatables/media/js/jquery.dataTables.js' : '/vendor/datatables/media/js/jquery.dataTables.min.js'), array('jquery'), false, true );
    wp_register_script( 'jquery-datatables-bootstrap', get_stylesheet_directory_uri().(WP_DEBUG ? '/vendor/datatables/media/js/dataTables.bootstrap.js' : '/vendor/datatables/media/js/dataTables.bootstrap.min.js'), array('jquery','jquery-dataTables'), false, true );
    wp_register_script( 'datatables-pt_BR', get_stylesheet_directory_uri().(WP_DEBUG ? '/src/dataTables-pt_BR.js' : '/js/dataTables-pt_BR.min.js'), array('jquery', 'jquery-datatables'), false, true );

    wp_register_script( 'masonry-custom', get_template_directory_uri().(WP_DEBUG ? '/vendor/masonry/dist/masonry.pkgd.js' : '/vendor/masonry/dist/masonry.pkgd.min.js'), array(), false, true );
    wp_register_script( 'masonry-config', get_template_directory_uri().(WP_DEBUG ? '/src/masonry-config.js' : '/js/masonry-config.min.js'), array('masonry-custom'), false, true );

    wp_register_script( 'faq-collapse', get_template_directory_uri().(WP_DEBUG ? '/src/faq-collapse.js' : '/js/faq-collapse.min.js'), array('jquery', 'bootstrap'), false, true );

    wp_register_script( 'cursos-tab-from-url', get_stylesheet_directory_uri().(WP_DEBUG ? '/src/cursos-tab-from-url.js' : '/js/cursos-tab-from-url.min.js'), array('jquery', 'bootstrap'), false, true );

    if (!WP_DEBUG) wp_enqueue_script( 'js-barra-brasil', '//barra.brasil.gov.br/barra.js', array(), false, true );

    if (is_post_type_archive( 'curso' ) || is_tax( 'campus' ) || is_tax( 'modalidade' )) {
        wp_enqueue_script('jquery-datatables');
        wp_enqueue_script('jquery-datatables-bootstrap');
        wp_enqueue_script('datatables-pt_BR');

        wp_enqueue_script('cursos-tab-from-url');
    }

    if (is_home() || is_category()) {
        wp_enqueue_script('masonry-custom');
        wp_enqueue_script('masonry-config');
    }

    if (is_category('faq')) {
        wp_enqueue_script('faq-collapse');
    }
}

add_action( 'wp_enqueue_scripts', 'ps_load_styles', 1 );
add_action( 'wp_enqueue_scripts', 'ps_load_scripts', 1 );
