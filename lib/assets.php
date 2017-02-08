<?php
function load_styles_ps() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    if (WP_DEBUG) {
        wp_enqueue_style('css-ps', get_stylesheet_directory_uri().'/css/ps-style.css', array(), false, 'all');
        wp_enqueue_style( 'css-prettyPhoto', get_stylesheet_directory_uri().'/vendor/prettyPhoto/css/prettyPhoto.css', array(), false, 'screen' );
        wp_register_style( 'css-dataTables', get_stylesheet_directory_uri().'/vendor/datatables/media/css/jquery.dataTables.css', array(), false, 'screen' );
        wp_register_style( 'css-dataTables-bootstrap', get_stylesheet_directory_uri().'/vendor/datatables/media/css/dataTables.bootstrap.css', array(), false, 'screen' );

    } else {
        wp_enqueue_style('css-ps', get_stylesheet_directory_uri().'/css/ps-style.min.css', array(), false, 'all');
        wp_enqueue_style( 'css-prettyPhoto', get_stylesheet_directory_uri().'/vendor/prettyPhoto/css/prettyPhoto.css', array(), false, 'screen' );
        wp_register_style( 'css-dataTables', get_stylesheet_directory_uri().'/vendor/datatables/media/css/jquery.dataTables.min.css', array(), false, 'screen' );
        wp_register_style( 'css-dataTables-bootstrap', get_stylesheet_directory_uri().'/vendor/datatables/media/css/dataTables.bootstrap.min.css', array(), false, 'screen' );
    }

    if (is_post_type_archive( 'curso' ) || is_tax( 'campus' ) || is_tax( 'modalidade' )) {
        // wp_enqueue_style('css-dataTables');
        wp_enqueue_style('css-dataTables-bootstrap');
    }
}

function load_scripts_ps() {
    if ( ! is_admin() ) {
        wp_deregister_script('jquery');
    }

    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */

    if (WP_DEBUG) {
        wp_enqueue_script( 'html5shiv', get_stylesheet_directory_uri().'/vendor/html5shiv/dist/html5shiv.js', array(), false, false );
        wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'html5shiv-print', get_stylesheet_directory_uri().'/vendor/html5shiv/dist/html5shiv-printshiv.js', array(), false, false );
        wp_script_add_data( 'html5shiv-print', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'respond', get_stylesheet_directory_uri().'/vendor/respond-minmax/dest/respond.src.js', array(), false, false );
        wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'respond-matchmedia', get_stylesheet_directory_uri().'/vendor/respond-minmax/dest/respond.matchmedia.addListener.src.js', array(), false, false );
        wp_script_add_data( 'respond-matchmedia', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri().'/js/modernizr.min.js', array(), false, false );

        wp_enqueue_script( 'jquery', get_stylesheet_directory_uri().'/vendor/jquery/dist/jquery.js', array(), false, false );
        wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri().'/vendor/bootstrap-sass/assets/javascripts/bootstrap.js', array('jquery'), false, false );
        wp_enqueue_script( 'bootstrap-accessibility', get_stylesheet_directory_uri().'/vendor/bootstrapaccessibilityplugin/plugins/js/bootstrap-accessibility.js', array('bootstrap'), false, false );

        wp_enqueue_script( 'jquery-prettyPhoto', get_stylesheet_directory_uri().'/vendor/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), false, true );
        wp_enqueue_script('prettyPhoto-config', get_stylesheet_directory_uri().'/src/prettyPhoto-config.js', array(), false, true);

        wp_register_script( 'jquery-dataTables', get_stylesheet_directory_uri().'/vendor/datatables/media/js/jquery.dataTables.js', array('jquery'), false, true );
        wp_register_script( 'jquery-dataTables-bootstrap', get_stylesheet_directory_uri().'/vendor/datatables/media/js/dataTables.bootstrap.js', array('jquery','jquery-dataTables'), false, true );
        wp_register_script( 'dataTables-pt_BR', get_stylesheet_directory_uri().'/src/dataTables-pt_BR.js', array('jquery', 'jquery-dataTables'), false, true );

        wp_register_script( 'cursos-tab-from-url', get_stylesheet_directory_uri().'/src/cursos-tab-from-url.js', array('jquery', 'bootstrap'), false, true );

        wp_enqueue_script('jquery-flex-vertical', get_stylesheet_directory_uri().'/vendor/jQuery-Flex-Vertical-Center/jquery.flexverticalcenter.js', array('jquery'), false, true);
        wp_enqueue_script('vertical-align', get_stylesheet_directory_uri().'/src/vertical-align.js', array('jquery-flex-vertical'), false, true);

        wp_register_script( 'masonry-custom', get_template_directory_uri().'/vendor/masonry/dist/masonry.pkgd.js', array(), false, true );
        wp_register_script( 'masonry-config', get_template_directory_uri().'/src/masonry-config.js', array('masonry-custom'), false, true );

        wp_register_script( 'faq-collapse', get_template_directory_uri().'/src/faq-collapse.js', array('jquery', 'bootstrap'), false, true );
    } else {
        wp_enqueue_script( 'html5shiv', get_stylesheet_directory_uri().'/vendor/html5shiv/dist/html5shiv.min.js', array(), false, false );
        wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'html5shiv-print', get_stylesheet_directory_uri().'/vendor/html5shiv/dist/html5shiv-printshiv.min.js', array(), false, false );
        wp_script_add_data( 'html5shiv-print', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'respond', get_stylesheet_directory_uri().'/vendor/respond-minmax/dest/respond.min.js', array(), false, false );
        wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'respond-matchmedia', get_stylesheet_directory_uri().'/vendor/respond-minmax/dest/respond.matchmedia.addListener.min.js', array(), false, false );
        wp_script_add_data( 'respond-matchmedia', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri().'/js/modernizr.min.js', array(), false, false );

        wp_enqueue_script( 'jquery', get_stylesheet_directory_uri().'/vendor/jquery/dist/jquery.min.js', array(), false, false );
        wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri().'/vendor/bootstrap-sass/assets/javascripts/bootstrap.min.js', array('jquery'), false, false );
        wp_enqueue_script( 'bootstrap-accessibility', get_stylesheet_directory_uri().'/vendor/bootstrapaccessibilityplugin/plugins/js/bootstrap-accessibility.min.js', array('bootstrap'), false, false );

        wp_enqueue_script( 'jquery-prettyPhoto', get_stylesheet_directory_uri().'/vendor/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), false, true );
        wp_enqueue_script('prettyPhoto-config', get_stylesheet_directory_uri().'/js/prettyPhoto-config.min.js', array(), false, true);

        wp_register_script( 'jquery-dataTables', get_stylesheet_directory_uri().'/vendor/datatables/media/js/jquery.dataTables.min.js', array('jquery'), false, true );
        wp_register_script( 'jquery-dataTables-bootstrap', get_stylesheet_directory_uri().'/vendor/datatables/media/js/dataTables.bootstrap.min.js', array('jquery','jquery-dataTables'), false, true );
        wp_register_script( 'dataTables-pt_BR', get_stylesheet_directory_uri().'/js/dataTables-pt_BR.min.js', array('jquery', 'jquery-dataTables'), false, true );

        wp_register_script( 'cursos-tab-from-url', get_stylesheet_directory_uri().'/js/cursos-tab-from-url.min.js', array('jquery', 'bootstrap'), false, true );

        wp_enqueue_script('jquery-flex-vertical', get_stylesheet_directory_uri().'/vendor/jQuery-Flex-Vertical-Center/jquery.flexverticalcenter.js', array('jquery'), false, true);
        wp_enqueue_script('vertical-align', get_stylesheet_directory_uri().'/js/vertical-align.min.js', array('jquery-flex-vertical'), false, true);

        wp_register_script( 'masonry-custom', get_template_directory_uri().'/vendor/masonry/dist/masonry.pkgd.min.js', array(), false, true );
        wp_register_script( 'masonry-config', get_template_directory_uri().'/js/masonry-config.min.js', array('masonry-custom'), false, true );

        wp_register_script( 'faq-collapse', get_template_directory_uri().'/js/faq-collapse.min.js', array('jquery', 'bootstrap'), false, true );

        wp_enqueue_script( 'js-barra-brasil', '//barra.brasil.gov.br/barra.js', array(), false, true );
    }

    if (is_post_type_archive( 'curso' ) || is_tax( 'campus' ) || is_tax( 'modalidade' )) {
        wp_enqueue_script('jquery-dataTables');
        wp_enqueue_script('jquery-dataTables-bootstrap');
        wp_enqueue_script('dataTables-pt_BR');

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

add_action( 'wp_enqueue_scripts', 'load_styles_ps', 1 );
add_action( 'wp_enqueue_scripts', 'load_scripts_ps', 1 );
