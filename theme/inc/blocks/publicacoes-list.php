<?php
add_action('init', function() {
  register_block_type('ifrs-ps/publicacoes-list', array(
    'api_version'     => 2,
    'editor_script'   => 'ps-publicacoes-list-block',
    'render_callback' => 'ifrs_ps_render_publicacoes_list_block',
    'attributes'      => array(
      'title' => array(
        'type'    => 'string',
        'default' => __('Últimas Publicações', 'ifrs-ps-theme'),
      ),
      'postsPerPage' => array(
        'type'    => 'number',
        'default' => 5,
      ),
    ),
  ));
});

if (!function_exists('ifrs_ps_render_publicacoes_list_block')) {
  function ifrs_ps_render_publicacoes_list_block($attributes = array()) {
    $title = !empty($attributes['title'])
      ? wp_kses_post($attributes['title'])
      : esc_html__('Últimas Publicações', 'ifrs-ps-theme');
    $posts_per_page = !empty($attributes['postsPerPage']) ? (int) $attributes['postsPerPage'] : 5;

    $publicacoes = new WP_Query(array(
      'post_type'           => array('edital', 'publicacao'),
      'post_status'         => 'publish',
      'posts_per_page'      => $posts_per_page,
      'order'               => 'DESC',
      'orderby'             => 'modified',
      'no_found_rows'       => true,
      'ignore_sticky_posts' => true,
    ));

    $desc = cmb2_get_option('publicacao_options', 'desc', '');
    $publicacoes_link = get_post_type_archive_link('publicacao');
    $eventos_link = get_post_type_archive_link('evento');

    ob_start();
    ?>
    <div class="publicacoes-list-block">
      <section class="publicacoes">
        <?php
          echo do_blocks(
            sprintf(
              '<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">%s</h2><!-- /wp:heading -->',
              $title
            )
          );
        ?>

        <?php if (!empty($desc)) : ?>
          <div class="publicacoes__text">
            <?php echo wpautop(wp_kses_post($desc)); ?>
          </div>
        <?php endif; ?>

        <?php if ($publicacoes->have_posts()) : ?>
          <ul class="publicacoes__list">
          <?php while ($publicacoes->have_posts()) : $publicacoes->the_post(); ?>
            <li class="publicacoes__item">
              <h3 class="publicacoes__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="publicacoes__item-meta" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo esc_attr(get_the_modified_date('d/m/Y') . ' - ' . get_the_modified_time('G\\hi')); ?>">atualizado <?php echo esc_html(ps_relative_past_time(get_the_modified_date('c'))); ?></p>
              <?php the_excerpt(); ?>
            </li>
          <?php endwhile; ?>
          </ul>
          <?php if (!empty($publicacoes_link)) : ?>
            <?php
              echo do_blocks(
                sprintf(
                  '<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="%1$s">%2$s</a></div><!-- /wp:button --></div><!-- /wp:buttons -->',
                  esc_url($publicacoes_link),
                  esc_html__('Todas as Publicações', 'ifrs-ps-theme')
                )
              );
            ?>
          <?php endif; ?>
        <?php else : ?>
          <div class="alert alert-warning" role="alert">
            <p>Aguarde a publicação dos documentos com o detalhamento do Processo Seletivo de estudantes. Fique atento às <a href="<?php echo esc_url($eventos_link); ?>" class="alert-link">datas importantes</a>!</p>
          </div>
        <?php endif; ?>
      </section>
    </div>
    <?php

    wp_reset_postdata();

    return ob_get_clean();
  }
}
