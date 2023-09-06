<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<?php $collapse_ID = uniqid('collapse-'); ?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_ID; ?>" aria-controls="<?php echo $collapse_ID; ?>" aria-expanded="false" aria-label="Alternar Menu Principal">
        <span class="navbar-toggler-icon"></span>&nbsp;Menu
        </button>
        <?php
            wp_nav_menu( array(
                'menu_class'           => 'menu-principal navbar-nav flex-wrap mx-auto mb-2 mb-lg-0',
                'menu_id'              => '',
                // 'container'            => 'nav',
                // 'container_class'      => 'navbar navbar-expand-lg navbar-light',
                'container'            => 'div',
                'container_class'      => 'collapse navbar-collapse',
                'container_id'         => $collapse_ID,
                'container_aria_label' => 'Navegação Principal',
                'depth'                => 2,
                'theme_location'       => 'main',
            ));
        ?>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
