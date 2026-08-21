<?php get_header(); ?>

<article <?php post_class(['container']); ?>>
  <?php ob_start(); ?>

  <?php get_template_part('partials/trilha-badge'); ?>

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

  <?php $arquivos = get_post_meta(get_the_ID(), '_publicacao_arquivos', true); ?>
  <?php $anexos = get_post_meta(get_the_ID(), '_publicacao_anexos', true); ?>

  <?php if (!empty($arquivos) || !empty($anexos)) : ?>
    <div class="row row-cols-1 row-cols-md-2 mt-4">
      <?php if (!empty($arquivos)) : ?>
        <div class="col">
          <div class="card mb-3">
            <div class="card-header">
              <h3 class="mb-0">Arquivos Principais</h3>
            </div>
            <div class="list-group list-group-flush">
              <?php foreach ((array) $arquivos as $id => $arquivo) : ?>
                <a href="<?php echo esc_url($arquivo); ?>" class="list-group-item list-group-item-action"><?php echo esc_html(get_the_title($id)); ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (!empty($anexos)) : ?>
        <div class="col">
          <div class="card mb-3">
            <div class="card-header">
              <h3 class="mb-0">Anexos</h3>
            </div>
            <div class="list-group list-group-flush">
              <?php foreach ((array) $anexos as $id => $anexo) : ?>
                <a class="list-group-item list-group-item-action" href="<?php echo esc_url($anexo); ?>"><?php echo esc_html(get_the_title($id)); ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php echo do_blocks(ob_get_clean()); ?>
</article>

<?php get_footer(); ?>
