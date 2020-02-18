<?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '-', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && is_front_page() ) {
        echo ' - ' . $site_description;
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        echo ' - ' . sprintf( 'Página %s', max( $paged, $page ) );
    }
