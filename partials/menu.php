<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<nav class="navbar navbar-expand-lg navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'main',
                'depth'             => 2,
                'container'         => false,
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'navbarSupportedContent',
                'menu_class'        => 'navbar-nav mr-auto',
                'walker'            => new Bootstrap_NavWalker(),
                'fallback_cb'       => 'Bootstrap_NavWalker::fallback'
            ));
        ?>

        <a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
    </div>
</nav>
