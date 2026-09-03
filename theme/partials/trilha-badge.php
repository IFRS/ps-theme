<?php
if (is_admin() || !taxonomy_exists('trilha_selecao') || !function_exists('wp_get_post_terms')) {
  return;
}

$post_id = get_the_ID();
if (empty($post_id)) {
  return;
}

$terms = wp_get_post_terms($post_id, 'trilha_selecao', array('fields' => 'all'));
if (empty($terms) || is_wp_error($terms)) {
  return;
}

$current_trilha = function_exists('ifrs_ps_get_current_trilha') ? ifrs_ps_get_current_trilha() : null;
$current_term_id = $current_trilha && is_object($current_trilha) ? (int) $current_trilha->term_id : 0;
$hide_current = !empty($args['hide_current']);

$visible_terms = array();
foreach ($terms as $term) {
  if ($hide_current && $current_term_id > 0 && (int) $term->term_id === $current_term_id) {
    continue;
  }

  $visible_terms[] = $term;
}

if (empty($visible_terms)) {
  return;
}
?>
<?php foreach ($visible_terms as $term) : ?>
  <span class="badge rounded-pill text-bg-light border border-accent text-accent mb-2 me-1">
    <?php echo esc_html($term->name); ?>
  </span>
<?php endforeach; ?>
