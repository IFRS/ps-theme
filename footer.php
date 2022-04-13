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
                    <p>Rua General Os&oacute;rio, 348 | Bairro Centro</p>
                    <p>CEP: 95700-086 | Bento Gon&ccedil;alves/RS</p>
                    <p>E-mail: <a href="mailto:processoseletivo@ifrs.edu.br">processoseletivo@ifrs.edu.br</a></p>
                    <p>Telefone: <a href="tel:+555434493300">(54) 3449-3300</a></p>
                </address>
            </div>
        </div>
    </div>
</footer>

<div class="creditos">
    <div class="container">
        <!-- Wordpress -->
        <a href="http://br.wordpress.org/" target="_blank" rel="noopener" data-bs-toggle="tooltip" title="Desenvolvido com Wordpress">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/creditos-wordpress.png" alt="Desenvolvido com Wordpress (abre uma nova p&aacute;gina)"/>
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
        </a>
        &mdash;
        <!-- Git -->
        <a href="https://github.com/IFRS/ps-theme/" target="_blank" rel="noopener" data-bs-toggle="tooltip" title="C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/creditos-git.png" alt="C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3 (abre uma nova p&aacute;gina)"/>
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
        </a>
        &mdash;
        <!-- Creative Commons -->
        <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" rel="noopener license" data-bs-toggle="tooltip" title="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-CompartilhaIgual 4.0 Internacional">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/creditos-cc-by-nc-sa.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-CompartilhaIgual 4.0 Internacional (abre uma nova p&aacute;gina)"/>
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true"><path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" /></svg>
        </a>
    </div>
</div>

<?php echo get_template_part('partials/vlibras'); ?>

<?php wp_footer(); ?>

</body>
</html>
