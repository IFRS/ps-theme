</main>

<a href="#fim-conteudo" id="fim-conteudo" class="sr-only">Fim do conte&uacute;do</a>

<!-- Rodapé -->
<?php if ( has_nav_menu( 'main' ) ) : ?>
<div class="site-map">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <?php
                wp_nav_menu( array(
                    'theme_location'    => 'main',
                    'depth'             => 2,
                    'container'         => false,
                    'container_class'   => false,
                    'container_id'      => false,
                    'menu_id'           => false,
                    'menu_class'        => 'footer-menu',
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
            <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                <a href="https://ifrs.edu.br/" title="Portal do IFRS" class="footer-logo"><img class="m-auto img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/img/ifrs-branco.png" alt="Marca do IFRS"/></a>
            </div>
            <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                <address class="footer-address">
                    <p>Rua General Os&oacute;rio, 348 | Bairro Centro</p>
                    <p>CEP: 95700-086 | Bento Gon&ccedil;alves/RS</p>
                    <p>E-mail: <a href="mailto:processoseletivo@ifrs.edu.br">processoseletivo@ifrs.edu.br</a></p>
                    <p>Telefone: (54) 3449-3300</p>
                </address>
            </div>
        </div>
    </div>
</footer>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>
                    <!-- Wordpress -->
                    <a href="http://br.wordpress.org/" target="_blank" rel="noopener noreferrer">Desenvolvido com Wordpress<span class="sr-only"> (abre uma nova p&aacute;gina)</span></a>
                    &mdash;
                    <!-- Código-fonte GPL -->
                    <a href="https://github.com/IFRS/ps-theme/" target="_blank" rel="noopener noreferrer">C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3<span class="sr-only"> (abre uma nova p&aacute;gina)</span></a>
                    &mdash;
                    <!-- Creative Commons -->
                    <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" rel="license noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cc-by-nc-nd.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-SemDeriva&ccedil;&otilde;es 4.0 Internacional (abre uma nova p&aacute;gina)" /></a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
