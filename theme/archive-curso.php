<?php get_header(); ?>

<?php $desc = curso_get_option('desc', ''); ?>

<?php get_template_part('partials/trilha-switch'); ?>

<section class="container cursos">
  <?php echo do_blocks('<!-- wp:query-title {"type":"archive","showPrefix":false,"level":2} /-->') ?>
  <?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo esc_html(get_search_query()); ?>&rdquo;)</small><?php endif; ?>

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
        $modalidade = ifrs_ps_get_curso_modalidade(get_the_ID());
        $turnos = ifrs_ps_get_curso_turnos(get_the_ID());

        $duracao = get_post_meta(get_the_ID(), '_curso_duracao', true);
        $vagas_por_trilha = ifrs_ps_get_curso_vagas_por_trilha(get_the_ID());

        // Filtra os Cursos de acordo com as Formas de Ingresso selecionadas nas opções do tema
        if (!empty($formasingresso) && !is_wp_error($formasingresso) && empty(array_intersect(wp_list_pluck($formasingresso, 'term_id'), $formasingresso_permitidas))) {
          continue;
        }
        ?>
        <article class="curso">
          <div>
            <?php get_template_part('partials/trilha-badge'); ?>
          </div>
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
              if (!empty($modalidade)) {
                echo esc_html($modalidade);
                echo '&nbsp;&ndash;&nbsp;';
              }
              if (!empty($turnos)) {
                echo esc_html(wp_sprintf_l('%l', $turnos));
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
          <?php if (!empty($vagas_por_trilha)) : ?>
            <div class="curso__footer">
              <p>
                <?php foreach ($vagas_por_trilha as $key => $vagas_trilha) : ?>
                  <?php if ($key > 0) : ?><span aria-hidden="true">;&nbsp;</span><?php endif; ?>
                  <span><strong><?php echo esc_html($vagas_trilha['nome']); ?>:</strong> <?php echo esc_html($vagas_trilha['vagas']); ?>&nbsp;<?php echo _n('vaga', 'vagas', $vagas_trilha['vagas'], 'ifrs-ps-theme'); ?></span>
                <?php endforeach; ?>
              </p>
            </div>
          <?php endif; ?>
        </article>
      <?php endwhile; ?>
    </div>
    <div class="alert alert-info mt-5" role="alert">
      <p>Para saber mais sobre a forma de distribui&ccedil;&atilde;o das vagas, confira os <a class="alert-link" href="<?php echo get_post_type_archive_link('publicacao'); ?>">editais</a>.</p>
    </div>
  <?php else : ?>
    <div class="alert alert-warning" role="alert">
      <p><?php _e('Nenhum curso encontrado.', 'ifrs-ps-theme'); ?></p>
    </div>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
