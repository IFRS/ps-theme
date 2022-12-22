<?php
    add_filter( 'wp_nav_menu_items', function( $items ) {
        $now = time() - (3 * 60 * 60);

        $inscricao_url = cmb2_get_option( 'programacao_options', 'inscricao_url' );
        $inscricao_inicio = cmb2_get_option( 'programacao_options', 'inscricao_inicio' );
        $inscricao_fim = cmb2_get_option( 'programacao_options', 'inscricao_fim' );

        $matricula_url = cmb2_get_option( 'programacao_options', 'matricula_url' );
        $matricula_inicio = cmb2_get_option( 'programacao_options', 'matricula_inicio' );
        $matricula_fim = cmb2_get_option( 'programacao_options', 'matrio$matricula_fim' );

        if ($inscricao_url && $now >= $inscricao_inicio && $now <= $inscricao_fim) {
            $items .= '<li class="nav-item"><a class="nav-link" href="' . $inscricao_url . '">Inscri&ccedil;&otilde;es</a></li>';
        }

        if ($matricula_url && $now >= $matricula_inicio && $now <= $matricula_fim) {
            $items .= '<li class="nav-item"><a class="nav-link" href="' . $matricula_url . '">Inscri&ccedil;&otilde;es</a></li>';
        }

        return $items;
    } );
?>

<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<?php
    wp_nav_menu( array(
        'menu_class'           => 'menu-principal navbar-nav flex-wrap mx-auto mb-2 mb-lg-0',
        'menu_id'              => '',
        'container'            => 'nav',
        'container_class'      => 'navbar navbar-expand navbar-light',
        'container_id'         => '',
        'container_aria_label' => 'Navegação Principal',
        'depth'                => 2,
        'theme_location'       => 'main',
    ));
?>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
