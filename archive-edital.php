<?php get_header(); ?>

<?php $desc = cmb2_get_option('edital_options', 'desc', ''); ?>

<section class="container editais">
    <h2 class="editais__title">Editais</h2>
    <?php if (!empty($desc)) : ?>
        <div class="editais__text">
            <?php echo wpautop($desc, true); ?>
        </div>
    <?php endif; ?>
    <?php echo get_template_part('partials/editais/loop'); ?>
</section>

<?php get_footer(); ?>
