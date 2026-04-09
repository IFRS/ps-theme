<?php get_header(); ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'post_type' => array('edital', 'publicacao'),
  'posts_per_page' => 12,
  'order' => 'DESC',
  'orderby' => 'date',
  'paged' => $paged
);

$publicacoes = new WP_Query($args);
?>

<section class="container">
  <?php echo do_blocks('<!-- wp:query-title {"type":"archive","showPrefix":false,"level":2} /-->') ?>
  <article class="publicacoes publicacoes--archive">
    <div class="publicacoes__text">
      <?php echo wpautop(wp_kses_post(cmb2_get_option('publicacao_options', 'desc', ''))); ?>
    </div>

    <?php if ($publicacoes->have_posts()) : ?>
      <ul class="publicacoes__list">
        <?php while ($publicacoes->have_posts()) : $publicacoes->the_post(); ?>
          <li class="publicacoes__item">
            <h4 class="publicacoes__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p class="publicacoes__item-meta"><span class="publicacoes__item-date"><?php echo get_the_date('d/m/Y'); ?></span>&nbsp;<span class="publicacoes__item-time"><?php echo get_the_time('G\hi'); ?></span></p>
            <?php the_excerpt(); ?>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else : ?>
      <div class="alert alert-warning" role="alert">
        <p><strong>Ops!</strong> Ainda n&atilde;o existem publica&ccedil;&otilde;es cadastradas.</p>
      </div>
    <?php endif; ?>

    <?php wp_reset_query(); ?>

    <?php echo custom_pagination(); ?>
  </article>
</section>

<?php get_footer(); ?>
