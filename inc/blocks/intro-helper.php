<?php
add_action('init', function() {
  register_block_type('ifrs-ps/intro-helper', array(
    'api_version'     => 2,
    'render_callback' => 'ifrs_ps_render_intro_helper_block',
    'attributes'      => array(
      'title' => array(
        'type'    => 'string',
        'default' => '',
      ),
      'linksTitle' => array(
        'type'    => 'string',
        'default' => '',
      ),
      'items' => array(
        'type'    => 'array',
        'default' => array(),
      ),
    ),
  ));
});

if (!function_exists('ifrs_ps_get_intro_helper_steps')) {
  function ifrs_ps_get_intro_helper_steps() {
    return array(
      array(
        'text' => __('Escolha um Campus e Curso', 'ifrs-ps-theme'),
        'link_post_type' => 'curso',
        'link_text' => __('Lista de Cursos', 'ifrs-ps-theme'),
        'icon_paths' => array(
          'M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1',
          'M11 16m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z',
        ),
      ),
      array(
        'text' => __('Leia atentamente o Edital e faça sua Inscrição', 'ifrs-ps-theme'),
        'link_post_type' => 'edital',
        'link_text' => __('Editais', 'ifrs-ps-theme'),
        'icon_paths' => array(
          'M14 3v4a1 1 0 0 0 1 1h4',
          'M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z',
          'M9 9l1 0',
          'M9 13l6 0',
          'M9 17l6 0',
        ),
      ),
      array(
        'text' => __('Realize a Prova ou acompanhe o Sorteio', 'ifrs-ps-theme'),
        'link_post_type' => null,
        'link_text' => null,
        'icon_paths' => array(
          'M14 3v4a1 1 0 0 0 1 1h4',
          'M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z',
          'M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z',
        ),
      ),
      array(
        'text' => __('Acompanhe os Resultados', 'ifrs-ps-theme'),
        'link_post_type' => 'chamada',
        'link_text' => __('Resultados', 'ifrs-ps-theme'),
        'icon_paths' => array(
          'M4 4m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z',
          'M4 8h16',
          'M8 4v4',
          'M9.5 14.5l1.5 1.5l3 -3',
        ),
      ),
      array(
        'text' => __('Faça sua Pré-matrícula', 'ifrs-ps-theme'),
        'link_post_type' => null,
        'link_text' => null,
        'icon_paths' => array(
          'M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5',
          'M11 16h-5a2 2 0 0 0 -2 2',
          'M15 16l3 -3l3 3',
          'M18 13v9',
        ),
      ),
    );
  }
}

if (!function_exists('ifrs_ps_get_intro_helper_editor_steps')) {
  function ifrs_ps_get_intro_helper_editor_steps() {
    $steps = ifrs_ps_get_intro_helper_steps();

    return array_map(function($step) {
      return array(
        'text' => !empty($step['text']) ? wp_kses_post($step['text']) : '',
        'link_text' => !empty($step['link_text']) ? wp_kses_post($step['link_text']) : null,
        'icon_paths' => !empty($step['icon_paths']) && is_array($step['icon_paths']) ? array_values($step['icon_paths']) : array(),
      );
    }, $steps);
  }
}

if (!function_exists('ifrs_ps_get_intro_helper_editor_modalidades')) {
  function ifrs_ps_get_intro_helper_editor_modalidades() {
    $terms = get_terms(array(
      'taxonomy'   => 'modalidade',
      'hide_empty' => false,
    ));

    if (is_wp_error($terms)) {
      return array();
    }

    return array_map(function($term) {
      return array(
        'slug' => sanitize_title($term->slug),
        'name' => sanitize_text_field($term->name),
      );
    }, $terms);
  }
}

add_action('enqueue_block_editor_assets', function() {
  if (!wp_script_is('ps-intro-helper-block', 'enqueued')) {
    return;
  }

  $config = array(
    'steps' => ifrs_ps_get_intro_helper_editor_steps(),
    'modalidades' => ifrs_ps_get_intro_helper_editor_modalidades(),
  );

  wp_add_inline_script(
    'ps-intro-helper-block',
    'window.ifrsPsIntroHelperConfig = ' . wp_json_encode($config) . ';',
    'before'
  );
}, 100);

if (!function_exists('ifrs_ps_get_intro_helper_step_icon')) {
  function ifrs_ps_get_intro_helper_step_icon($index) {
    $steps = ifrs_ps_get_intro_helper_steps();
    $step = !empty($steps[(int) $index]) ? $steps[(int) $index] : array();
    $icon_paths = !empty($step['icon_paths']) && is_array($step['icon_paths'])
      ? $step['icon_paths']
      : array();

    if (empty($icon_paths)) {
      return '';
    }

    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" focusable="false" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">';

    foreach ($icon_paths as $path_d) {
      $svg .= sprintf('<path d="%s" />', esc_attr($path_d));
    }

    $svg .= '</svg>';

    return $svg;
  }
}

if (!function_exists('ifrs_ps_render_intro_helper_block')) {
  function ifrs_ps_render_intro_helper_block($attributes, $content = '') {
    $items = !empty($attributes['items']) && is_array($attributes['items'])
      ? $attributes['items']
      : array();

    $title = !empty($attributes['title'])
      ? wp_kses_post($attributes['title'])
      : '';
    $links_title = !empty($attributes['linksTitle'])
      ? wp_kses_post($attributes['linksTitle'])
      : '';

    $inner_content = !empty($content) ? $content : '';

    $steps = ifrs_ps_get_intro_helper_steps();

    $action = get_post_type_archive_link('curso');
    if (!$action) {
      $action = home_url('/');
    }

    ob_start();
    ?>
    <div class="intro-helper-block">
      <?php if (!empty($title)) : ?>
        <?php
          echo do_blocks(
            sprintf(
              '<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">%s</h2><!-- /wp:heading -->',
              wp_kses_post($title)
            )
          );
        ?>
      <?php endif; ?>

      <div class="intro-helper-block__steps" aria-label="<?php esc_attr_e('Passo a passo simplificado', 'ifrs-ps-theme'); ?>">
        <?php foreach ($steps as $index => $step) : ?>
          <?php
            $step_link_url = !empty($step['link_post_type'])
              ? get_post_type_archive_link($step['link_post_type'])
              : null;
          ?>
          <article class="intro-helper-block__step">
            <div class="intro-helper-block__step-content">
              <span class="intro-helper-block__step-number"><?php echo esc_html($index + 1); ?></span>
              <div class="intro-helper-block__step-icon" aria-hidden="true">
                <?php echo ifrs_ps_get_intro_helper_step_icon($index); ?>
              </div>
              <p class="intro-helper-block__step-text"><?php echo esc_html($step['text']); ?></p>
            </div>
            <?php if (!empty($step_link_url) && !empty($step['link_text'])) : ?>
              <a href="<?php echo esc_url($step_link_url); ?>" class="intro-helper-block__step-link"><?php echo esc_html($step['link_text']); ?></a>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>

      <?php if (!empty($links_title)) : ?>
        <?php
          echo do_blocks(
            sprintf(
              '<!-- wp:heading {"level":3,"className":"intro-helper-block__links-title"} --><h3 class="wp-block-heading intro-helper-block__links-title">%s</h3><!-- /wp:heading -->',
              wp_kses_post($links_title)
            )
          );
        ?>
      <?php endif; ?>

      <?php if (!empty($inner_content)) : ?>
        <div class="intro-helper-block__content"><?php echo $inner_content; ?></div>
      <?php endif; ?>

      <?php if (!empty($items)) : ?>
        <div class="intro-helper-block__links">
          <?php foreach ($items as $item) : ?>
            <?php
              if (!is_array($item)) {
                continue;
              }

              $modalidade = !empty($item['modalidade']) ? sanitize_title($item['modalidade']) : '';
              $frase = !empty($item['frase']) ? sanitize_text_field($item['frase']) : '';

              if (empty($modalidade) || empty($frase) || !term_exists($modalidade, 'modalidade')) {
                continue;
              }
            ?>
            <form method="POST" action="<?php echo esc_url($action); ?>">
              <input type="hidden" name="modalidade" value="<?php echo esc_attr($modalidade); ?>"/>
              <button type="submit" class="btn btn-link"><?php echo esc_html($frase); ?></button>
            </form>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <?php

    return ob_get_clean();
  }
}
