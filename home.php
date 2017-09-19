<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12">
            <h2><?php echo get_the_title(get_option( 'page_for_posts' )); ?></h2>
        </div>
    </div>
    <?php echo get_template_part('partials/loop-avisos'); ?>
</section>

<?php get_footer(); ?>
