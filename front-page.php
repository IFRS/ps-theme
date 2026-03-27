<?php get_header(); ?>

<?php if (chamada_get_option('publish', false)) : ?>
    <section class="home-chamadas">
        <div class="container">
            <div class="row">
            <?php echo get_template_part('partials/home/chamadas'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="container">
    <?php the_content(); ?>
</section>

<?php get_footer(); ?>
