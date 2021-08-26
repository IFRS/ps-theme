<?php get_header(); ?>

<section class="container">
    <h2 class="avisos__title"><?php echo get_the_title(get_option( 'page_for_posts' )); ?></h2>
    <?php echo get_template_part('partials/avisos/loop'); ?>
</section>

<?php get_footer(); ?>
