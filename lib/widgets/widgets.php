<?php
function ps_widgets_init() {
	register_sidebar(array(
		'name'          => 'Home Chamadas',
		'id'            => 'home_chamadas',
		'description'   => 'Chamadas na página inicial.',
		'before_widget' => '<div id="%1$s" class="col-12 col-lg-6 col-lg-offset-5 col-xl-6 col-xl-offset-5 widget widget-chamadas %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-chamadas__title"><h2><strong>',
		'after_title'   => '</strong></h2></div>',
	));
	register_sidebar(array(
		'name'          => 'Home Atalhos',
		'id'            => 'home_atalhos',
		'description'   => 'Atalhos na página inicial.',
		'before_widget' => '<div id="%1$s" class="col-12 col-md-6 col-lg-3 widget widget-atalhos %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
	));
	register_sidebar(array(
		'name'          => 'Home Jumbo',
		'id'            => 'home_jumbo',
		'description'   => 'Widgets grandes na página inicial.',
		'before_widget' => '<div id="%1$s" class="col-12 widget widget-jumbo %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-jumbo__title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'ps_widgets_init' );
