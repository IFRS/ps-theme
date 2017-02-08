<?php
function ps_widgets_init() {
	register_sidebar(array(
		'name' => 'Banner Conteúdo',
		'id' => 'banner',
		'description' => 'Banner principal.',
		'before_widget' => '<!--widget--><div id="%1$s" class="widget banner %2$s">',
		'after_widget'  => '</div><!--//widget-->',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
	));
	register_sidebar(array(
		'name' => 'Home',
		'id' => 'home_1',
		'description' => 'Widget na página inicial.',
		'before_widget' => '<!--widget--><div id="%1$s" class="widget-home %2$s">',
		'after_widget'  => '</div><!--//widget-->',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'ps_widgets_init' );
