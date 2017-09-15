<?php
function ps_widgets_init() {
	register_sidebar(array(
		'name' => 'Home Atalhos',
		'id' => 'home_atalhos',
		'description' => 'Atalhos na página inicial.',
		'before_widget' => '<div id="%1$s" class="col-xs-12 col-sm-6 col-md-3 widget widget-atalhos %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
	));
	register_sidebar(array(
		'name' => 'Home Jumbo',
		'id' => 'home_jumbo',
		'description' => 'Widgets grandes na página inicial.',
		'before_widget' => '<div id="%1$s" class="col-xs-12 widget widget-jumbo %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-jumbo__title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'ps_widgets_init' );
