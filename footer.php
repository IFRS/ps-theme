</main>

<a href="#fim-conteudo" id="fim-conteudo" class="visually-hidden">Fim do conte&uacute;do</a>

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
                    'container'         => 'nav',
                    'container_class'   => '',
                    'container_id'      => 'mapa-site',
                    'menu_id'           => '',
                    'menu_class'        => 'site-map__menu',
                    'fallback_cb'       => null,
                    'walker'            => new Site_Map_Walker(),
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
                <a href="https://ifrs.edu.br/" data-bs-toggle="tooltip" data-bs-placement="top" title="Portal do IFRS" class="footer-logo"><img class="m-auto img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-marca.png" alt="Marca do IFRS"/></a>
            </div>
            <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                <address class="contato">
                    <p>E-mail: <a href="mailto:processoseletivo@ifrs.edu.br">processoseletivo@ifrs.edu.br</a></p>
                </address>
            </div>
        </div>
    </div>
</footer>

<div class="creditos">
    <div class="container">
        <p>
            <!-- Wordpress -->
            <a href="http://br.wordpress.org/" target="_blank" rel="noopener noreferrer">Desenvolvido com Wordpress<span class="visually-hidden"> (abre uma nova p&aacute;gina)</span></a>
            &mdash;
            <!-- Código-fonte GPL -->
            <a href="https://github.com/IFRS/ps-theme/" target="_blank" rel="noopener noreferrer">C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3<span class="visually-hidden"> (abre uma nova p&aacute;gina)</span></a>
            &mdash;
            <!-- Creative Commons -->
            <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" rel="license noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cc-by-nc-nd.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-SemDeriva&ccedil;&otilde;es 4.0 Internacional (abre uma nova p&aacute;gina)" /></a>
        </p>
    </div>
</div>

<?php echo get_template_part('partials/vlibras'); ?>

<?php wp_footer(); ?>

</body>
</html>
