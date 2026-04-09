<?php get_header(); ?>

<?php $desc = cmb2_get_option('edital_options', 'desc', ''); ?>

<section class="container editais">
  <?php echo do_blocks('<!-- wp:query-title {"type":"archive","showPrefix":false,"level":2} /-->') ?>
  <?php if (!empty($desc)) : ?>
    <div class="editais__text">
      <?php echo wpautop(wp_kses_post($desc), true); ?>
    </div>
  <?php endif; ?>
  <?php echo get_template_part('partials/editais/loop'); ?>
</section>

<?php get_footer(); ?>
