<?php
  $agora = time() - (3 * 60 * 60); // Hora atual em UTC-3

  $marcos_atuais = get_posts(array(
    'post_type'      => 'evento',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'nopaging'       => true,
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'meta_key'       => array('_evento_data-inicio', '_evento_data-fim'),
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
    'meta_key'       => array('_evento_data-inicio', '_evento_data-fim'),
    'meta_query'     => array(
      array(
        'key'     => '_evento_marco',
        'compare' => 'EXISTS',
      ),
      array(
        'key'     => '_evento_data-inicio',
        'compare' => '>',
        'value'   => strtotime('tomorrow midnight'),
      ),
    ),
  ));
?>

<?php if (!empty($marcos_atuais) || !empty($marcos_futuros)) : ?>
  <div class="container">
    <a class="timeline" href="<?php echo get_post_type_archive_link('evento'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Ir para o Cronograma Completo">
      <?php if (!empty($marcos_atuais)) : ?>
        <h2 class="timeline__title timeline__title--atual"><?php echo _n('Etapa Atual','Etapas Atuais',count($marcos_atuais),'ifrs-ps-theme'); ?></h2>
        <ul class="timeline__list">
        <?php foreach ($marcos_atuais as $marco) : ?>
          <li class="timeline__item timeline__item--atual"><?php echo $marco->post_title; ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <?php if (!empty($marcos_futuros)) : ?>
        <h2 class="timeline__title"><?php echo _n('Pr&oacute;xima Etapa','Pr&oacute;ximas Etapas',count($marcos_atuais),'ifrs-ps-theme'); ?></h2>
        <ul class="timeline__list">
        <?php foreach ($marcos_futuros as $marco) : ?>
          <li class="timeline__item"><?php echo $marco->post_title; ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </a>
  </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
