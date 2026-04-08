<?php get_header(); ?>

<?php $desc = curso_get_option('desc', ''); ?>

<section class="container cursos">
  <h2 class="cursos__title">Cursos ofertados<?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo esc_html(get_search_query()); ?>&rdquo;)</small><?php endif; ?></h2>

  <?php if (!empty($desc)) : ?>
    <div class="cursos__text">
      <?php echo wpautop(wp_kses_post($desc), true); ?>
    </div>
  <?php endif; ?>

  <?php get_template_part('partials/cursos/filter'); ?>

  <?php if (have_posts()) : ?>
    <div class="cursos__list">
      <?php while (have_posts()) : the_post(); ?>
        <?php
        $formasingresso_permitidas = curso_get_option('formas', array());

        $campi = get_the_terms(get_the_ID(), 'campus');
        $formasingresso = get_the_terms(get_the_ID(), 'formaingresso');
        $modalidades = get_the_terms(get_the_ID(), 'modalidade');

        $turnos = wp_get_post_terms(get_the_ID(), 'turno', array('orderby' => 'term_order'));

        $duracao = get_post_meta(get_the_ID(), '_curso_duracao', true);
        $vagas = get_post_meta(get_the_ID(), '_curso_vagas', true);

        // Filtra os Cursos de acordo com as Formas de Ingresso selecionadas nas opções do tema
        if (!empty($formasingresso) && !is_wp_error($formasingresso) && empty(array_intersect(wp_list_pluck($formasingresso, 'term_id'), $formasingresso_permitidas))) {
          continue;
        }
        ?>
        <article class="curso">
          <div class="curso__header">
            <?php
            if (!empty($campi) && !is_wp_error($campi)) {
              echo esc_html(implode(', ', wp_list_pluck($campi, 'name')));
            }
            ?>
          </div>

          <h3 class="curso__title"><?php the_title(); ?></h3>

          <div class="curso__content">
            <p>
              <?php
              if (!empty($modalidades) && !is_wp_error($modalidades)) {
                echo esc_html(implode(', ', wp_list_pluck($modalidades, 'name')));
                echo '&nbsp;&ndash;&nbsp;';
              }
              if (!empty($turnos) && !is_wp_error($turnos)) {
                echo esc_html(wp_sprintf_l('%l', wp_list_pluck($turnos, 'name')));
              }
              ?>
            </p>
            <p>
              <strong>Dura&ccedil;&atilde;o: </strong>
              <?php echo (!empty($duracao) && !is_wp_error($duracao)) ? esc_html($duracao) : '-'; ?>
              <!-- Carga Horária EaD -->
              <?php if (get_post_meta(get_the_ID(), '_curso_ead', 1)) : ?>
                (<span class="curso__help" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Esse Curso possui parte da carga hor&aacute;ria a dist&acirc;ncia.">Parte EaD</span>)
              <?php endif; ?>

              <br>

              <strong><?php echo _n('Forma', 'Formas', count($formasingresso), 'ifrs-ps-theme') ?> de Ingresso: </strong>
              <?php
              if (!empty($formasingresso) && !is_wp_error($formasingresso)) {
                foreach ($formasingresso as $key => $formaingresso) {
                  if (!empty($formaingresso->description)) {
                    printf('<span class="formaingresso-help" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="%s">%s</span>', esc_attr($formaingresso->description), esc_html($formaingresso->name));
                  } else {
                    echo esc_html($formaingresso->name);
                  }
                  echo ($key !== array_key_last($formasingresso)) ? ' ou ' : '';
                }
              } else {
                echo '-';
              }
              ?>
            </p>
          </div>
          <div class="curso__footer">
            <p><?php echo (!empty($vagas) && !is_wp_error($vagas)) ? esc_html($vagas) : '-'; ?>&nbsp;<?php echo _n('vaga', 'vagas', intval($vagas), 'ifrs-ps-theme'); ?></p>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
    <?php get_template_part('partials/cursos/alert'); ?>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
