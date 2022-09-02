<?php
// Content Width
if ( ! isset( $content_width ) ) $content_width = 1296;

// Remove some Gutenberg custom options
add_theme_support( 'custom-units', array() );
add_theme_support( 'editor-color-palette', array() );
add_theme_support( 'editor-gradient-presets', array() );
add_theme_support( 'editor-font-sizes', array() );
add_theme_support( 'disable-custom-font-sizes', true );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'disable-custom-gradients' );
// add_theme_support( 'disable-layout-styles' );

// Gutenberg Default Theme Styles
add_theme_support( 'wp-block-styles' );

// Add theme support for Automatic Feed Links
add_theme_support('automatic-feed-links');

// Add theme support for Featured Images
add_theme_support( 'post-thumbnails' );

// Add theme support for HTML5 Semantic Markup
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );

// Add theme support for Responsive Embeds
add_theme_support( 'responsive-embeds' );

// Add theme support for document <title> tag
add_theme_support( 'title-tag' );

// Media Sizes (from Bootstrap 5)
add_image_size( 'xs', 576, 576 );
add_image_size( 'sm', 768, 768 );
add_image_size( 'md', 992, 992 );
add_image_size( 'lg', 1200, 1200 );

// Media Sizes for content (medium_large is 768px by default)
add_action( 'after_switch_theme', function() {
    update_option( 'thumbnail_size_w', 320 );
    update_option( 'thumbnail_size_h', 320 );
    update_option( 'thumbnail_crop', 0 );

    update_option( 'medium_size_w', 516 );
    update_option( 'medium_size_h', 516 );

    update_option( 'large_size_w', 936 );
    update_option( 'large_size_h', 936 );
} );

// Enable Custom Logo
add_theme_support( 'custom-logo', array(
    'height'               => 400,
    'width'                => 720,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array(),
    'unlink-homepage-logo' => false,
) );

// Enable Custom Header Image
add_theme_support( 'custom-header', array(
    'default-image'          => '',
    'width'                  => 1920,
    'height'                 => 600,
    'flex-height'            => true,
    'flex-width'             => false,
    'uploads'                => true,
    'random-default'         => false,
    'header-text'            => false,
    'default-text-color'     => '',
) );

// Widgets
add_action('widgets_init', function() {
    // register_sidebar(array(
    //     'name'          => 'Home Atalhos',
    //     'id'            => 'home_atalhos',
    //     'description'   => 'Atalhos na página inicial.',
    //     'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-md-4 col-lg-2 widget widget-atalhos %2$s">',
    //     'after_widget'  => '</div>',
    //     'before_title'  => '<span class="visually-hidden">',
    //     'after_title'   => '</span>',
    // ));

    register_sidebar(array(
        'name'          => 'Home Ajuda',
        'id'            => 'home_ajuda',
        'description'   => 'Área de ajuda na página inicial.',
        'before_widget' => '<div id="%1$s" class="home-ajuda__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="visually-hidden">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'           => 'Contato',
        'id'             => 'contato',
        'description'    => 'Área de contato no rodapé das páginas.',
        'before_widget'  => '<div id="%1$s" class="%2$s">',
        'after_widget'   => '</div>',
        'before_title'   => '<h3 class="visually-hidden">',
        'after_title'    => '</h3>',
        'before_sidebar' => '<address id="%1$s" class="contato %2$s">',
        'after_sidebar'  => '</address>',
    ));
} );

// Starter Content
add_action( 'after_setup_theme',function() {
    add_theme_support('starter_content', array(
        'posts' => array(
            'home' => array(
                'post_title'   => 'Página Inicial',
                'post_content' => '',
                'menu_order'   => 0,
            ),
            'avisos' => array(
                'post_title'   => 'Todos os Avisos',
                'post_content' => '',
                'menu_order'   => 1,
            ),
        ),
        'options' => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{avisos}}',
            'posts_per_page' => 12,
        ),
    ));
} );
