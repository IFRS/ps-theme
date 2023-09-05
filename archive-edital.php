<?php get_header(); ?>

<section class="container editais">
    <h2 class="editais__title">Editais</h2>
    <?php echo wpautop(cmb2_get_option('edital_options', 'desc', '')); ?>
    <?php echo get_template_part('partials/editais/loop'); ?>
</section>

<?php get_footer(); ?>
