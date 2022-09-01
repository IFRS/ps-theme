<?php
  $hoje = strtotime('today midnight');

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
        'value'   => $hoje,
      ),
      array(
        'key'     => '_evento_data-fim',
        'compare' => '>=',
        'value'   => $hoje,
      ),
    ),
  ));

  // $marco_anterior = get_posts(array(
  //   'post_type'      => 'evento',
  //   'post_status'    => 'publish',
  //   'posts_per_page' => 1,
  //   'orderby'        => 'meta_value_num',
  //   'order'          => 'DESC',
  //   'meta_key'       => array('_evento_data-fim'),
  //   'meta_query'     => array(
  //     array(
  //       'key'     => '_evento_marco',
  //       'compare' => 'EXISTS',
  //     ),
  //     array(
  //       'key'     => '_evento_data-fim',
  //       'compare' => '<',
  //       'value'   => $hoje,
  //     ),
  //   ),
  // ));

  $marcos_futuros = get_posts(array(
    'post_type'      => 'evento',
    'post_status'    => 'publish',
    'posts_per_page' => 2,
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
        'value'   => $hoje,
      ),
    ),
  ));
?>

<div class="container">
  <a class="timeline" href="<?php echo get_post_type_archive_link('evento'); ?>">
    <h2 class="timeline__title">Etapas</h2>
    <ul class="timeline__list">
    <?php foreach ($marcos_atuais as $marco) : ?>
      <li class="timeline__item timeline__item--atual"><?php echo $marco->post_title; ?></li>
    <?php endforeach; ?>
    <?php foreach ($marcos_futuros as $marco) : ?>
      <li class="timeline__item"><?php echo $marco->post_title; ?></li>
    <?php endforeach; ?>
    </ul>
  </a>
</div>

<?php wp_reset_postdata(); ?>
