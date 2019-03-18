<?php get_header(); ?>

<?php if (is_active_sidebar('home_chamadas')) : ?>
<section class="home-chamadas">
    <div class="container">
        <div class="row">
            <?php dynamic_sidebar('home_chamadas'); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (is_active_sidebar('home_atalhos')) : ?>
    <section class="home-atalhos">
        <div class="container-fluid">
            <div class="row d-flex flex-row align-items-center">
                <div class="flex-fill home-atalhos__title-pre"></div>
                <h2 class="align-self-center home-atalhos__title">Informa&ccedil;&otilde;es</h2>
                <div class="flex-fill home-atalhos__title-pos"></div>
            </div>
        </div>
        <div class="container">
            <div class="row home-atalhos__content">
                <?php dynamic_sidebar('home_atalhos'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="home-info">
    <div class="container-fluid">
        <div class="row d-flex flex-row align-items-center home-info__title-row">
            <div class="flex-fill home-info__title-pre"></div>
            <h2 class="align-self-center home-info__title">Saiba +</h2>
            <div class="flex-fill home-info__title-pos"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <?php echo get_template_part('partials/home-publicacoes'); ?>
            </div>
            <div class="col-12 col-lg-5">
                <?php echo get_template_part('partials/home-noticias'); ?>
            </div>
        </div>
    </div>
</section>

<section class="home-ajuda">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5 col-xl-6">
                <?php echo get_template_part('partials/home-faq'); ?>
            </div>
            <div class="col-12 col-lg-7 col-xl-6 home-ajuda__duvida">
                <h2 class="home-ajuda__title">Voc&ecirc; ainda tem alguma d&uacute;vida?</h2>
                <div class="home-ajuda__image" aria-hidden="true"></div>
                <div class="home-ajuda__box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="home-ajuda__box-title">Entre em contato:</h3>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-start">
                        <a href="https://www.instagram.com/IFRSOficial/" title="Instagram" class="home-ajuda__box-instagram"><span class="sr-only">Acesse o perfil do IFRS no Instagram</span></a>
                        <a href="https://www.facebook.com/IFRSOficial/" title="Facebook" class="home-ajuda__box-facebook"><span class="sr-only">Acesse o perfil do IFRS no Facebook</span></a>
                        <img class="d-none d-sm-block img-fluid home-ajuda__box-icone" src="<?php echo get_stylesheet_directory_uri(); ?>/img/contato_ifrsoficial.png" alt="https://www.facebook.com/IFRSOficial/">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a class="home-ajuda__box-email" href="mailto:processoseletivo@ifrs.edu.br"><span class="sr-only">E-mail: </span>processoseletivo@ifrs.edu.br</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-cursos">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="home-cursos__title" src="<?php echo get_stylesheet_directory_uri(); ?>/img/cursos-title.png" alt="">
                <img class="home-cursos__aluno1 rellax" src="<?php echo get_stylesheet_directory_uri(); ?>/img/aluno1.png" alt="" data-rellax-speed="2">
                <img class="home-cursos__aluno2 rellax d-none d-sm-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/aluno2.png" alt="" data-rellax-speed="3">
                <img class="home-cursos__aluno3 rellax d-none d-lg-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/aluno3.png" alt="" data-rellax-speed="1">
                <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>"><img class="home-cursos__link" src="<?php echo get_stylesheet_directory_uri(); ?>/img/cursos-link.png" alt="Conheça todos os Cursos"></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
