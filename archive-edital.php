<?php get_header(); ?>

<section class="container" id="content">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="content">
                <h2 class="title">Editais</h2>
                <?php echo get_template_part('partials/loop', 'editais'); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <?php if (!dynamic_sidebar('banner')) : endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
