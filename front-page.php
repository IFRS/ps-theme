<?php get_header(); ?>


<?php echo get_template_part('partials/home/etapas'); ?>

<?php echo get_template_part('partials/home/banner-especial'); ?>

<?php if (chamada_get_option('publish', false)) : ?>
    <section class="home-chamadas">
        <div class="container">
            <div class="row">
            <?php echo get_template_part('partials/home/chamadas'); ?>
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
                <div class="col">
                    <h2 class="home-ajuda__title">Voc&ecirc; tem alguma d&uacute;vida?</h2>
                    <?php get_search_form(); ?>
                    <?php dynamic_sidebar('home_ajuda'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
