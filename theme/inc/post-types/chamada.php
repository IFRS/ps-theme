<?php
add_action( 'init', function() {
	$labels = array(
		'name'                   => _x( 'Chamadas', 'Post Type General Name', 'ifrs-ps-theme' ),
		'singular_name'          => _x( 'Chamada', 'Post Type Singular Name', 'ifrs-ps-theme' ),
		'menu_name'              => __( 'Chamadas', 'ifrs-ps-theme' ),
		'name_admin_bar'         => __( 'Chamadas', 'ifrs-ps-theme' ),
		'archives'               => __( 'Resultados', 'ifrs-ps-theme' ),
		'parent_item_colon'      => __( 'Chamada mãe:', 'ifrs-ps-theme' ),
		'all_items'              => __( 'Todas os Chamadas', 'ifrs-ps-theme' ),
		'add_new_item'           => __( 'Adicionar Nova Chamada', 'ifrs-ps-theme' ),
		'add_new'                => __( 'Adicionar Nova', 'ifrs-ps-theme' ),
		'new_item'               => __( 'Nova Chamada', 'ifrs-ps-theme' ),
		'edit_item'              => __( 'Editar Chamada', 'ifrs-ps-theme' ),
		'update_item'            => __( 'Atualizar Chamada', 'ifrs-ps-theme' ),
		'view_item'              => __( 'Ver Chamada', 'ifrs-ps-theme' ),
		'search_items'           => __( 'Procurar Chamada', 'ifrs-ps-theme' ),
		'not_found'              => __( 'Não Encontrada', 'ifrs-ps-theme' ),
		'not_found_in_trash'     => __( 'Não Encontrada na Lixeira', 'ifrs-ps-theme' ),
	);

	$capabilities = array(
		// meta caps (don't assign these to roles)
		'edit_post'              => 'edit_chamada',
		'read_post'              => 'read_chamada',
		'delete_post'            => 'delete_chamada',

		// primitive/meta caps
		'create_posts'           => 'create_chamadas',

		// primitive caps used outside of map_meta_cap()
		'edit_posts'             => 'edit_chamadas',
		'edit_others_posts'      => 'manage_chamadas',
		'publish_posts'          => 'create_chamadas',
		'read_private_posts'     => 'read',

		// primitive caps used inside of map_meta_cap()
		'read'                   => 'read',
		'delete_posts'           => 'manage_chamadas',
		'delete_private_posts'   => 'manage_chamadas',
		'delete_published_posts' => 'manage_chamadas',
		'delete_others_posts'    => 'manage_chamadas',
		'edit_private_posts'     => 'edit_chamadas',
		'edit_published_posts'   => 'edit_chamadas',
	);

	$args = array(
		'label'                  => __( 'Chamada', 'ifrs-ps-theme' ),
		'description'            => __( 'Chamadas do Processo Seletivo', 'ifrs-ps-theme' ),
		'labels'                 => $labels,
		'supports'               => array( 'title', 'editor', 'revisions', 'author' ),
		'taxonomies'             => array( 'campus', 'formaingresso'),
		'hierarchical'           => false,
		'public'                 => true,
		'show_ui'                => true,
		'show_in_menu'           => true,
		'menu_position'          => 25,
		'menu_icon'              => 'dashicons-media-spreadsheet',
		'show_in_admin_bar'      => true,
		'show_in_rest'           => true,
		'show_in_nav_menus'      => true,
		'can_export'             => true,
		'has_archive'            => true,
		'exclude_from_search'    => false,
		'publicly_queryable'     => true,
		'capability_type'        => array('chamada', 'chamadas'),
		'map_meta_cap'           => true,
		'capabilities'           => $capabilities,
		'rewrite'                => array('slug' => 'chamadas'),
	);

	register_post_type( 'chamada', $args );
}, 6 );

// Metabox
add_action( 'cmb2_admin_init', function() {
	$prefix = '_chamada_';

	$arquivos = new_cmb2_box( array(
		'id'            => $prefix . 'arquivos_metabox',
		'title'         => __( 'Arquivos Gerais da Chamada', 'ifrs-ps-theme' ),
		'object_types'  => array( 'chamada', ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$arquivos->add_field( array(
	    'name' => 'Matrículas',
	    'desc' => 'Selecione os arquivos com as informações para <em>matrículas</em>.<br><strong>Lembrete:</strong> preencha corretamente o título de cada arquivo.',
	    'id'   => $prefix . 'matriculas',
	    'type' => 'file_list',
	) );

	$arquivos->add_field( array(
	    'name' => 'Bancas de Heteroidentificação',
	    'desc' => 'Selecione os arquivos com as informações das <em>bancas de heteroidentificação</em>.<br><strong>Lembrete:</strong> preencha corretamente o título de cada arquivo.',
	    'id'   => $prefix . 'bancas',
	    'type' => 'file_list',
	) );

	$arquivos->add_field( array(
	    'name' => 'Análise de Renda',
	    'desc' => 'Selecione os arquivos com as informações da <em>análise de reserva de vagas para renda inferior a 1,5 salário mínimo</em>.<br><strong>Lembrete:</strong> preencha corretamente o título de cada arquivo.',
	    'id'   => $prefix . 'renda',
	    'type' => 'file_list',
	) );

	$resultados = new_cmb2_box( array(
		'id'            => $prefix . 'resultados_metabox',
		'title'         => __( 'Resultados da Chamada', 'ifrs-ps-theme' ),
		'object_types'  => array( 'chamada', ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$resultados->add_field( array(
		'name' => 'Atenção',
		'desc' => __( 'Caso não haja resultados para uma modalidade específica, não carregue arquivos nela. Dessa forma, essa modalidade não aparecerá no site.', 'ifrs-ps-theme' ),
		'type' => 'title',
		'id'   => $prefix . 'aviso_resultados',
	) );

	$modalidades = get_terms(array('taxonomy' => 'modalidade', 'orderby' => 'term_order'));

	foreach ($modalidades as $modalidade) {
		$resultados->add_field( array(
			'name' => $modalidade->name,
			'desc' => 'Selecione os arquivos relacionados a esta modalidade.<br><strong>Lembrete:</strong> preencha corretamente o título de cada arquivo.',
			'id'   => $prefix . 'modalidade_' . $modalidade->slug,
			'type' => 'file_list',
		) );
	}
}, 5 );

// Custom Title
add_filter( 'pre_get_document_title', function($title) {
	if (is_singular('chamada')) {
		global $post;
		$campi = get_the_terms($post->ID, 'campus');
		$formasingresso = get_the_terms($post->ID, 'formaingresso');
		return get_the_title($post) . ' | ' . $formasingresso[0]->name . ' | ' . __('Campus ', 'ifrs-ps-theme') . $campi[0]->name . ' - ' . get_bloginfo('name');
	}

	return $title;
}, 99 );

// Options
add_action( 'cmb2_admin_init', function() {
	$options = new_cmb2_box( array(
		'id'           => 'ps_chamada_option_metabox',
		'title'        => esc_html__( 'Opções para Chamadas', 'ifrs-ps-theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'chamada_options',
		// 'icon_url'        => 'dashicons-palmtree',
		'menu_title'      => esc_html__( 'Opções', 'ifrs-ps-theme' ),
		'parent_slug'     => 'edit.php?post_type=chamada',
		'capability'      => 'manage_chamadas',
		// 'position'        => 1,
		// 'admin_menu_hook' => 'network_admin_menu',
		// 'display_cb'      => false,
		// 'save_button'     => esc_html__( 'Salvar Opções', 'ifrs-ps-theme' ),
	) );

	$options->add_field( array(
		'name' => __( 'Publicar Chamadas', 'ifrs-ps-theme' ),
		'desc' => __( 'Marque para que a área de Chamadas apareça na página inicial.', 'ifrs-ps-theme' ),
		'id'   => 'publish',
		'type' => 'checkbox',
	) );

	$options->add_field( array(
		'name' => __( 'Título', 'ifrs-ps-theme' ),
		'desc' => __( 'Título da área de Chamadas na página inicial.', 'ifrs-ps-theme' ),
		'id'   => 'title',
		'type' => 'text',
	) );

	$options->add_field( array(
		'name' => __( 'Descrição', 'ifrs-ps-theme' ),
		'desc' => __( 'Texto da área de Chamadas na página inicial.', 'ifrs-ps-theme' ),
		'id'   => 'desc',
		'type' => 'wysiwyg',
		'options' => array(
			'wpautop'       => true,
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 10),
			'teeny'         => true,
		),
	) );

	$formasingresso = get_terms(array(
		'taxonomy' => 'formaingresso',
		'orderby'  => 'name',
		'fields'   => 'id=>name',
	));

	$options->add_field( array(
		'name'              => __( 'Formas de Ingresso', 'ifrs-ps-theme' ),
		'desc'              => __( 'Marque quais formas de ingresso serão disponibilizadas.', 'ifrs-ps-theme' ),
		'id'                => 'formas',
		'type'              => 'multicheck',
		'select_all_button' => false,
		'options'           => $formasingresso,
	) );

} );

function chamada_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		return cmb2_get_option( 'chamada_options', $key, $default );
	}

	$opts = get_option( 'chamada_options', $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}

// Arquivos
add_action( 'cmb2_admin_init', function() {
	$files = new_cmb2_box( array(
		'id'           => 'ps_chamada_files_metabox',
		'title'        => esc_html__( 'Arquivos para Chamadas', 'ifrs-ps-theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'chamada_files',
		// 'icon_url'        => 'dashicons-palmtree',
		'menu_title'      => esc_html__( 'Arquivos', 'ifrs-ps-theme' ),
		'parent_slug'     => 'edit.php?post_type=chamada',
		'capability'      => 'manage_chamadas',
		// 'position'        => 1,
		// 'admin_menu_hook' => 'network_admin_menu',
		// 'display_cb'      => false,
		'save_button'     => esc_html__( 'Salvar Arquivos', 'ifrs-ps-theme' ),
	) );

	$files->add_field( array(
		'name'       => __( 'Matrícula', 'ifrs-ps-theme' ),
		'desc'       => __( 'Arquivos para a matrícula.', 'ifrs-ps-theme' ),
		'id'         => 'matricula',
		'type'       => 'file_list',
		'query_args' => array( 'type' => 'application/pdf' ),
	) );

	$files->add_field( array(
		'name'       => __( 'Bancas de Heteroidentificação', 'ifrs-ps-theme' ),
		'desc'       => __( 'Arquivos para as bancas de heteroidentificação.', 'ifrs-ps-theme' ),
		'id'         => 'bancas',
		'type'       => 'file_list',
		'query_args' => array( 'type' => 'application/pdf' ),
	) );

	$files->add_field( array(
		'name'       => __( 'Análise de Renda', 'ifrs-ps-theme' ),
		'desc'       => __( 'Arquivos para a análise de renda.', 'ifrs-ps-theme' ),
		'id'         => 'renda',
		'type'       => 'file_list',
		'query_args' => array( 'type' => 'application/pdf' ),
	) );
} );

/* Admin Filter */
add_action( 'restrict_manage_posts', function( $post_type ) {
	if ($post_type !== 'chamada') {
		return;
	}

	$taxonomies_slugs = array(
		'campus',
		'formaingresso',
	);

	foreach ($taxonomies_slugs as $slug) {
		$taxonomy = get_taxonomy( $slug );

		$selected = '';
		$selected = isset( $_REQUEST[ $slug ] ) ? $_REQUEST[ $slug ] : '';

		wp_dropdown_categories( array(
			'show_option_all' =>  $taxonomy->labels->all_items,
			'taxonomy'        =>  $slug,
			'name'            =>  $slug,
			'orderby'         =>  'name',
			'value_field'     =>  'slug',
			'selected'        =>  $selected,
			'hierarchical'    =>  true,
		) );
	}
}, 10, 1 );

// REST API
add_filter( 'rest_prepare_chamada', function( $data, $post, $context ) {
	$data->data['modalidades'] = array();

	$modalidades = get_terms(array('taxonomy' => 'modalidade', 'orderby' => 'term_order'));

	foreach ($modalidades as $modalidade) {
		$resultados = (array) get_post_meta(get_the_ID(), '_chamada_modalidade_' . $modalidade->slug);
		if (!empty($resultados)) $data->data['modalidades'][] = $modalidade->name;
	}
	return $data;
}, 10, 3 );

/* Disable Gutenberg */
add_filter('use_block_editor_for_post_type', function($current_status, $post_type) {
	if ($post_type === 'chamada') return false;
	return $current_status;
}, 10, 2);
