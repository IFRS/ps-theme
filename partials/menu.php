<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<nav class="navbar navbar-custom">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-principal">
            <span class="sr-only">Alternar navega&ccedil;&atilde;o</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <?php
        wp_nav_menu( array(
            'theme_location'    => 'main',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker())
        );
    ?>
</nav>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
