<?php
// Registra os menus
register_nav_menus( array(
    'main' => 'Menu Principal',
) );

/* Customiza os menus para funcionarem com o Bootstrap */
add_filter( 'nav_menu_submenu_css_class', function( $classes ) {
    $classes[] = 'dropdown-menu';

    return $classes;
}, 10, 1 );

add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {
    if ($item->menu_item_parent == 0) {
        $classes[] = 'nav-item';
    }

    if ( array_search( 'menu-item-has-children', $classes ) && $item->menu_item_parent == 0) {
        $classes[] = 'dropdown';
    }

    return $classes;
}, 10, 4);

add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
    $atts['class'] = 'nav-link';

    if ( array_search('menu-item-has-children', $item->classes ) && $item->menu_item_parent == 0 ) {
        $atts['class'] .= ' dropdown-toggle';
        $atts['role'] = 'button';
        $atts['data-bs-toggle'] = 'dropdown';
        $atts['aria-expanded'] = 'false';
    } else if ($item->menu_item_parent != 0) {
        $atts['class'] = 'dropdown-item';
    }

    if ($item->current) {
        $atts['class'] .= ' active';
    }

    return $atts;
}, 10, 4 );

/* Adiciona items automaticamente ao menu, conforme configurações das etapas atuais */
add_filter( 'wp_nav_menu_items', function( $items ) {
    $now = wp_date( 'U' );
    $now = $now - (3 * 60 * 60);

    do_action( 'qm/info', "Data e hora atual do servidor: $now" );

    $marcos_atuais = get_posts(array(
        'post_type'      => 'evento',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'nopaging'       => true,
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_key'       => array('_evento_data-inicio', '_evento_data-fim'),
        'meta_query'     => array(
            array(
                'key'     => '_evento_data-inicio',
                'compare' => '<=',
                'value'   => $now,
            ),
            array(
                'key'     => '_evento_data-fim',
                'compare' => '>=',
                'value'   => $now,
            ),
        ),
    ));

    foreach ($marcos_atuais as $marco) {
        $url = get_post_meta( $marco->ID, '_evento_programacao_url', true );
        $titulo = get_post_meta( $marco->ID, '_evento_programacao_titulo', true );

        if ($url && $titulo) {
            do_action( 'qm/info', sprintf("Etapa Programada! %s (%s)", $titulo, $url) );
            $items .= sprintf( '<li class="nav-item"><a class="nav-link destaque" href="%s">%s</a></li>', $url, $titulo );
        }
    }

    return $items;
} );
