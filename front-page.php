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
        <div class="container">
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
                <?php echo get_template_part('partials/home/publicacoes'); ?>
            </div>
            <div class="col-12 col-lg-5">
                <?php echo get_template_part('partials/home/avisos'); ?>
            </div>
        </div>
    </div>
</section>

<section class="home-ajuda">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo get_template_part('partials/home/faq'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
