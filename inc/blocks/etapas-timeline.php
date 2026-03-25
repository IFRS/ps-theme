<?php
add_action('init', function() {
  register_block_type('ifrs-ps/etapas-timeline', array(
    'api_version'     => 2,
    'editor_script'   => 'ps-etapas-timeline-block',
    'render_callback' => 'ifrs_ps_render_etapas_timeline_block',
    'attributes'      => array(
      'title' => array(
        'type'    => 'string',
        'default' => __('Próximas etapas importantes', 'ifrs-ps-theme'),
      ),
      'hidePast' => array(
        'type'    => 'boolean',
        'default' => true,
      ),
      'postsPerPage' => array(
        'type'    => 'number',
        'default' => 10,
      ),
    ),
  ));
});

if (!function_exists('ifrs_ps_render_etapas_timeline_block')) {
  function ifrs_ps_render_etapas_timeline_block($attributes) {
    $title = !empty($attributes['title'])
      ? wp_kses_post($attributes['title'])
      : esc_html__('Próximas etapas importantes', 'ifrs-ps-theme');
    $hide_past = !empty($attributes['hidePast']);
    $agora = current_time('timestamp');

    $meta_query = array(
      array(
        'key'     => '_evento_marco',
        'compare' => 'EXISTS',
      ),
    );

    if ($hide_past) {
      $meta_query[] = array(
        'key'     => '_evento_data-fim',
        'compare' => '>=',
        'value'   => $agora,
        'type'    => 'NUMERIC',
      );
    }

    $posts_per_page = !empty($attributes['postsPerPage']) ? (int) $attributes['postsPerPage'] : 10;

    $eventos = new WP_Query(array(
      'post_type'           => 'evento',
      'post_status'         => 'publish',
      'posts_per_page'      => $posts_per_page,
      'orderby'             => 'meta_value_num',
      'order'               => 'ASC',
      'meta_key'            => '_evento_data-inicio',
      'meta_query'          => $meta_query,
      'no_found_rows'       => true,
      'ignore_sticky_posts' => true,
    ));

    if (!$eventos->have_posts()) {
      return '<p>' . esc_html__('Nenhuma etapa importante cadastrada no momento.', 'ifrs-ps-theme') . '</p>';
    }

    ob_start();
    ?>
    <section class="etapas-timeline" aria-label="<?php esc_attr_e('Linha do tempo de etapas importantes próximas', 'ifrs-ps-theme'); ?>">
      <h2 class="etapas-timeline__titulo"><?php echo $title; ?></h2>
      <ol class="etapas-timeline__list">
        <?php while ($eventos->have_posts()) : $eventos->the_post(); ?>
          <?php
            $data_inicio = (int) get_post_meta(get_the_ID(), '_evento_data-inicio', true);
            $data_fim = (int) get_post_meta(get_the_ID(), '_evento_data-fim', true);

            $evento_passou = ($data_fim > 0) ? ($data_fim < $agora) : false;
            $evento_atual = ($data_inicio > 0 && $data_fim > 0) ? ($data_inicio <= $agora && $data_fim >= $agora) : false;
            $evento_mesmo_dia = ($data_inicio > 0 && $data_fim > 0) ? (date_i18n('Ymd', $data_inicio) === date_i18n('Ymd', $data_fim)) : false;

            if ($data_inicio > 0 && $data_fim > 0) {
              $periodo = $evento_mesmo_dia
                ? date_i18n('d/m/Y', $data_fim)
                : date_i18n('d/m/Y', $data_inicio) . ' a ' . date_i18n('d/m/Y', $data_fim);
            } elseif ($data_inicio > 0) {
              $periodo = date_i18n('d/m/Y', $data_inicio);
            } else {
              $periodo = esc_html__('Sem data', 'ifrs-ps-theme');
            }

            $item_class = 'etapa';
            if ($evento_atual) {
              $item_class .= ' etapa--atual';
            } elseif ($evento_passou) {
              $item_class .= ' etapa--passado';
            }
          ?>
          <li class="<?php echo esc_attr($item_class); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" class="etapa__icone" aria-hidden="true">
              <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
              <path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2M5 20V8h14V6v14z"></path><path d="M12 13h5v5h-5z"></path>
            </svg>
            <div class="etapa__conteudo">
              <h3 class="etapa__titulo">
                <?php the_title(); ?>
              </h3>
              <p class="etapa__periodo">
                <?php echo esc_html($periodo); ?>
              </p>
            </div>
          </li>
          <?php endwhile; ?>
        </ol>
        <a href="<?php echo get_post_type_archive_link('evento'); ?>" class="btn btn-ps">Confira todas as Datas Importantes</a>
    </section>
    <?php

    wp_reset_postdata();

    return ob_get_clean();
  }
}
