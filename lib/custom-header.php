<?php
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
