<?php
if ( ! function_exists('resultado_post_type') ) {
	function resultado_post_type() {
		$labels = array(
			'name'               => _x( 'Resultados', 'Post Type General Name', 'ifrs-ps-theme' ),
			'singular_name'      => _x( 'Resultado', 'Post Type Singular Name', 'ifrs-ps-theme' ),
			'menu_name'          => __( 'Resultados', 'ifrs-ps-theme' ),
			'name_admin_bar'     => __( 'Resultados', 'ifrs-ps-theme' ),
			'parent_item_colon'  => __( 'Resultado pai:', 'ifrs-ps-theme' ),
			'all_items'          => __( 'Todos os Resultados', 'ifrs-ps-theme' ),
			'add_new_item'       => __( 'Adicionar Novo Resultado', 'ifrs-ps-theme' ),
			'add_new'            => __( 'Adicionar Novo', 'ifrs-ps-theme' ),
			'new_item'           => __( 'Novo Resultado', 'ifrs-ps-theme' ),
			'edit_item'          => __( 'Editar Resultado', 'ifrs-ps-theme' ),
			'update_item'        => __( 'Atualizar Resultado', 'ifrs-ps-theme' ),
			'view_item'          => __( 'Ver Resultado', 'ifrs-ps-theme' ),
			'search_items'       => __( 'Procurar Resultado', 'ifrs-ps-theme' ),
			'not_found'          => __( 'Não Encontrado', 'ifrs-ps-theme' ),
			'not_found_in_trash' => __( 'Não Encontrado na Lixeira', 'ifrs-ps-theme' ),
		);
		$capabilities = array(
			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_resultado',
			'read_post'              => 'read_resultado',
			'delete_post'            => 'delete_resultado',

			// primitive/meta caps
			'create_posts'           => 'create_resultados',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_resultados',
			'edit_others_posts'      => 'manage_resultados',
			'publish_posts'          => 'create_resultados',
			'read_private_posts'     => 'read',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'manage_resultados',
			'delete_private_posts'   => 'manage_resultados',
			'delete_published_posts' => 'manage_resultados',
			'delete_others_posts'    => 'manage_resultados',
			'edit_private_posts'     => 'edit_resultados',
			'edit_published_posts'   => 'edit_resultados',
		);
		$args = array(
			'label'                 => __( 'Resultado', 'ifrs-ps-theme' ),
			'description'           => __( 'Resultados do Processo Seletivo', 'ifrs-ps-theme' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'revisions' ),
			'taxonomies'            => array( 'campus', 'modalidade' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-media-spreadsheet',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => array('resultado', 'resultados'),
			'map_meta_cap'          => true,
            'capabilities'          => $capabilities,
			'rewrite'             => array('slug' => 'resultados'),
		);
		register_post_type( 'resultado', $args );
	}

	// Hook into the 'init' action
	add_action( 'init', 'resultado_post_type', 0 );
}

// MetaBox
add_filter( 'rwmb_meta_boxes', 'resultados_meta_boxes' );
function resultados_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Arquivos do Resultado', 'ifrs-ps-theme' ),
        'post_types' => 'resultado',
        'fields'     => array(
			array(
                'id'   => 'resultado_files',
                'name' => __( 'Lista de Arquivos', 'ifrs-ps-theme' ),
                'type' => 'file_advanced',
                'desc' => 'Selecione os arquivos relacionados a este resultado. Lembrete: preencha corretamente o título e o texto alternativo de cada arquivo.',
            ),
        ),
    );

    return $meta_boxes;
}
