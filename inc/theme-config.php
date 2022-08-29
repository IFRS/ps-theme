<?php
// Content Width
if ( ! isset( $content_width ) ) $content_width = 1296;

// Remove some Gutenberg custom options
add_theme_support( 'editor-color-palette' );
add_theme_support( 'editor-gradient-presets' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'disable-custom-gradients' );
add_theme_support( 'disable-custom-font-sizes' );
add_theme_support( 'custom-units', array() );

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

// Habilita a personalização de cabeçalho
add_theme_support('custom-header', array(
    'default-image'          => get_stylesheet_directory_uri() . '/img/header-ps.png',
    'width'                  => 1140,
    'height'                 => 350,
    'flex-height'            => true,
    'flex-width'             => false,
    'uploads'                => true,
    'random-default'         => false,
    'header-text'            => false,
    'default-text-color'     => '',
    'wp-head-callback'       => '',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
));

// Starter Content
add_theme_support('starter_content',array(
    'posts' => array(
        'home' => array(
            'post_title'   => 'Página Inicial',
            'post_content' => '',
            'menu_order'   => 0,
        ),
        'blog' => array(
            'post_title'   => 'Todos os Avisos',
            'post_content' => '',
            'menu_order'   => 1,
        ),
    ),
    'options' => array(
        'show_on_front'  => 'page',
        'page_on_front'  => '{{home}}',
        'page_for_posts' => '{{blog}}',
        'posts_per_page' => 12,
    ),
));

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
}, 10);
