<?php
if ( ! function_exists('curso_post_type') ) {
    function curso_post_type() {
        $labels = array(
            'name'                => _x( 'Cursos', 'Post Type General Name', 'ifrs-ps-theme' ),
            'singular_name'       => _x( 'Curso', 'Post Type Singular Name', 'ifrs-ps-theme' ),
            'menu_name'           => __( 'Cursos', 'ifrs-ps-theme' ),
            'name_admin_bar'      => __( 'Cursos', 'ifrs-ps-theme' ),
            'parent_item_colon'   => __( 'Curso Pai:', 'ifrs-ps-theme' ),
            'all_items'           => __( 'Todos os Cursos', 'ifrs-ps-theme' ),
            'add_new_item'        => __( 'Adicionar Novo Curso', 'ifrs-ps-theme' ),
            'add_new'             => __( 'Adicionar Novo', 'ifrs-ps-theme' ),
            'new_item'            => __( 'Novo Curso', 'ifrs-ps-theme' ),
            'edit_item'           => __( 'Editar Curso', 'ifrs-ps-theme' ),
            'update_item'         => __( 'Atualizar Curso', 'ifrs-ps-theme' ),
            'view_item'           => __( 'Ver Curso', 'ifrs-ps-theme' ),
            'search_items'        => __( 'Buscar Curso', 'ifrs-ps-theme' ),
            'not_found'           => __( 'Não encontrado', 'ifrs-ps-theme' ),
            'not_found_in_trash'  => __( 'Não encontrado na Lixeira', 'ifrs-ps-theme' ),
        );
        $capabilities = array(
			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_curso',
			'read_post'              => 'read_curso',
			'delete_post'            => 'delete_curso',

			// primitive/meta caps
			'create_posts'           => 'create_cursos',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_cursos',
			'edit_others_posts'      => 'manage_cursos',
			'publish_posts'          => 'create_cursos',
			'read_private_posts'     => 'read',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'manage_cursos',
			'delete_private_posts'   => 'manage_cursos',
			'delete_published_posts' => 'manage_cursos',
			'delete_others_posts'    => 'manage_cursos',
			'edit_private_posts'     => 'edit_cursos',
			'edit_published_posts'   => 'edit_cursos',
		);
        $args = array(
            'label'               => __( 'curso', 'ifrs-ps-theme' ),
            'description'         => __( 'Curso do Portal de Ingresso', 'ifrs-ps-theme' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'revisions' ),
            'taxonomies'          => array( 'campus', 'turno', 'modalidade' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-welcome-learn-more',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => array('curso', 'cursos'),
            'map_meta_cap'        => true,
            'capabilities'        => $capabilities,
            'rewrite'             => array('slug' => 'cursos'),
        );
        register_post_type( 'curso', $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'curso_post_type', 0 );
}

// MetaBox
add_filter( 'rwmb_meta_boxes', 'cursos_meta_boxes' );
function cursos_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Informa&ccedil;&otilde;es do Curso', 'ifrs-ps-theme' ),
        'post_types' => 'curso',
        'fields'     => array(
            array(
                'id'   => 'vagas',
                'name' => __( 'Total de Vagas', 'ifrs-ps-theme' ),
                'type' => 'number',
                'desc' => 'Somente números.',
            ),
            array(
                'id'   => 'duracao',
                'name' => __( 'Dura&ccedil;&atilde;o', 'ifrs-ps-theme' ),
                'type' => 'text',
                'desc' => 'p.ex.: "2 anos", "4 semestres", "1300 horas", etc.',
            ),
        ),
    );

    return $meta_boxes;
}
