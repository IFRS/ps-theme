<?php get_header(); ?>

<?php get_template_part('partials/trilha-switch'); ?>

<section class="container publicacoes">
  <?php echo do_blocks('<!-- wp:query-title {"type":"archive","showPrefix":false,"level":2} /-->') ?>

  <?php $desc = cmb2_get_option('publicacao_options', 'desc', ''); ?>
  <?php if (!empty($desc)) : ?>
    <div class="publicacoes__text">
      <?php echo wpautop(wp_kses_post($desc), true); ?>
    </div>
  <?php endif; ?>

  <?php if (have_posts()) : ?>
  <div class="list-group mt-3">
    <?php while (have_posts()) : the_post(); ?>
      <a href="<?php echo get_the_permalink(); ?>" rel="bookmark" class="flex-column align-items-start list-group-item list-group-item-action" title="<?php the_title(); ?>">
        <?php get_template_part('partials/trilha-badge'); ?>
        <div class="d-flex w-100 justify-content-between">
          <h3 class="mb-1"><?php the_title(); ?></h3>
        </div>
        <p class="mb-1">
          <small>publicado em <?php the_time('d \d\e F \d\e Y \à\s G\hi'); ?></small>
          <?php if (get_the_modified_time() != get_the_time()) : ?>
            &nbsp;&mdash;&nbsp;
            <small>atualizado em <?php the_modified_time('d \d\e F \d\e Y \à\s G\hi'); ?></small>
          <?php endif; ?>
        </p>
      </a>
    <?php endwhile; ?>
  </div>
  <?php else : ?>
    <div class="alert alert-warning" role="alert">
      <strong>Aguarde!</strong> Em breve os documentos importantes ser&atilde;o publicados.
    </div>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
