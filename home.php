<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="avisos__title"><?php echo get_the_title(get_option( 'page_for_posts' )); ?></h2>
        </div>
    </div>
    <?php echo get_template_part('partials/avisos/loop'); ?>
</section>

<?php get_footer(); ?>
