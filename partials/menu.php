<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<!-- <button class="btn btn-menu-toggle btn-lg d-block mx-auto d-md-none">
<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="arcs"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    <span class="sr-only">Esconder/Mostrar&nbsp;</span>
    Menu
</button> -->
<?php
    wp_nav_menu( array(
        'theme_location'    => 'main',
        'depth'             => 2,
        'container'         => 'nav',
        'container_class'   => 'menu-navbar',
        'container_id'      => false,
        'menu_class'        => 'menu-principal nav',
    ));
?>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
