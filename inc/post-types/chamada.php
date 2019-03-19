<?php
if ( ! function_exists('chamada_post_type') ) {
	function chamada_post_type() {
		$labels = array(
			'name'               => _x( 'Chamadas', 'Post Type General Name', 'ifrs-ps-theme' ),
			'singular_name'      => _x( 'Chamada', 'Post Type Singular Name', 'ifrs-ps-theme' ),
			'menu_name'          => __( 'Chamadas', 'ifrs-ps-theme' ),
			'name_admin_bar'     => __( 'Chamadas', 'ifrs-ps-theme' ),
			'parent_item_colon'  => __( 'Chamada mãe:', 'ifrs-ps-theme' ),
			'all_items'          => __( 'Todas os Chamadas', 'ifrs-ps-theme' ),
			'add_new_item'       => __( 'Adicionar Nova Chamada', 'ifrs-ps-theme' ),
			'add_new'            => __( 'Adicionar Nova', 'ifrs-ps-theme' ),
			'new_item'           => __( 'Nova Chamada', 'ifrs-ps-theme' ),
			'edit_item'          => __( 'Editar Chamada', 'ifrs-ps-theme' ),
			'update_item'        => __( 'Atualizar Chamada', 'ifrs-ps-theme' ),
			'view_item'          => __( 'Ver Chamada', 'ifrs-ps-theme' ),
			'search_items'       => __( 'Procurar Chamada', 'ifrs-ps-theme' ),
			'not_found'          => __( 'Não Encontrada', 'ifrs-ps-theme' ),
			'not_found_in_trash' => __( 'Não Encontrada na Lixeira', 'ifrs-ps-theme' ),
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
			'label'                 => __( 'Chamada', 'ifrs-ps-theme' ),
			'description'           => __( 'Chamadas do Processo Seletivo', 'ifrs-ps-theme' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'revisions', 'author' ),
			'taxonomies'            => array( 'campus', 'formaingresso'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 25,
			'menu_icon'             => 'dashicons-media-spreadsheet',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => array('chamada', 'chamadas'),
			'map_meta_cap'          => true,
            'capabilities'          => $capabilities,
			'rewrite'             => array('slug' => 'chamadas'),
		);
		register_post_type( 'chamada', $args );
	}

	// Hook into the 'init' action
	add_action( 'init', 'chamada_post_type', 5 );
}

// MetaBox
add_action( 'cmb2_admin_init', 'chamada_metaboxes', 5 );
/**
 * Define the metabox and field configurations.
 */
function chamada_metaboxes() {
    // Start with an underscore to hide fields from custom fields list
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
	    'desc' => 'Selecione os arquivos com as informações para matrículas. Lembrete: preencha corretamente o título de cada arquivo.',
	    'id'   => $prefix . 'matriculas',
	    'type' => 'file_list',
	) );

	$arquivos->add_field( array(
	    'name' => 'Bancas',
	    'desc' => 'Selecione os arquivos com as informações das bancas de heteroidentificação. Lembrete: preencha corretamente o título de cada arquivo.',
	    'id'   => $prefix . 'bancas',
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

	$resultados_group = $resultados->add_field( array(
	    'id'          => $prefix . 'resultados_group',
	    'type'        => 'group',
	    // 'description' => __( 'Arquivos por modalidade.', 'ifrs-ps-theme' ),
	    'options'     => array(
	        'group_title'   => __( 'Resultado {#}', 'ifrs-ps-theme' ),
	        'add_button'    => __( 'Adicionar outro Resultado', 'ifrs-ps-theme' ),
	        'remove_button' => __( 'Remover Resultado', 'ifrs-ps-theme' ),
	    ),
	) );

	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$resultados->add_group_field( $resultados_group, array(
	    'name'             => 'Modalidade',
	    'desc'             => 'Selecione uma modalidade.',
	    'id'               => 'modalidade',
	    'type'             => 'select',
	    'show_option_none' => true,
	    'options'          => get_terms(array('taxonomy' => 'modalidade', 'fields' => 'id=>name')),
		'attributes'  => array(
			'required' => 'required'
		)
	) );

	$resultados->add_group_field( $resultados_group, array(
		'name' => 'Arquivos',
		'desc' => 'Selecione os arquivos relacionados a este resultado. Lembrete: preencha corretamente o título de cada arquivo.',
		'id'   => 'arquivos',
		'type' => 'file_list',
	) );
}
