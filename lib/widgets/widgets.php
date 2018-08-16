<?php
function ps_widgets_init() {
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
		'before_widget' => '<div id="%1$s" class="col-12 col-md-7 offset-md-5 col-lg-6 offset-lg-6 col-xl-6 offset-xl-6 widget widget-chamadas %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-chamadas__title"><h2><strong>',
		'after_title'   => '</strong></h2></div>',
	));
}

add_action( 'widgets_init', 'ps_widgets_init' );
