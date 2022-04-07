<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Documentos para Chamadas', 'Post Type General Name', 'ifrs-ps-theme' ),
        'singular_name'         => _x( 'Documento para Chamadas', 'Post Type Singular Name', 'ifrs-ps-theme' ),
        'menu_name'             => __( 'Documentos para Chamadas', 'ifrs-ps-theme' ),
        'name_admin_bar'        => __( 'Documentos', 'ifrs-ps-theme' ),
        'archives'              => __( 'Documentos', 'ifrs-ps-theme' ),
        'attributes'            => __( 'Atributos do Documento', 'ifrs-ps-theme' ),
        'parent_item_colon'     => __( 'Documento pai:', 'ifrs-ps-theme' ),
        'all_items'             => __( 'Todos os Conjuntos', 'ifrs-ps-theme' ),
        'add_new_item'          => __( 'Adicionar Novo Conjunto', 'ifrs-ps-theme' ),
        'add_new'               => __( 'Adicionar Novo Conjunto', 'ifrs-ps-theme' ),
        'new_item'              => __( 'Novo Conjunto', 'ifrs-ps-theme' ),
        'edit_item'             => __( 'Editar Conjunto', 'ifrs-ps-theme' ),
        'update_item'           => __( 'Atualizar Conjunto', 'ifrs-ps-theme' ),
        'view_item'             => __( 'Visualizar Conjunto', 'ifrs-ps-theme' ),
        'view_items'            => __( 'Visualizar Conjuntos', 'ifrs-ps-theme' ),
        'search_items'          => __( 'Buscar Conjunto', 'ifrs-ps-theme' ),
        'not_found'             => __( 'Não encontrado', 'ifrs-ps-theme' ),
        'not_found_in_trash'    => __( 'Não Encontrado na Lixeira', 'ifrs-ps-theme' ),
        'featured_image'        => __( 'Imagem Destaque', 'ifrs-ps-theme' ),
        'set_featured_image'    => __( 'Definir imagem destaque', 'ifrs-ps-theme' ),
        'remove_featured_image' => __( 'Remover imagem destaque', 'ifrs-ps-theme' ),
        'use_featured_image'    => __( 'Usar como imagem destaque', 'ifrs-ps-theme' ),
        'insert_into_item'      => __( 'Inserir no Conjunto', 'ifrs-ps-theme' ),
        'uploaded_to_this_item' => __( 'Enviado para esse Conjunto', 'ifrs-ps-theme' ),
        'items_list'            => __( 'Lista de Conjuntos', 'ifrs-ps-theme' ),
        'items_list_navigation' => __( 'Lista de navegação de Conjuntos', 'ifrs-ps-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de Conjuntos', 'ifrs-ps-theme' ),
    );

    $capabilities = array(
        // meta caps (don't assign these to roles)
        'edit_post'              => 'edit_documento',
        'read_post'              => 'read_documento',
        'delete_post'            => 'delete_documento',

        // primitive/meta caps
        'create_posts'           => 'create_documentos',

        // primitive caps used outside of map_meta_cap()
        'edit_posts'             => 'edit_documentos',
        'edit_others_posts'      => 'manage_documentos',
        'publish_posts'          => 'create_documentos',
        'read_private_posts'     => 'read',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'manage_documentos',
        'delete_private_posts'   => 'manage_documentos',
        'delete_published_posts' => 'manage_documentos',
        'delete_others_posts'    => 'manage_documentos',
        'edit_private_posts'     => 'edit_documentos',
        'edit_published_posts'   => 'edit_documentos',
    );

    $args = array(
        'label'                 => __( 'Documento Chamadas', 'ifrs-ps-theme' ),
        'description'           => __( 'Documentos comuns a todas as Chamadas', 'ifrs-ps-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'revisions' ),
        'taxonomies'            => array( 'formaingresso', 'modalidade' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => array('documento', 'documentos'),
        'map_meta_cap'          => true,
        'capabilities'          => $capabilities,
        'rewrite'               => array('slug' => 'documentos'),
    );

    register_post_type( 'documento', $args );
}, 7 );

// Metabox
add_action( 'cmb2_admin_init', function() {
    $prefix = '_documento_';

    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Documentos', 'ifrs-ps-theme' ),
        'object_types'  => array( 'documento' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => false,
    ) );

    $cmb->add_field( array(
        'name'    => __( 'Arquivos', 'ifrs-ps-theme'),
        'desc'    => __( 'Clique no botão acima para enviar os arquivos. Lembre-se de preencher corretamente o título', 'ifrs-ps-theme' ),
        'id'      => $prefix . 'arquivos',
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
        // query_args are passed to wp.media's library query.
        /* 'query_args' => array(
            'type' => 'application/pdf', // Make library only display PDFs.
        ), */
    ) );
}, 5 );
