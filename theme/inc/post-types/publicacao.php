<?php
add_action('init', function () {
  $labels = array(
    'name'               => _x('Publicações', 'Post Type General Name', 'ifrs-ps-theme'),
    'singular_name'      => _x('Publicação', 'Post Type Singular Name', 'ifrs-ps-theme'),
    'menu_name'          => __('Publicações', 'ifrs-ps-theme'),
    'name_admin_bar'     => __('Publicações', 'ifrs-ps-theme'),
    'archives'           => __('Documentos Publicados', 'ifrs-ps-theme'),
    'parent_item_colon'  => __('Publicação principal:', 'ifrs-ps-theme'),
    'all_items'          => __('Todas as Publicações', 'ifrs-ps-theme'),
    'add_new_item'       => __('Adicionar Nova Publicação', 'ifrs-ps-theme'),
    'add_new'            => __('Adicionar Nova', 'ifrs-ps-theme'),
    'new_item'           => __('Nova Publicação', 'ifrs-ps-theme'),
    'edit_item'          => __('Editar Publicação', 'ifrs-ps-theme'),
    'update_item'        => __('Atualizar Publicação', 'ifrs-ps-theme'),
    'view_item'          => __('Ver Publicação', 'ifrs-ps-theme'),
    'search_items'       => __('Buscar Documentos Publicados', 'ifrs-ps-theme'),
    'not_found'          => __('Não encontrada', 'ifrs-ps-theme'),
    'not_found_in_trash' => __('Não encontrada na Lixeira', 'ifrs-ps-theme'),
  );

  $capabilities = array(
    // meta caps (don't assign these to roles)
    'edit_post'              => 'edit_publicacao',
    'read_post'              => 'read_publicacao',
    'delete_post'            => 'delete_publicacao',

    // primitive/meta caps
    'create_posts'           => 'create_publicacoes',

    // primitive caps used outside of map_meta_cap()
    'edit_posts'             => 'edit_publicacoes',
    'edit_others_posts'      => 'manage_publicacoes',
    'publish_posts'          => 'create_publicacoes',
    'read_private_posts'     => 'read',

    // primitive caps used inside of map_meta_cap()
    'read'                   => 'read',
    'delete_posts'           => 'manage_publicacoes',
    'delete_private_posts'   => 'manage_publicacoes',
    'delete_published_posts' => 'manage_publicacoes',
    'delete_others_posts'    => 'manage_publicacoes',
    'edit_private_posts'     => 'edit_publicacoes',
    'edit_published_posts'   => 'edit_publicacoes',
  );

  $args = array(
    'label'               => __('publicacao', 'ifrs-ps-theme'),
    'description'         => __('Publicações', 'ifrs-ps-theme'),
    'labels'              => $labels,
    'supports'            => array('title', 'editor', 'excerpt', 'revisions'),
    'taxonomies'          => array(),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 25,
    'menu_icon'           => 'dashicons-media-text',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => array('publicacao', 'publicacoes'),
    'map_meta_cap'        => true,
    'capabilities'        => $capabilities,
    'rewrite'             => array('slug' => 'publicacoes'),
  );

  register_post_type('publicacao', $args);
}, 5);

add_filter('pre_get_posts', function ($query) {
  if ($query->is_main_query() && $query->is_post_type_archive('publicacao')) {
    $query->set('posts_per_page', -1);
    $query->set('nopaging', true);
    $query->set('post_parent', 0);
    $query->set('orderby', 'date');
    $query->set('order', 'DESC');
  }
  return $query;
});

// Metabox
add_action('cmb2_admin_init', function () {
  $prefix = '_publicacao_';

  $cmb = new_cmb2_box(array(
    'id'            => $prefix . 'metabox',
    'title'         => __('Arquivos da Publicação', 'ifrs-ps-theme'),
    'object_types'  => array('publicacao',),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
  ));

  // $cmb->add_field(array(
  //   'name'    => __('Arquivo Principal', 'ifrs-ps-theme'),
  //   'desc'    => __('Arquivo principal da publicação, em formato PDF.', 'ifrs-ps-theme'),
  //   'id'      => $prefix . 'arquivo',
  //   'type'    => 'file',
  //   'options' => array(
  //     'url' => false, // Hide the text input for the url
  //   ),
  //   'query_args' => array(
  //     'type' => 'application/pdf',
  //   ),
  // ));

  $cmb->add_field(array(
    'name'    => __('Arquivos Principais', 'ifrs-ps-theme'),
    'desc'    => __('Arquivos principais da publicação, como um Edital ou suas retificações, listas, etc. Preferencialmente, em formato PDF.', 'ifrs-ps-theme'),
    'id'      => $prefix . 'arquivos',
    'type'    => 'file_list',
    'options' => array(
      'url' => false,
    ),
  ));

  $cmb->add_field(array(
    'name'    => __('Anexos', 'ifrs-ps-theme'),
    'desc'    => __('Anexos referentes a esta publicação. Preferencialmente, em formato PDF.', 'ifrs-ps-theme'),
    'id'      => $prefix . 'anexos',
    'type'    => 'file_list',
    'options' => array(
      'url' => false,
    ),
  ));

  // $cmb->add_field(array(
  //   'name'    => __('Retificações', 'ifrs-ps-theme'),
  //   'desc'    => __('Retificações desta publicação, em formato PDF.', 'ifrs-ps-theme'),
  //   'id'      => $prefix . 'retificacoes',
  //   'type'    => 'file_list',
  //   'options' => array(
  //     'url' => false,
  //   ),
  //   'query_args' => array(
  //     'type' => 'application/pdf',
  //   ),
  // ));
}, 4);

/* Disable Gutenberg */
add_filter('use_block_editor_for_post_type', function ($current_status, $post_type) {
  if ($post_type === 'publicacao') return false;
  return $current_status;
}, 10, 2);

// Options
add_action('cmb2_admin_init', function () {
  $options = new_cmb2_box(array(
    'id'           => 'ps_publicacao_option_metabox',
    'title'        => esc_html__('Opções para Publicações', 'ifrs-ps-theme'),
    'object_types' => array('options-page'),
    'option_key'      => 'publicacao_options',
    // 'icon_url'        => 'dashicons-palmtree',
    'menu_title'      => esc_html__('Opções', 'ifrs-ps-theme'),
    'parent_slug'     => 'edit.php?post_type=publicacao',
    'capability'      => 'manage_publicacoes',
    // 'position'        => 1,
    // 'admin_menu_hook' => 'network_admin_menu',
    // 'display_cb'      => false,
    // 'save_button'     => esc_html__( 'Salvar Opções', 'ifrs-ps-theme' ),
  ));

  $options->add_field(array(
    'name' => __('Descrição', 'ifrs-ps-theme'),
    'desc' => __('Texto para a lista de Publicações.', 'ifrs-ps-theme'),
    'id'   => 'desc',
    'type' => 'wysiwyg',
    'options' => array(
      'wpautop'       => true,
      'media_buttons' => false,
      'textarea_rows' => get_option('default_post_edit_rows', 10),
      'teeny'         => true,
    ),
  ));
});
