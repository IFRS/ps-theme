<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<nav class="navbar navbar-custom" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-principal">
            <span class="sr-only">Alternar navega&ccedil;&atilde;o</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="menu-principal">
        <?php
            wp_nav_menu( array(
                'menu'              => 'main',
                'theme_location'    => 'main',
                'depth'             => 2,
                'container'         => false,
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'menu-principal',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
