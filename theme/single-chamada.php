<?php get_header(); ?>

<?php
$campi = get_the_terms(get_the_ID(), 'campus');
$formasingresso = get_the_terms(get_the_ID(), 'formaingresso');
?>

<article id="chamada-<?php the_ID(); ?>" <?php post_class(['container']); ?>>
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

  <?php
    $chamadas_matricula = cmb2_get_option('chamada_files', 'matricula', false);
    $chamadas_bancas = cmb2_get_option('chamada_files', 'bancas', false);
    $chamadas_renda = cmb2_get_option('chamada_files', 'renda', false);

    $matriculas = get_post_meta(get_the_ID(), '_chamada_matriculas');
    $bancas = get_post_meta(get_the_ID(), '_chamada_bancas');
    $renda = get_post_meta(get_the_ID(), '_chamada_renda');

    $modalidades = get_terms(array('taxonomy' => 'modalidade', 'orderby' => 'term_order'));
  ?>

  <div class="row" id="masonry">
    <?php if (!empty($modalidades)) : ?>
      <?php foreach ($modalidades as $modalidade) : ?>
        <?php $resultados = (array) get_post_meta(get_the_ID(), '_chamada_modalidade_' . $modalidade->slug); ?>
        <?php if (!empty($resultados)) : ?>
          <div class="col-auto col-md-6 col-xl-4">
            <div class="card bg-light mb-4">
              <div class="card-header">
                <strong><?php echo esc_html($modalidade->name); ?></strong>
              </div>
              <div class="list-group list-group-flush" role="list">
                <?php foreach ($resultados[0] as $id => $url): ?>
                  <a href="<?php echo esc_url($url); ?>" role="listitem" target="_blank" class="list-group-item list-group-item-action list-group-item-info"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                <?php endforeach; ?>

                <?php
                $formaingresso = get_terms(array(
                  'taxonomy' => 'formaingresso',
                  'object_ids' => get_the_ID(),
                  'fields' => 'tt_ids',
                ));

                $args = array(
                  'post_type' => 'documento',
                  'nopaging' => true,
                  'posts_per_page' => -1,
                  'order' => 'ASC',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'formaingresso',
                      'terms' => $formaingresso
                    ),
                    array(
                      'taxonomy' => 'modalidade',
                      'terms' => $modalidade->term_id
                    )
                  )
                );

                $documentos = new WP_Query($args);
                ?>
                <?php if ($documentos->have_posts()) : ?>
                  <?php while ($documentos->have_posts()) : $documentos->the_post(); ?>
                    <?php $arquivos = get_post_meta(get_the_ID(), '_documento_arquivos'); ?>
                    <?php if (!empty($arquivos)) : ?>
                      <a href="#collapse-arquivos-<?php echo get_the_ID(); ?>" class="list-group-item list-group-item-action list-group-item-secondary collapsed chamada__documento-link" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-arquivos-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a>
                      <div class="list-group collapse" role="list" id="collapse-arquivos-<?php echo get_the_ID(); ?>">
                        <?php foreach ($arquivos[0] as $id => $url) : ?>
                          <a href="<?php echo esc_url($url); ?>" role="listitem" target="_blank" class="list-group-item list-group-item-action"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($chamadas_matricula) || !empty($matriculas)) : ?>
      <div class="col-auto col-md-6 col-xl-4">
        <div class="card bg-light mb-4">
          <div class="card-header">
            <strong><?php _e('Matrículas', 'ifrs-ps-theme'); ?></strong>
          </div>
          <div class="list-group list-group-flush">
            <?php if (!empty($chamadas_matricula)) : ?>
              <?php foreach ($chamadas_matricula as $id => $url) : ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-success"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
              <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($matriculas[0])) : ?>
              <?php foreach ($matriculas[0] as $id => $url) : ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-success"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($chamadas_bancas) || !empty($bancas)) : ?>
      <div class="col-auto col-md-6 col-xl-4">
        <div class="card bg-light mb-4">
          <div class="card-header">
            <strong><?php _e('Comissão de Heteroidentificação', 'ifrs-ps-theme'); ?></strong>
          </div>
          <div class="list-group list-group-flush">
            <?php if (!empty($chamadas_bancas)) : ?>
              <?php foreach ($chamadas_bancas as $id => $url): ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
              <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($bancas[0])) : ?>
              <?php foreach ($bancas[0] as $id => $url): ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($chamadas_renda) || !empty($renda)) : ?>
      <div class="col-auto col-md-6 col-xl-4">
        <div class="card bg-light mb-4">
          <div class="card-header">
            <strong><?php _e('Análise de Reserva de Vagas para Renda Inferior a 1,5 Salário Mínimo', 'ifrs-ps-theme'); ?></strong>
          </div>
          <div class="list-group list-group-flush">
            <?php if (!empty($chamadas_renda)) : ?>
              <?php foreach ($chamadas_renda as $id => $url): ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
              <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($renda[0])) : ?>
              <?php foreach ($renda[0] as $id => $url): ?>
                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo esc_html(get_the_title($id)); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php echo do_blocks(ob_get_clean()); ?>
</article>

<?php get_footer(); ?>
