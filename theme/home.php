<?php get_header(); ?>

<section class="container">
  <?php ob_start(); ?>

  <!-- wp:heading {"className":"mb-4"} -->
  <h2 class="wp-block-heading mb-4">Todos os Avisos</h2>
  <!-- /wp:heading -->

  <!-- wp:template-part {"slug":"avisos","lock":{"move":true,"remove":true}} /-->

  <?php echo do_blocks(ob_get_clean()); ?>
</section>

<?php get_footer(); ?>
