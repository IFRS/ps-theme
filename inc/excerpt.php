<?php
add_filter('excerpt_length', function($length) {
    return 20;
}, 999);

add_filter('excerpt_more', function($more) {
	return '&hellip;';
}, 999);

// Enable Page excerpt
add_action('init', function() {
    add_post_type_support( 'page', 'excerpt' );
}, 999);
