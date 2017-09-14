<?php
if ( ! function_exists('publicacao_post_type') ) {
    function publicacao_post_type() {
        $labels = array(
            'name'               => _x( 'Publicações', 'Post Type General Name', 'ifrs-ps-theme' ),
            'singular_name'      => _x( 'Publicação', 'Post Type Singular Name', 'ifrs-ps-theme' ),
            'menu_name'          => __( 'Publicações', 'ifrs-ps-theme' ),
            'name_admin_bar'     => __( 'Publicações', 'ifrs-ps-theme' ),
            'parent_item_colon'  => __( 'Publicação principal:', 'ifrs-ps-theme' ),
            'all_items'          => __( 'Todas as Publicações', 'ifrs-ps-theme' ),
            'add_new_item'       => __( 'Adicionar Nova Publicação', 'ifrs-ps-theme' ),
            'add_new'            => __( 'Adicionar Nova', 'ifrs-ps-theme' ),
            'new_item'           => __( 'Nova Publicação', 'ifrs-ps-theme' ),
            'edit_item'          => __( 'Editar Publicação', 'ifrs-ps-theme' ),
            'update_item'        => __( 'Atualizar Publicação', 'ifrs-ps-theme' ),
            'view_item'          => __( 'Ver Publicação', 'ifrs-ps-theme' ),
            'search_items'       => __( 'Buscar Publicação', 'ifrs-ps-theme' ),
            'not_found'          => __( 'Não encontrada', 'ifrs-ps-theme' ),
            'not_found_in_trash' => __( 'Não encontrada na Lixeira', 'ifrs-ps-theme' ),
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
			'publish_posts'          => 'manage_publicacoes',
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
            'label'               => __( 'publicacao', 'ifrs-ps-theme' ),
            'description'         => __( 'Publicações', 'ifrs-ps-theme' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'revisions' ),
            'taxonomies'          => array(),
            'hierarchical'        => false,
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
            'capability_type'     => array('publicacao', 'publicacoes'),
            'map_meta_cap'        => true,
            'capabilities'        => $capabilities,
            'rewrite'             => array('slug' => 'publicacoes'),
        );
        register_post_type( 'publicacao', $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'publicacao_post_type', 1 );
}

// MetaBox
add_action( 'cmb2_admin_init', 'publicacao_metaboxes', 1 );
/**
 * Define the metabox and field configurations.
 */
function publicacao_metaboxes() {
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_publicacao_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Arquivos Associados', 'ifrs-ps-theme' ),
        'object_types'  => array( 'publicacao', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => false, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name'    => __( 'Arquivos', 'ifrs-ps-theme'),
        'desc'    => __( 'Clique no botão acima para enviar um ou mais documentos.', 'ifrs-ps-theme' ),
        'id'      => $prefix . 'arquivos',
        'type'    => 'file_list',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        // 'text'    => array(
            // 'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        // ),
        // query_args are passed to wp.media's library query.
        //'query_args' => array(
        //    'type' => 'application/pdf', // Make library only display PDFs.
        //),
    ) );
}
