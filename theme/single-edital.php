<?php get_header(); ?>

<article <?php post_class(['container']); ?>>
  <?php ob_start(); ?>

  <!-- wp:post-title /-->

  <!-- wp:group {"className":"my-4 p-2 border-top border-bottom","layout":{"type":"flex","flexWrap":"nowrap"}} -->
  <div class="wp-block-group my-4 p-2 border-top border-bottom">
    <!-- wp:post-date {"format":"\\P\\u\\b\\l\\i\\c\\a\\d\\o \\e\\m j \\d\\e F \\d\\e Y"} /-->

    <?php if (get_the_modified_date('U') != get_the_date('U')) : ?>
      <div class="vr"></div>
    <?php endif; ?>

    <!-- wp:post-date {"displayType":"modified","format":"\\A\\t\\u\\a\\l\\i\\z\\a\\d\\o \\e\\m j \\d\\e F \\d\\e Y"} /-->

    <!-- wp:spacer {"style":{"layout":{"selfStretch":"fill","flexSize":null}}} -->
    <div aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:pattern {"slug":"ifrs-ps/share"} /-->
  </div>
  <!-- /wp:group -->

  <!-- wp:post-content /-->

  <div class="row row-cols-1 row-cols-md-2">
    <div class="col">
      <div class="card mb-3">
        <div class="card-header">
          <h3 class="edital__files-title">Arquivos</h3>
        </div>
        <div class="list-group list-group-flush">
          <a href="<?php echo get_post_meta(get_the_ID(), '_edital_arquivo', true); ?>" class="list-group-item list-group-item-action"><?php the_title(); ?></a>
          <?php $retificacoes = get_post_meta(get_the_ID(), '_edital_retificacoes', true); ?>
          <?php if (!empty($retificacoes)) : ?>
            <?php foreach ($retificacoes as $id => $retificacao) : ?>
              <a href="<?php echo esc_url($retificacao); ?>" class="list-group-item list-group-item-action"><?php echo get_the_title($id); ?></a>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php $anexos = get_post_meta(get_the_ID(), '_edital_anexos', true); ?>
    <?php if (!empty($anexos)) : ?>
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="edital__files-title">Anexos</h3>
          </div>
          <div class="list-group list-group-flush">
            <?php foreach ($anexos as $id => $anexo) : ?>
              <a href="<?php echo esc_url($anexo); ?>" class="list-group-item list-group-item-action list-group-item-secondary"><?php echo get_the_title($id); ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php echo do_blocks(ob_get_clean()); ?>
</article>

<?php get_footer(); ?>
