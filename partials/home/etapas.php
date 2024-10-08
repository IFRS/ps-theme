<?php
  $agora = wp_date( 'U' );

  $marcos_atuais = get_posts(array(
    'post_type'      => 'evento',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'nopaging'       => true,
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'meta_key'       => '_evento_data-fim',
    'meta_query'     => array(
      array(
        'key'     => '_evento_marco',
        'compare' => 'EXISTS',
      ),
      array(
        'key'     => '_evento_data-inicio',
        'compare' => '<=',
        'value'   => $agora,
      ),
      array(
        'key'     => '_evento_data-fim',
        'compare' => '>=',
        'value'   => $agora,
      ),
    ),
  ));

  $marcos_futuros = get_posts(array(
    'post_type'      => 'evento',
    'post_status'    => 'publish',
    'posts_per_page' => count($marcos_atuais) === 0 ? 2 : 1,
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'meta_key'       => '_evento_data-inicio',
    'meta_query'     => array(
      array(
        'key'     => '_evento_marco',
        'compare' => 'EXISTS',
      ),
      array(
        'key'     => '_evento_data-inicio',
        'compare' => '>',
        'value'   => strtotime('today 23:59:59'),
      ),
    ),
  ));
?>

<?php if (!empty($marcos_atuais) || !empty($marcos_futuros)) : ?>
  <section class="timeline-wrapper">
    <div class="container">
      <a class="timeline" href="<?php echo get_post_type_archive_link('evento'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ir para as Datas Importantes">
        <?php if (!empty($marcos_atuais)) : ?>
          <p class="timeline__item timeline__item--atual">
            <span class="timeline__title timeline__title--atual"><?php echo _n('Etapa Atual: ','Etapas Atuais: ',count($marcos_atuais), 'ifrs-ps-theme'); ?></span>
            <?php foreach ($marcos_atuais as $marco) : ?>
              <span class="timeline__evento timeline__evento--atual">
                <?php echo $marco->post_title; ?>
                <?php
                  $data_inicio = get_post_meta( $marco->ID, '_evento_data-inicio', true );
                  $data_fim = get_post_meta( $marco->ID, '_evento_data-fim', true );
                ?>
                <?php if ($data_inicio && $data_fim) : ?>
                  (<?php echo 'até ', date_i18n( 'd/m', $data_fim ); ?>)
                <?php endif; ?>
              </span>
            <?php endforeach; ?>
          </p>
        <?php endif; ?>
        <?php if (!empty($marcos_futuros)) : ?>
          <p class="timeline__item">
            <span class="timeline__title"><?php echo _n('Pr&oacute;xima Etapa: ', 'Pr&oacute;ximas Etapas: ',count($marcos_atuais), 'ifrs-ps-theme'); ?></span>
            <?php foreach ($marcos_futuros as $marco) : ?>
              <span class="timeline__evento"><?php echo $marco->post_title; ?></span>
            <?php endforeach; ?>
          </p>
        <?php endif; ?>
      </a>
    </div>
  </section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
