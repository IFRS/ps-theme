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

<?php echo get_template_part('partials/home/etapas'); ?>

<?php if (chamada_get_option('publish', false)) : ?>
    <section class="home-chamadas">
        <div class="container">
            <div class="row">
            <?php echo get_template_part('partials/chamadas'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="home-info">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-7">
                <?php echo get_template_part('partials/home/publicacoes'); ?>
            </div>
            <div class="col-12 col-md-5 col-lg-4 offset-lg-1">
                <?php echo get_template_part('partials/home/avisos'); ?>
            </div>
        </div>
    </div>
</section>

<?php if (is_active_sidebar('home_ajuda')) : ?>
    <section class="home-ajuda">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="home-ajuda__title">Voc&ecirc; tem alguma d&uacute;vida?</h2>
                    <?php dynamic_sidebar('home_ajuda'); ?>
                    <?php //echo get_template_part('partials/home/faq'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
