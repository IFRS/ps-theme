<?php
add_action( 'init', function() {
    $labels = array(
        'name'               => _x( 'Perguntas', 'Post Type General Name', 'ifrs-ps-theme' ),
        'singular_name'      => _x( 'Pergunta', 'Post Type Singular Name', 'ifrs-ps-theme' ),
        'menu_name'          => __( 'Perguntas', 'ifrs-ps-theme' ),
        'name_admin_bar'     => __( 'Perguntas', 'ifrs-ps-theme' ),
        'parent_item_colon'  => __( 'Pergunta principal:', 'ifrs-ps-theme' ),
        'all_items'          => __( 'Todas as Perguntas', 'ifrs-ps-theme' ),
        'add_new_item'       => __( 'Adicionar Nova Pergunta', 'ifrs-ps-theme' ),
        'add_new'            => __( 'Adicionar Nova', 'ifrs-ps-theme' ),
        'new_item'           => __( 'Nova Pergunta', 'ifrs-ps-theme' ),
        'edit_item'          => __( 'Editar Pergunta', 'ifrs-ps-theme' ),
        'update_item'        => __( 'Atualizar Pergunta', 'ifrs-ps-theme' ),
        'view_item'          => __( 'Ver Pergunta', 'ifrs-ps-theme' ),
        'search_items'       => __( 'Buscar Pergunta', 'ifrs-ps-theme' ),
        'not_found'          => __( 'Não encontrada', 'ifrs-ps-theme' ),
        'not_found_in_trash' => __( 'Não encontrada na Lixeira', 'ifrs-ps-theme' ),
    );

    $capabilities = array(
        // meta caps (don't assign these to roles)
        'edit_post'              => 'edit_pergunta',
        'read_post'              => 'read_pergunta',
        'delete_post'            => 'delete_pergunta',

        // primitive/meta caps
        'create_posts'           => 'create_perguntas',

        // primitive caps used outside of map_meta_cap()
        'edit_posts'             => 'edit_perguntas',
        'edit_others_posts'      => 'manage_perguntas',
        'publish_posts'          => 'create_perguntas',
        'read_private_posts'     => 'read',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'manage_perguntas',
        'delete_private_posts'   => 'manage_perguntas',
        'delete_published_posts' => 'manage_perguntas',
        'delete_others_posts'    => 'manage_perguntas',
        'edit_private_posts'     => 'edit_perguntas',
        'edit_published_posts'   => 'edit_perguntas',
    );

    $args = array(
        'label'               => __( 'pergunta', 'ifrs-ps-theme' ),
        'description'         => __( 'Perguntas', 'ifrs-ps-theme' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'revisions' ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-lightbulb',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        //'capability_type'     => array('pergunta', 'perguntas'),
        //'map_meta_cap'        => true,
        //'capabilities'        => $capabilities,
        'rewrite'             => array('slug' => 'perguntas'),
    );

    register_post_type( 'pergunta', $args );
}, 1 );

/* Disable Single Template */
add_action( 'template_redirect', function() {
    if ( is_singular( 'pergunta' ) ) {
        wp_safe_redirect( get_post_type_archive_link( 'pergunta' ), 308 );
        exit;
    }
} );
