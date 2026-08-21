<?php

function ifrs_ps_get_trilha_post_types()
{
  return array('publicacao', 'curso', 'evento', 'chamada');
}

define('IFRS_PS_TRILHA_META_INICIO', '_trilha_selecao_data_inicio');
define('IFRS_PS_TRILHA_META_FIM', '_trilha_selecao_data_fim');

add_action('init', function () {
  $labels = array(
    'name'                       => _x('Trilhas de Seleção', 'Taxonomy General Name', 'ifrs-ps-theme'),
    'singular_name'              => _x('Trilha de Seleção', 'Taxonomy Singular Name', 'ifrs-ps-theme'),
    'menu_name'                  => __('Trilhas de Seleção', 'ifrs-ps-theme'),
    'all_items'                  => __('Todas as Trilhas', 'ifrs-ps-theme'),
    'parent_item'                => __('Trilha mãe', 'ifrs-ps-theme'),
    'parent_item_colon'          => __('Trilha mãe:', 'ifrs-ps-theme'),
    'new_item_name'              => __('Nova Trilha', 'ifrs-ps-theme'),
    'add_new_item'               => __('Adicionar Nova Trilha', 'ifrs-ps-theme'),
    'edit_item'                  => __('Editar Trilha', 'ifrs-ps-theme'),
    'update_item'                => __('Atualizar Trilha', 'ifrs-ps-theme'),
    'separate_items_with_commas' => __('Trilhas separadas por vírgula', 'ifrs-ps-theme'),
    'search_items'               => __('Buscar Trilha', 'ifrs-ps-theme'),
    'add_or_remove_items'        => __('Adicionar ou remover Trilhas', 'ifrs-ps-theme'),
    'choose_from_most_used'      => __('Escolher pela Trilha mais usada', 'ifrs-ps-theme'),
    'not_found'                  => __('Não encontrada', 'ifrs-ps-theme'),
  );

  $capabilities = array(
    'manage_terms' => 'manage_trilha_selecao',
    'assign_terms' => 'assign_trilha_selecao',
    'edit_terms'   => 'manage_trilha_selecao',
    'delete_terms' => 'manage_trilha_selecao',
  );

  $args = array(
    'labels'            => $labels,
    'hierarchical'      => false,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'show_in_rest'      => true,
    'show_tagcloud'     => false,
    'capabilities'      => $capabilities,
  );

  register_taxonomy('trilha_selecao', ifrs_ps_get_trilha_post_types(), $args);
}, 0);

add_action('cmb2_admin_init', function () {
  $prefix = '_trilha_selecao_';

  $cmb_term = new_cmb2_box(array(
    'id'               => $prefix . 'metabox',
    'title'            => __('Período da Trilha', 'ifrs-ps-theme'),
    'object_types'     => array('term'),
    'taxonomies'       => array('trilha_selecao'),
    'new_term_section' => true,
  ));

  $cmb_term->add_field(array(
    'name' => '',
    'desc' => __('As datas abaixo são preenchidas automaticamente a partir dos eventos do cronograma vinculados a esta trilha. Preencha-as somente quando quiser sobrescrever essa detecção automática.', 'ifrs-ps-theme'),
    'type' => 'title',
    'id'   => $prefix . 'datas_desc',
  ));

  $cmb_term->add_field(array(
    'name'       => __('Data inicial', 'ifrs-ps-theme'),
    'desc'       => __('Data de início da trilha de seleção.', 'ifrs-ps-theme'),
    'id'         => $prefix . 'data_inicio',
    'type'       => 'text_date_timestamp',
    'date_format' => 'd/m/Y',
  ));

  $cmb_term->add_field(array(
    'name'       => __('Data final', 'ifrs-ps-theme'),
    'desc'       => __('Data de término da trilha de seleção.', 'ifrs-ps-theme'),
    'id'         => $prefix . 'data_fim',
    'type'       => 'text_date_timestamp',
    'date_format' => 'd/m/Y',
  ));

  $trilha_metabox = new_cmb2_box(array(
    'id'           => '_trilha_selecao_taxonomy_metabox',
    'title'        => __('Trilha de Seleção', 'ifrs-ps-theme'),
    'object_types' => ifrs_ps_get_trilha_post_types(),
    'context'      => 'side',
    'priority'     => 'high',
    'show_names'   => false,
  ));

  $trilha_metabox->add_field(array(
    'id'               => '_trilha_selecao_taxonomy',
    'name'             => __('Trilha de Seleção', 'ifrs-ps-theme'),
    'taxonomy'         => 'trilha_selecao',
    'type'             => 'taxonomy_multicheck',
    'remove_default'   => true,
    'query_args'       => array(
      'orderby'    => 'name',
      'order'      => 'ASC',
      'hide_empty' => false,
    ),
    'text' => array(
      'no_terms_text' => __('Ops! Nenhuma trilha encontrada. Por favor, crie uma trilha antes de cadastrar este conteúdo.', 'ifrs-ps-theme'),
    ),
  ));
}, 2);

function ifrs_ps_parse_trilha_date_from_post($field_id)
{
  if (!isset($_POST[$field_id])) {
    return false;
  }

  $raw = sanitize_text_field(wp_unslash($_POST[$field_id]));
  if (empty($raw)) {
    return false;
  }

  $formats = array('d/m/Y', 'Y-m-d', 'm/d/Y');

  foreach ($formats as $format) {
    $date = DateTime::createFromFormat($format, $raw);
    if ($date instanceof DateTime) {
      $errors = DateTime::getLastErrors();
      if (!is_array($errors) || ($errors['warning_count'] === 0 && $errors['error_count'] === 0)) {
        $date->setTime(0, 0, 0);
        return $date->getTimestamp();
      }
    }
  }

  $timestamp = strtotime($raw);
  if ($timestamp === false) {
    return false;
  }

  return $timestamp;
}

add_filter('pre_insert_term', function ($term, $taxonomy, $args) {
  if ($taxonomy !== 'trilha_selecao') {
    return $term;
  }

  if (!is_admin()) {
    return $term;
  }

  $start_key = IFRS_PS_TRILHA_META_INICIO;
  $end_key = IFRS_PS_TRILHA_META_FIM;

  $start = ifrs_ps_parse_trilha_date_from_post($start_key);
  $end = ifrs_ps_parse_trilha_date_from_post($end_key);

  $action = isset($_POST['action']) ? sanitize_key(wp_unslash($_POST['action'])) : '';
  $is_edit = in_array($action, array('editedtag', 'inline-save-tax'), true);

  if ($is_edit && isset($_POST['tag_ID'])) {
    $term_id = absint(wp_unslash($_POST['tag_ID']));
    if ($term_id > 0) {
      $stored_start = (int) get_term_meta($term_id, $start_key, true);
      $stored_end = (int) get_term_meta($term_id, $end_key, true);
      if (!array_key_exists($start_key, $_POST) && $stored_start > 0) {
        $start = $stored_start;
      }
      if (!array_key_exists($end_key, $_POST) && $stored_end > 0) {
        $end = $stored_end;
      }
    }
  }

  if ($start && $end && $start > $end) {
    return new WP_Error(
      'trilha_periodo_invalido',
      __('A data inicial da trilha não pode ser maior que a data final.', 'ifrs-ps-theme')
    );
  }

  return $term;
}, 10, 3);

function ifrs_ps_post_has_trilha($post_id)
{
  $terms = wp_get_post_terms($post_id, 'trilha_selecao', array('fields' => 'ids'));
  return !is_wp_error($terms) && !empty($terms);
}

function ifrs_ps_require_trilha_on_save($post_id, $post, $update)
{
  if (!in_array($post->post_type, ifrs_ps_get_trilha_post_types(), true)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (in_array($post->post_status, array('auto-draft', 'trash', 'inherit'), true)) {
    return;
  }

  if (!in_array($post->post_status, array('publish', 'future', 'pending', 'private'), true)) {
    return;
  }

  if (ifrs_ps_post_has_trilha($post_id)) {
    return;
  }

  remove_action('save_post', 'ifrs_ps_require_trilha_on_save', 20);

  wp_update_post(array(
    'ID'          => $post_id,
    'post_status' => 'draft',
  ));

  add_action('save_post', 'ifrs_ps_require_trilha_on_save', 20, 3);

  $user_id = get_current_user_id();
  if ($user_id > 0) {
    set_transient(
      'ifrs_ps_missing_trilha_notice_' . $user_id,
      array(
        'post_id' => $post_id,
        'post_type' => $post->post_type,
      ),
      120
    );
  }
}
add_action('save_post', 'ifrs_ps_require_trilha_on_save', 20, 3);

add_action('admin_notices', function () {
  $user_id = get_current_user_id();
  if ($user_id <= 0) {
    return;
  }

  $notice = get_transient('ifrs_ps_missing_trilha_notice_' . $user_id);
  if (!$notice || !is_array($notice)) {
    return;
  }

  delete_transient('ifrs_ps_missing_trilha_notice_' . $user_id);

  echo '<div class="notice notice-error is-dismissible"><p>';
  echo esc_html__('Este conteúdo voltou para rascunho: é obrigatório selecionar uma Trilha de Seleção antes de publicar.', 'ifrs-ps-theme');
  echo '</p></div>';
});

/**
 * Helpers: resolução, troca e filtragem por Trilha de Seleção.
 */

function ifrs_ps_get_trilha_periodo_eventos($trilha)
{
  $term_id = is_object($trilha) ? (int) $trilha->term_id : (int) $trilha;

  if ($term_id <= 0) {
    return array('inicio' => 0, 'fim' => 0);
  }

  $eventos = get_posts(array(
    'post_type'      => 'evento',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'no_found_rows'  => true,
    'fields'         => 'ids',
    'ps_trilha_periodo_lookup' => true,
    'tax_query'      => array(
      array(
        'taxonomy' => 'trilha_selecao',
        'field'    => 'term_id',
        'terms'    => $term_id,
      ),
    ),
  ));

  $inicio = 0;
  $fim = 0;

  foreach ($eventos as $evento_id) {
    $evento_inicio = (int) get_post_meta($evento_id, '_evento_data-inicio', true);
    $evento_fim = (int) get_post_meta($evento_id, '_evento_data-fim', true);

    if ($evento_inicio > 0 && (!$inicio || $evento_inicio < $inicio)) {
      $inicio = $evento_inicio;
    }

    if ($evento_fim > 0 && $evento_fim > $fim) {
      $fim = $evento_fim;
    }
  }

  return array('inicio' => $inicio, 'fim' => $fim);
}

function ifrs_ps_get_trilha_periodo($trilha)
{
  $term_id = is_object($trilha) ? $trilha->term_id : (int) $trilha;

  if ($term_id <= 0) {
    return array('inicio' => 0, 'fim' => 0);
  }

  $automatico = ifrs_ps_get_trilha_periodo_eventos($term_id);
  $inicio_manual = (int) get_term_meta($term_id, IFRS_PS_TRILHA_META_INICIO, true);
  $fim_manual = (int) get_term_meta($term_id, IFRS_PS_TRILHA_META_FIM, true);

  return array(
    'inicio' => $inicio_manual > 0 ? $inicio_manual : $automatico['inicio'],
    'fim'    => $fim_manual > 0 ? $fim_manual : $automatico['fim'],
  );
}

function ifrs_ps_is_trilha_vigente($trilha, $now = null)
{
  $now = $now ?: current_time('timestamp');
  $periodo = ifrs_ps_get_trilha_periodo($trilha);

  return $periodo['inicio'] > 0 && $periodo['fim'] > 0 && $periodo['inicio'] <= $now && $periodo['fim'] >= $now;
}

function ifrs_ps_get_trilhas($args = array())
{
  $args = wp_parse_args($args, array(
    'taxonomy'   => 'trilha_selecao',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
  ));

  $terms = get_terms($args);

  return is_wp_error($terms) ? array() : $terms;
}

/**
 * Trilha com data_inicio/data_fim abrangendo o instante atual (pode haver mais de uma; usa a de data_inicio mais recente).
 */
function ifrs_ps_get_trilha_vigente()
{
  static $cache = null;

  if (null !== $cache) {
    return false === $cache ? null : $cache;
  }

  $now = current_time('timestamp');

  $terms = array_filter(ifrs_ps_get_trilhas(), function ($term) use ($now) {
    return ifrs_ps_is_trilha_vigente($term, $now);
  });

  usort($terms, function ($left, $right) {
    $left_periodo = ifrs_ps_get_trilha_periodo($left);
    $right_periodo = ifrs_ps_get_trilha_periodo($right);

    return $right_periodo['inicio'] <=> $left_periodo['inicio'];
  });

  $cache = !empty($terms) ? $terms[0] : false;

  return false === $cache ? null : $cache;
}

/**
 * Fallback para quando nenhuma trilha está vigente: a última encerrada.
 */
function ifrs_ps_get_trilha_mais_recente_encerrada()
{
  static $cache = null;

  if (null !== $cache) {
    return false === $cache ? null : $cache;
  }

  $now = current_time('timestamp');

  $terms = array_filter(ifrs_ps_get_trilhas(), function ($term) use ($now) {
    $periodo = ifrs_ps_get_trilha_periodo($term);

    return $periodo['fim'] > 0 && $periodo['fim'] < $now;
  });

  usort($terms, function ($left, $right) {
    $left_periodo = ifrs_ps_get_trilha_periodo($left);
    $right_periodo = ifrs_ps_get_trilha_periodo($right);

    return $right_periodo['fim'] <=> $left_periodo['fim'];
  });

  $cache = !empty($terms) ? $terms[0] : false;

  return false === $cache ? null : $cache;
}

function ifrs_ps_get_trilha_by_slug($slug)
{
  $slug = sanitize_title($slug);

  if (empty($slug)) {
    return null;
  }

  $term = get_term_by('slug', $slug, 'trilha_selecao');

  return ($term && !is_wp_error($term)) ? $term : null;
}

/**
 * Trilha ativa para a requisição atual: permite troca manual via ?trilha=slug
 * e, quando não houver trilha vigente, mantém a listagem mista sem filtro.
 */
function ifrs_ps_get_current_trilha()
{
  static $cache = null;

  if (null !== $cache) {
    return false === $cache ? null : $cache;
  }

  $trilha = null;

  if (!is_admin() && isset($_GET['trilha'])) {
    $trilha = ifrs_ps_get_trilha_by_slug(wp_unslash($_GET['trilha']));
  }

  if (!$trilha) {
    $trilha = ifrs_ps_get_trilha_vigente();
  }

  $trilha = apply_filters('ifrs_ps_current_trilha', $trilha);

  $cache = $trilha ?: false;

  return false === $cache ? null : $cache;
}

/**
 * Monta a URL para trocar a trilha ativa no front-end (usada em seletores "Ver outra trilha").
 */
function ifrs_ps_get_trilha_switch_url($trilha, $url = '')
{
  $slug = is_object($trilha) ? $trilha->slug : sanitize_title($trilha);

  if (empty($slug)) {
    return '';
  }

  if (empty($url)) {
    $url = isset($_SERVER['REQUEST_URI']) ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])) : home_url('/');
  }

  return esc_url(add_query_arg('trilha', $slug, $url));
}

/**
 * Acrescenta o tax_query da trilha (atual, por padrão) a um array de argumentos de WP_Query.
 */
function ifrs_ps_apply_trilha_query_args($query_args, $trilha = null)
{
  $trilha = null !== $trilha ? $trilha : ifrs_ps_get_current_trilha();

  if (!$trilha) {
    return $query_args;
  }

  $term_id = is_object($trilha) ? $trilha->term_id : (int) $trilha;

  if ($term_id <= 0) {
    return $query_args;
  }

  $tax_query = isset($query_args['tax_query']) && is_array($query_args['tax_query']) ? $query_args['tax_query'] : array();

  $tax_query[] = array(
    'taxonomy' => 'trilha_selecao',
    'field'    => 'term_id',
    'terms'    => $term_id,
  );

  $query_args['tax_query'] = $tax_query;

  return $query_args;
}

/**
 * Mesma lógica de ifrs_ps_apply_trilha_query_args, mas aplicada diretamente a um WP_Query (ex.: em pre_get_posts).
 */
function ifrs_ps_set_trilha_on_query(WP_Query $query, $trilha = null)
{
  $args = ifrs_ps_apply_trilha_query_args(
    array('tax_query' => $query->get('tax_query') ?: array()),
    $trilha
  );

  $query->set('tax_query', $args['tax_query']);

  return $query;
}

add_action('pre_get_posts', function ($query) {
  if (is_admin() || !$query->is_main_query() || $query->get('ps_trilha_periodo_lookup')) {
    return;
  }

  $post_types = ifrs_ps_get_trilha_post_types();

  $is_trilha_target = false;

  if (!empty($query->get('post_type'))) {
    $post_type = $query->get('post_type');
    $post_type = is_array($post_type) ? $post_type : array($post_type);
    $is_trilha_target = (bool) array_intersect($post_types, $post_type);
  }

  if (!$is_trilha_target) {
    foreach ($post_types as $post_type) {
      if ($query->is_post_type_archive($post_type) || $query->is_tax('trilha_selecao')) {
        $is_trilha_target = true;
        break;
      }
    }
  }

  if (!$is_trilha_target) {
    return;
  }

  $tax_query = $query->get('tax_query') ?: array();
  $args = ifrs_ps_apply_trilha_query_args(array('tax_query' => $tax_query));
  $query->set('tax_query', $args['tax_query']);
}, 20);
