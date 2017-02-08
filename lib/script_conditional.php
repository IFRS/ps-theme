<?php
/**
 * Adding extra data to scripts
**/
if( ! function_exists( 'wp_script_add_data' ) ) :

function wp_script_add_data( $handle, $key, $value ) {
    global $wp_scripts;
    return $wp_scripts->add_data( $handle, $key, $value );
}

endif;

// add_filter( 'script_loader_tag', function( $tag, $handle ) {
//     global $wp_scripts;
//     if( isset( $wp_scripts->registered[$handle]->extra['conditional'] ) && $wp_scripts->registered[$handle]->extra['conditional'] ) {
//         $tag = "<!--[if {$wp_scripts->registered[$handle]->extra['conditional']}]>\n" . $tag . "<![endif]-->\n";
//     }
//     return $tag;
// }, 10, 2 );
