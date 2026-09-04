<?php get_header(); ?>

<?php
$desc = cmb2_get_option('evento_options', 'desc', '');

$ultimo_evento_args = array(
  'post_type'      => 'evento',
  'posts_per_page' => 1,
  'orderby'        => 'modified',
  'no_found_rows'  => true,
);

$ultimo_evento_args = ifrs_ps_apply_trilha_query_args($ultimo_evento_args);

$ultimo_evento = new WP_Query($ultimo_evento_args);
if ($ultimo_evento->have_posts()) {
  $ultimo_evento->the_post();
  $atualizacao = get_the_modified_date();
}
wp_reset_postdata();
?>

<?php get_template_part('partials/trilha-switch'); ?>

<section class="container cronograma">
  <?php echo do_blocks('<!-- wp:query-title {"type":"archive","showPrefix":false,"level":2} /-->') ?>
  <?php if (!empty($desc)) : ?>
    <div class="cronograma__text">
      <?php echo wpautop(wp_kses_post($desc), true); ?>
    </div>
  <?php endif; ?>


  <?php if (!empty($atualizacao)) : ?>
    <p class="cronograma__meta">Atualizado em <?php echo $atualizacao; ?></p>
  <?php endif; ?>
  <?php if (have_posts()) : ?>
    <div class="d-flex flex-wrap justify-content-md-between align-items-center gap-4">
      <div class="form-check form-switch fw-medium">
        <input class="form-check-input" type="checkbox" role="switch" id="cronograma__switch">
        <label class="form-check-label" for="cronograma__switch">Mostrar eventos passados</label>
      </div>
      <button id="ics" class="btn btn-dark btn-sm">Exporte para sua agenda</button>
    </div>
    <div class="table-responsive-sm mt-3">
      <table class="table cronograma__table">
        <thead class="thead-light">
          <tr>
            <th>Per&iacute;odo</th>
            <th>Evento</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while (have_posts()) : the_post();
            $data_inicio = get_post_meta(get_the_ID(), '_evento_data-inicio', true);
            $data_fim = get_post_meta(get_the_ID(), '_evento_data-fim', true);

            $agora = wp_date('U');
            $agora = $agora - (3 * 60 * 60);

            $evento_termina_hoje = date_i18n('d/m/Y', $data_fim) === date_i18n('d/m/Y', $agora);
            $evento_mesmo_dia = date_i18n('d/m/Y', $data_inicio) === date_i18n('d/m/Y', $data_fim);
            $evento_atual = ($data_inicio <= $agora && $data_fim > $agora);
            $evento_passou = ($data_fim < $agora);

            $evento_tipo = get_post_meta(get_the_ID(), '_evento_tipo', true);
          ?>
            <tr class="<?php echo ($evento_passou) ? 'evento evento--passado' : 'evento' ?>" id="evento-<?php echo get_the_ID(); ?>" data-tipo="<?php echo !empty($evento_tipo) ? esc_attr($evento_tipo) : ''; ?>">
              <td class="evento__datas<?php echo ($evento_atual) ? ' text-success' : ''; ?>">
                <?php if (!$evento_mesmo_dia) : ?>
                  <?php echo date_i18n('d/m', $data_inicio); ?> a
                <?php endif; ?>
                <?php if ($evento_termina_hoje) : ?>
                  <span class="text-danger">
                    <strong><?php echo date_i18n('d/m/Y', $data_fim); ?></strong>
                  </span>
                <?php else : ?>
                  <?php echo date_i18n('d/m/Y', $data_fim); ?>
                <?php endif; ?>
              </td>
              <td class="evento__content">
                <?php get_template_part('partials/trilha-badge'); ?>
                <strong class="d-block"><?php the_title(); ?></strong>
                <?php the_content(); ?>
                <?php
                $url = get_post_meta(get_the_ID(), '_evento_programacao_url', true);
                ?>
                <?php if ($evento_atual && !empty($url)) : ?>
                  <a href="<?php echo esc_url($url); ?>" class="d-inline-block fw-medium mt-3"><?php echo esc_html($url); ?></a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else : ?>
    <div class="alert alert-info">
      Nenhuma data cadastrada at&eacute; o momento.
    </div>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
