<?php get_header(); ?>

<?php if (chamada_get_option('publish', false)) : ?>
  <section class="container">
    <?php echo get_template_part('partials/chamadas'); ?>
  </section>
<?php endif; ?>

<section class="container">
  <?php echo do_blocks('<!-- wp:post-content /-->'); ?>
</section>

<?php get_footer(); ?>
