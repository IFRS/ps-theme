<?php
add_action('init', function() {
    add_post_type_support( 'page', 'excerpt' );
});
