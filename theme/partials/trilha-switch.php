<?php
if (is_admin() || !function_exists('ifrs_ps_get_trilhas') || !function_exists('ifrs_ps_get_current_trilha')) {
  return;
}

$trilhas = ifrs_ps_get_trilhas();
if (empty($trilhas) || is_wp_error($trilhas)) {
  return;
}

$current = ifrs_ps_get_current_trilha();
$current_id = $current ? $current->term_id : 0;
$current_url = isset($_SERVER['REQUEST_URI']) ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])) : home_url('/');
?>
<div class="container my-4">
  <div class="btn-group btn-group-sm flex-wrap" role="group" aria-label="<?php esc_attr_e('Trilha de seleção', 'ifrs-ps-theme'); ?>">
    <?php foreach ($trilhas as $trilha) : ?>
      <?php
        $is_active = $current_id > 0 && $trilha->term_id === $current_id;
        $switch_url = ifrs_ps_get_trilha_switch_url($trilha, $current_url);
      ?>
      <a
        href="<?php echo esc_url($switch_url); ?>"
        class="btn btn-outline-accent <?php echo $is_active ? 'active' : ''; ?>"
        aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
      >
        <?php echo esc_html($trilha->name); ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>
