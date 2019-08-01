<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<button class="btn btn-menu-toggle btn-lg d-block mx-auto d-lg-none"><span class="sr-only">Esconder/Mostrar&nbsp;</span>Menu</button>
<?php
    wp_nav_menu( array(
        'theme_location'    => 'main',
        'depth'             => 2,
        'container'         => 'nav',
        'container_class'   => 'menu-navbar collapse show',
        'container_id'      => false,
        'menu_class'        => 'menu-principal nav flex-column',
    ));
?>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
