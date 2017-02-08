<?php get_header(); ?>

<section class="container" id="home-content">
    <?php echo get_template_part('partials/banners'); ?>

    <div id="ms-grid" class="row">
        <div class="row">
            <div class="col-xs-12 col-md-6 ms-item">
                <?php if (!dynamic_sidebar('home_1')) : endif; ?>
            </div>
        </div>

        <?php echo get_template_part('partials/loop-avisos'); ?>
    </div>
</section>

<?php get_footer(); ?>
