<?php
// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);

// Add theme support for Automatic Feed Links
add_theme_support('automatic-feed-links');

// Habilita imagens destaque
add_theme_support( 'post-thumbnails' );

// Add theme support for Responsive Embeds
add_theme_support('responsive-embeds');

// Habilita títulos automáticos
add_theme_support('title-tag');

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

// Widgets
add_action('widgets_init', function() {
    register_sidebar(array(
		'name'          => 'Home Atalhos',
		'id'            => 'home_atalhos',
		'description'   => 'Atalhos na página inicial.',
		'before_widget' => '<div id="%1$s" class="col-12 col-sm-6 col-md-4 col-lg-2 widget widget-atalhos %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
	));

	register_sidebar(array(
		'name'          => 'Home Chamadas',
		'id'            => 'home_chamadas',
		'description'   => 'Chamadas na página inicial.',
		'before_widget' => '<div class="col-12 col-lg-6"><div id="%1$s" class="widget widget-chamadas %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-chamadas__title"><h2><img data-src="' . get_stylesheet_directory_uri() . '/img/home-chamadas-title.png" class="img-fluid lazyload" alt="',
		'after_title'   => '"></h2></div>',
	));
}, 10);
