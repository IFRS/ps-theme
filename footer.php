</main>

<a href="#fim-conteudo" id="fim-conteudo" class="sr-only">Fim do conte&uacute;do</a>

<!-- Rodapé -->
<?php if ( has_nav_menu( 'main' ) ) : ?>
<div id="site-map">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            <?php
                wp_nav_menu( array(
                    'theme_location'    => 'main',
                    'depth'             => 2,
                    'container'         => false,
                    'container_class'   => false,
                    'container_id'      => false,
                    'menu_id'           => 'footer-menu',
                    'fallback_cb'       => false
                ));
            ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <a href="http://www.ifrs.edu.br/site" title="Portal do IFRS" id="footer-logo"><img class="center-block img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/img/ifrs-branco.png" alt="Marca do IFRS"/></a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <address id="footer-address">
                    <p>Rua General Os&oacute;rio, 348 | Bairro Centro</p>
                    <p>CEP: 95700-086 | Bento Gonçalves/RS</p>
                    <p>Email: <a href="mailto:pssolicitacoes@ifrs.edu.br">pssolicitacoes@ifrs.edu.br</a></p>
                    <p>Telefone: (54) 3449-3300</p>
                </address>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="row">
                    <div class="col-xs-12">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <a href="http://www.facebook.com/IFRSOficial" class="social-link" title="Facebook do IFRS"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon-facebook.png" alt="Facebook do IFRS"/></a>
                        <a href="http://www.twitter.com/if_rs" class="social-link" title="Twitter do IFRS"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon-twitter.png" alt="Twitter do IFRS"/></a>
                        <a href="http://www.youtube.com/user/ComunicaIFRS" class="social-link" title="Canal do IFRS no YouTube"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon-youtube.png" alt="Canal do IFRS no YouTube"/></a>
                        <a href="http://instagram.com/IFRSOficial" class="social-link" title="Instagram do IFRS"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon-instagram.png" alt="Instagram do IFRS"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>
                    <!-- Wordpress -->
                    <a href="http://www.wordpress.org/" target="blank">Desenvolvido com Wordpress<span class="sr-only"> (abre uma nova p&aacute;gina)</span></a> <span class="glyphicon glyphicon-new-window"></span>
                    &mdash;
                    <!-- Código-fonte GPL -->
                    <a href="https://github.com/IFRS/ps-theme" target="blank">C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3<span class="sr-only"> (abre uma nova p&aacute;gina)</span></a> <span class="glyphicon glyphicon-new-window"></span>
                    &mdash;
                    <!-- Creative Commons -->
                    <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cc-by-nc-nd.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-SemDeriva&ccedil;&otilde;es 4.0 Internacional (abre uma nova p&aacute;gina)" /></a> <span class="glyphicon glyphicon-new-window"></span>
                </p>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
