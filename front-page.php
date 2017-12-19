<?php get_header(); ?>

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
            <div class="col-xs-12">
                <h2 class="home-info__title">Saiba mais!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-7">
                <?php echo get_template_part('partials/home-publicacoes'); ?>
            </div>
            <div class="col-xs-12 col-md-5">
                <?php echo get_template_part('partials/home-noticias'); ?>
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
