<?php
add_action('init', function() {
  register_block_type('ifrs-ps/cursos-helper', array(
    'api_version'     => 2,
    'render_callback' => 'ifrs_ps_render_cursos_helper_block',
    'attributes'      => array(
      'title' => array(
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

if (!function_exists('ifrs_ps_render_cursos_helper_block')) {
  function ifrs_ps_render_cursos_helper_block($attributes, $content = '') {
    $items = !empty($attributes['items']) && is_array($attributes['items'])
      ? $attributes['items']
      : array();

    $title = !empty($attributes['title'])
      ? sanitize_text_field($attributes['title'])
      : '';

    $inner_content = !empty($content) ? $content : '';

    if (empty($items) && empty($title) && empty($inner_content)) {
      return '';
    }

    $action = get_post_type_archive_link('curso');
    if (!$action) {
      $action = home_url('/');
    }

    ob_start();
    ?>
    <div class="cursos-helper-block">
      <?php if (!empty($title)) : ?>
        <h2 class="cursos-helper-block__title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($inner_content)) : ?>
        <div class="cursos-helper-block__content"><?php echo $inner_content; ?></div>
      <?php endif; ?>

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
    <?php

    return ob_get_clean();
  }
}
