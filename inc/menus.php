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

/* Adiciona items automaticamente ao menu, conforme configurações */
add_filter( 'wp_nav_menu_items', function( $items ) {
    $now = time() - (3 * 60 * 60); // Hora atual em UTC-3

    do_action( 'qm/info', "Data atual do servidor: $now" );

    $inscricao_url = cmb2_get_option( 'programacao_options', 'inscricao_url' );
    $inscricao_inicio = cmb2_get_option( 'programacao_options', 'inscricao_inicio' );
    $inscricao_fim = cmb2_get_option( 'programacao_options', 'inscricao_fim' );

    if ($inscricao_url && $inscricao_inicio && $inscricao_fim) do_action( 'qm/info', "Inscrição Programada! URL: $inscricao_url / Início: $inscricao_inicio / Fim: $inscricao_fim" );

    $matricula_url = cmb2_get_option( 'programacao_options', 'matricula_url' );
    $matricula_inicio = cmb2_get_option( 'programacao_options', 'matricula_inicio' );
    $matricula_fim = cmb2_get_option( 'programacao_options', 'matricula_fim' );

    if ($matricula_url && $matricula_inicio && $matricula_fim) do_action( 'qm/info', "Matrícula Programada! URL: $matricula_url / Início: $matricula_inicio / Fim: $matricula_fim" );

    if ($inscricao_url && $now > $inscricao_inicio && $now < $inscricao_fim) {
        $items .= '<li class="nav-item"><a class="nav-link" href="' . $inscricao_url . '">Inscri&ccedil;&otilde;es</a></li>';
    }

    if ($matricula_url && $now > $matricula_inicio && $now < $matricula_fim) {
        $items .= '<li class="nav-item"><a class="nav-link" href="' . $matricula_url . '">Matr&iacute;culas</a></li>';
    }

    return $items;
} );
