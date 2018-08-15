<?php get_header(); ?>

<?php if (is_active_sidebar('home_chamadas')) : ?>
<section class="home-chamadas">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="home-chamadas__title">Voc&ecirc; &eacute; a cara do <strong>#MundoIFRS</strong></h2>
            </div>
        </div>
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
            <div class="row">
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
            <div class="col-12 col-lg-8 col-xl-6">
                <?php echo get_template_part('partials/home-faq'); ?>
            </div>
            <div class="col-12 col-lg-4 col-xl-6 home-ajuda__duvida">
                <h2 class="home-ajuda__title">Voc&ecirc; ainda tem alguma d&uacute;vida?</h2>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home-ajuda.png" alt="Você tem alguma dúvida?" class="img-fluid home-ajuda__image"/>
                <div class="home-ajuda__box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="home-ajuda__box-title">Entre em contato:</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <a href="mailto:pssolicitacoes@ifrs.edu.br"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/contato_email.png" alt="pssolicitacoes@ifrs.edu.br" class="img-fluid"></a>
                        </div>
                        <div class="col-12 col-md-6">
                        <a href="https://www.facebook.com/IFRSOficial/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/contato_facebook.png" alt="https://www.facebook.com/IFRSOficial/" class="img-fluid"></a>
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
                <img class="home-cursos__guria1 rellax" src="<?php echo get_stylesheet_directory_uri(); ?>/img/guria1.png" alt="" data-rellax-speed="2">
                <img class="home-cursos__guria2 rellax d-none d-sm-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/guria2.png" alt="" data-rellax-speed="3">
                <img class="home-cursos__guria3 rellax d-none d-lg-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/guria3.png" alt="" data-rellax-speed="2">
                <img class="home-cursos__guria4 rellax d-none d-xl-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/guria4.png" alt="" data-rellax-speed="1">
                <a href="/cursos"><img class="home-cursos__link" src="<?php echo get_stylesheet_directory_uri(); ?>/img/cursos-link.png" alt=""></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
