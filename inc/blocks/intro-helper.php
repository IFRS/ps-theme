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

if (!function_exists('ifrs_ps_get_intro_helper_step_icon')) {
  function ifrs_ps_get_intro_helper_step_icon($index) {
    switch ((int) $index) {
      case 0:
        return '<svg viewBox="0 0 48 48" focusable="false"><path d="M12 18h24v16H12z" /><path d="M18 18v-4h12v4" /><path d="M24 25l3 2 5-5" /><path d="M16 10h16" /></svg>';
      case 1:
        return '<svg viewBox="0 0 48 48" focusable="false"><path d="M16 10h16l4 4v24H12V10z" /><path d="M18 20h12" /><path d="M18 26h12" /><path d="M18 32h8" /><path d="M31 11v5h5" /></svg>';
      case 2:
        return '<svg viewBox="0 0 48 48" focusable="false"><path d="M12 16h24v20H12z" /><path d="M18 10v8" /><path d="M30 10v8" /><path d="M12 22h24" /><path d="M20 29l3 3 6-7" /></svg>';
      case 3:
        return '<svg viewBox="0 0 48 48" focusable="false"><path d="M14 34V20" /><path d="M24 34V14" /><path d="M34 34V24" /><path d="M10 38h28" /></svg>';
      case 4:
        return '<svg viewBox="0 0 48 48" focusable="false"><path d="M24 11a6 6 0 1 1 0 12a6 6 0 0 1 0-12Z" /><path d="M14 37a10 10 0 0 1 20 0" /><path d="M31 30l3 3 6-7" /></svg>';
    }
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

    $steps = array(
      __('Escolha um Campus e Curso', 'ifrs-ps-theme'),
      __('Leia atentamente o Edital e faça sua Inscrição', 'ifrs-ps-theme'),
      __('Realize a Prova ou acompanhe o Sorteio', 'ifrs-ps-theme'),
      __('Acompanhe os Resultados', 'ifrs-ps-theme'),
      __('Faça sua Pré-matrícula', 'ifrs-ps-theme'),
    );

    $action = get_post_type_archive_link('curso');
    if (!$action) {
      $action = home_url('/');
    }

    ob_start();
    ?>
    <div class="intro-helper-block">
      <?php if (!empty($title)) : ?>
        <h2 class="intro-helper-block__title"><?php echo wp_kses_post($title); ?></h2>
      <?php endif; ?>

      <div class="intro-helper-block__steps" aria-label="<?php esc_attr_e('Passo a passo simplificado', 'ifrs-ps-theme'); ?>">
        <?php foreach ($steps as $index => $step) : ?>
          <article class="intro-helper-block__step">
            <span class="intro-helper-block__step-number"><?php echo esc_html($index + 1); ?></span>
            <div class="intro-helper-block__step-icon" aria-hidden="true">
              <?php echo ifrs_ps_get_intro_helper_step_icon($index); ?>
            </div>
            <p class="intro-helper-block__step-text"><?php echo esc_html($step); ?></p>
          </article>
        <?php endforeach; ?>
      </div>

      <?php if (!empty($links_title)) : ?>
        <h3 class="intro-helper-block__links-title"><?php echo wp_kses_post($links_title); ?></h3>
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
