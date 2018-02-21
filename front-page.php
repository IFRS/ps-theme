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
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar('home_atalhos'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="home-info">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="home-info__title">Saiba mais!</h2>
            </div>
        </div>
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
            <div class="col-12 col-lg-6">
                <?php echo get_template_part('partials/home-faq'); ?>
            </div>
            <div class="col-12 col-lg-6 home-ajuda__duvida">
                <h2 class="home-ajuda__title">Voc&ecirc; ainda tem alguma d&uacute;vida?</h2>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home-ajuda.png" alt="Você tem alguma dúvida?" class="home-ajuda__image"/>
                <div class="home-ajuda__box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="home-ajuda__box-title">Entre em contato...</h3>
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

<?php if (is_active_sidebar('home_jumbo')) : ?>
    <section class="home-jumbo">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar('home_jumbo'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
