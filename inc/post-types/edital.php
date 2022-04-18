<?php
add_action( 'init', function() {
    $labels = array(
        'name'               => _x( 'Editais', 'Post Type General Name', 'ifrs-ps-theme' ),
        'singular_name'      => _x( 'Edital', 'Post Type Singular Name', 'ifrs-ps-theme' ),
        'menu_name'          => __( 'Editais', 'ifrs-ps-theme' ),
        'name_admin_bar'     => __( 'Editais', 'ifrs-ps-theme' ),
        'parent_item_colon'  => __( 'Edital principal:', 'ifrs-ps-theme' ),
        'all_items'          => __( 'Todos os Editais', 'ifrs-ps-theme' ),
        'add_new_item'       => __( 'Adicionar Novo Edital', 'ifrs-ps-theme' ),
        'add_new'            => __( 'Adicionar Novo', 'ifrs-ps-theme' ),
        'new_item'           => __( 'Novo Edital', 'ifrs-ps-theme' ),
        'edit_item'          => __( 'Editar Edital', 'ifrs-ps-theme' ),
        'update_item'        => __( 'Atualizar Edital', 'ifrs-ps-theme' ),
        'view_item'          => __( 'Ver Edital', 'ifrs-ps-theme' ),
        'search_items'       => __( 'Buscar Edital', 'ifrs-ps-theme' ),
        'not_found'          => __( 'Não encontrado', 'ifrs-ps-theme' ),
        'not_found_in_trash' => __( 'Não encontrado na Lixeira', 'ifrs-ps-theme' ),
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
        'publish_posts'          => 'create_editais',
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
        'label'               => __( 'edital', 'ifrs-ps-theme' ),
        'description'         => __( 'Editais', 'ifrs-ps-theme' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'revisions', 'page-attributes' ),
        'taxonomies'          => array(),
        'hierarchical'        => true,
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
        'capability_type'     => array('edital', 'editais'),
        'map_meta_cap'        => true,
        'capabilities'        => $capabilities,
        'rewrite'             => array('slug' => 'editais'),
    );

    register_post_type( 'edital', $args );
}, 4 );

// Metabox
add_action( 'cmb2_admin_init', function() {
    $prefix = '_edital_';

    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Arquivos', 'ifrs-ps-theme' ),
        'object_types'  => array( 'edital', ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );

    $cmb->add_field( array(
        'name'    => __( 'Arquivo Principal', 'ifrs-ps-theme'),
        'desc'    => __( 'Clique no botão acima para enviar o arquivo do Edital (somente PDF).', 'ifrs-ps-theme' ),
        'id'      => $prefix . 'arquivo',
        'type'    => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        // 'text'    => array(
            // 'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        // ),
        'query_args' => array(
            'type' => 'application/pdf',
        ),
    ) );

    $cmb->add_field( array(
        'name'    => __( 'Anexos', 'ifrs-ps-theme'),
        'desc'    => __( 'Clique no botão acima para enviar os anexos referentes a esse Edital (somente PDF).', 'ifrs-ps-theme' ),
        'id'      => $prefix . 'anexos',
        'type'    => 'file_list',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        /* 'text' => array(
            'add_upload_files_text' => 'Replacement', // default: "Add or Upload Files"
            'remove_image_text' => 'Replacement', // default: "Remove Image"
            'file_text' => 'Replacement', // default: "File:"
            'file_download_text' => 'Replacement', // default: "Download"
            'remove_text' => 'Replacement', // default: "Remove"
        ), */
        'query_args' => array(
            'type' => 'application/pdf',
        ),
    ) );

    $cmb->add_field( array(
        'name'    => __( 'Retificações', 'ifrs-ps-theme'),
        'desc'    => __( 'Clique no botão acima para enviar as retificações desse Edital (somente PDF).', 'ifrs-ps-theme' ),
        'id'      => $prefix . 'retificacoes',
        'type'    => 'file_list',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        /* 'text' => array(
            'add_upload_files_text' => 'Replacement', // default: "Add or Upload Files"
            'remove_image_text' => 'Replacement', // default: "Remove Image"
            'file_text' => 'Replacement', // default: "File:"
            'file_download_text' => 'Replacement', // default: "Download"
            'remove_text' => 'Replacement', // default: "Remove"
        ), */
        'query_args' => array(
            'type' => 'application/pdf',
        ),
    ) );
}, 1 );

/* Custom Query */
add_filter( 'pre_get_posts', function( $query ) {
    if ($query->is_main_query() && $query->is_post_type_archive('edital')) {
        $query->set('posts_per_page', -1);
        $query->set('nopaging', true);
        $query->set('post_parent', 0);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
    return $query;
} );
