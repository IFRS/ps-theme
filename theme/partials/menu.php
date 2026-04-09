<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<nav class="menu">
  <?php
  $menu_ID = uniqid('menu-');
  $container_ID = uniqid('container-');
  wp_nav_menu(array(
    'menu_class'           => 'menu-principal',
    'menu_id'              => $menu_ID,
    'container'            => 'div',
    'container_class'      => 'container',
    'container_id'         => $container_ID,
    'container_aria_label' => 'Navegação Principal',
    'depth'                => 2,
    'theme_location'       => 'main',
  ));
  ?>
</nav>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
