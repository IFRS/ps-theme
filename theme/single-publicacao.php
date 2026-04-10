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

  <?php $files = get_post_meta(get_the_ID(), '_publicacao_arquivos', true); ?>
    <?php if (!empty($files)) : ?>
      <div class="card mt-4">
        <div class="card-header">
          <h3 class="mb-0">Arquivos</h3>
        </div>
        <div class="list-group list-group-flush">
          <?php foreach ($files as $id => $file) : ?>
            <a class="list-group-item list-group-item-action" href="<?php echo esc_url($file); ?>"><?php echo get_the_title($id); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

  <?php echo do_blocks(ob_get_clean()); ?>
</article>

<?php get_footer(); ?>
