<?php
add_action( 'init', 'ps_add_excerpts_to_pages' );
function ps_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}
