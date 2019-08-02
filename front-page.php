<?php get_header(); ?>

<?php if (is_active_sidebar('home_atalhos')) : ?>
    <section class="home-atalhos">
        <div class="container">
            <div class="row home-atalhos__content">
                <?php dynamic_sidebar('home_atalhos'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (is_active_sidebar('home_chamadas')) : ?>
    <section class="home-chamadas">
        <div class="container lazyload">
            <div class="row">
                <?php dynamic_sidebar('home_chamadas'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="home-info">
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

<hr class="home-separator">

<section class="home-ajuda">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 visible-lg">
                <div class="home-ajuda__image" aria-hidden="true"></div>
            </div>
            <div class="col">
                <?php echo get_template_part('partials/home-faq'); ?>
            </div>
        </div>
    </div>
</section>

<section class="home-cursos">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="home-cursos__title" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/cursos-title.png" alt="" aria-hidden="true">
                <img class="home-cursos__aluno1" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/aluno1.png" alt="" aria-hidden="true">
                <img class="home-cursos__aluno2 d-none d-sm-block" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/aluno2.png" alt="" aria-hidden="true">
                <img class="home-cursos__aluno3 d-none d-lg-block" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/aluno3.png" alt="" aria-hidden="true">
                <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>"><img class="home-cursos__link" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/cursos-link.png" alt="Conheça todos os Cursos"></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
