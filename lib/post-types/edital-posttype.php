<?php
if ( ! function_exists('edital_post_type') ) {
    function edital_post_type() {
        $labels = array(
            'name'               => _x( 'Editais', 'Post Type General Name', 'ingresso' ),
            'singular_name'      => _x( 'Edital', 'Post Type Singular Name', 'ingresso' ),
            'menu_name'          => __( 'Editais', 'ingresso' ),
            'name_admin_bar'     => __( 'Editais', 'ingresso' ),
            'parent_item_colon'  => __( 'Edital principal:', 'ingresso' ),
            'all_items'          => __( 'Todos os Editais', 'ingresso' ),
            'add_new_item'       => __( 'Adicionar Novo Edital', 'ingresso' ),
            'add_new'            => __( 'Adicionar Novo', 'ingresso' ),
            'new_item'           => __( 'Novo Edital', 'ingresso' ),
            'edit_item'          => __( 'Editar Edital', 'ingresso' ),
            'update_item'        => __( 'Atualizar Edital', 'ingresso' ),
            'view_item'          => __( 'Ver Edital', 'ingresso' ),
            'search_items'       => __( 'Buscar Edital', 'ingresso' ),
            'not_found'          => __( 'Não encontrado', 'ingresso' ),
            'not_found_in_trash' => __( 'Não encontrado na Lixeira', 'ingresso' ),
        );
        $capabilities = array(
			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_edital',
			'read_post'              => 'read_edital',
			'delete_post'            => 'delete_edital',

			// primitive/meta caps
			'create_posts'           => 'create_editais',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_editais',
			'edit_others_posts'      => 'manage_editais',
			'publish_posts'          => 'manage_editais',
			'read_private_posts'     => 'read',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'manage_editais',
			'delete_private_posts'   => 'manage_editais',
			'delete_published_posts' => 'manage_editais',
			'delete_others_posts'    => 'manage_editais',
			'edit_private_posts'     => 'edit_editais',
			'edit_published_posts'   => 'edit_editais',
		);
        $args = array(
            'label'               => __( 'edital', 'ingresso' ),
            'description'         => __( 'Editais', 'ingresso' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'revisions', 'page-attributes' ),
            'taxonomies'          => array(),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-media-text',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => array('edital', 'editais'),
            'map_meta_cap'        => true,
            'capabilities'        => $capabilities,
            'rewrite'             => array('slug' => 'editais'),
        );
        register_post_type( 'edital', $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'edital_post_type', 0 );
}

// MetaBox
add_filter( 'rwmb_meta_boxes', 'editais_meta_boxes' );
function editais_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Arquivo Associado', 'ps20162' ),
        'post_types' => 'edital',
        'fields'     => array(
            array(
                // TODO: mudar o id para 'edital_file'.
                'id'               => 'upload_file',
                'name'             => __( 'Arquivo', 'ps20162' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'desc'             => 'Clique no botão acima para enviar um documento. Após o término do envio, clique em "Selecionar". ',
            ),
        ),
    );

    return $meta_boxes;
}
