<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<div class="menu-wrapper">
    <?php
        $menu_ID = uniqid('menu-');
        $container_ID = uniqid('container-');
        wp_nav_menu( array(
            'menu_class'           => 'menu-principal',
            'menu_id'              => $menu_ID,
            'container'            => 'nav',
            'container_class'      => 'container',
            'container_id'         => $container_ID,
            'container_aria_label' => 'Navegação Principal',
            'depth'                => 2,
            'theme_location'       => 'main',
        ));
    ?>
</div>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
