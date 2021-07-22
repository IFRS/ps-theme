<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Evento', 'Post Type General Name', 'ifrs-ps-theme' ),
        'singular_name'         => _x( 'Eventos', 'Post Type Singular Name', 'ifrs-ps-theme' ),
        'menu_name'             => __( 'Cronograma', 'ifrs-ps-theme' ),
        'name_admin_bar'        => __( 'Cronograma', 'ifrs-ps-theme' ),
        'archives'              => __( 'Cronograma', 'ifrs-ps-theme' ),
        'attributes'            => __( 'Atributos do Evento', 'ifrs-ps-theme' ),
        'parent_item_colon'     => __( 'Evento pai:', 'ifrs-ps-theme' ),
        'all_items'             => __( 'Todos os Eventos', 'ifrs-ps-theme' ),
        'add_new_item'          => __( 'Adicionar Novo Evento', 'ifrs-ps-theme' ),
        'add_new'               => __( 'Adicionar Novo Evento', 'ifrs-ps-theme' ),
        'new_item'              => __( 'Novo Evento', 'ifrs-ps-theme' ),
        'edit_item'             => __( 'Editar Evento', 'ifrs-ps-theme' ),
        'update_item'           => __( 'Atualizar Evento', 'ifrs-ps-theme' ),
        'view_item'             => __( 'Visualizar Evento', 'ifrs-ps-theme' ),
        'view_items'            => __( 'Visualizar Eventos', 'ifrs-ps-theme' ),
        'search_items'          => __( 'Buscar Evento', 'ifrs-ps-theme' ),
        'not_found'             => __( 'Não encontrado', 'ifrs-ps-theme' ),
        'not_found_in_trash'    => __( 'Não Encontrado na Lixeira', 'ifrs-ps-theme' ),
        'featured_image'        => __( 'Imagem Destaque', 'ifrs-ps-theme' ),
        'set_featured_image'    => __( 'Definir imagem destaque', 'ifrs-ps-theme' ),
        'remove_featured_image' => __( 'Remover imagem destaque', 'ifrs-ps-theme' ),
        'use_featured_image'    => __( 'Usar como imagem destaque', 'ifrs-ps-theme' ),
        'insert_into_item'      => __( 'Inserir no Evento', 'ifrs-ps-theme' ),
        'uploaded_to_this_item' => __( 'Enviado para esse Evento', 'ifrs-ps-theme' ),
        'items_list'            => __( 'Lista de Eventos', 'ifrs-ps-theme' ),
        'items_list_navigation' => __( 'Lista de navegação de Eventos', 'ifrs-ps-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de Eventos', 'ifrs-ps-theme' ),
    );
    $capabilities = array(
        // meta caps (don't assign these to roles)
        'edit_post'              => 'edit_evento',
        'read_post'              => 'read_evento',
        'delete_post'            => 'delete_evento',

        // primitive/meta caps
        'create_posts'           => 'create_eventos',

        // primitive caps used outside of map_meta_cap()
        'edit_posts'             => 'edit_eventos',
        'edit_others_posts'      => 'manage_eventos',
        'publish_posts'          => 'create_eventos',
        'read_private_posts'     => 'read',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'manage_eventos',
        'delete_private_posts'   => 'manage_eventos',
        'delete_published_posts' => 'manage_eventos',
        'delete_others_posts'    => 'manage_eventos',
        'edit_private_posts'     => 'edit_eventos',
        'edit_published_posts'   => 'edit_eventos',
    );
    $args = array(
        'label'                 => __( 'Evento', 'ifrs-ps-theme' ),
        'description'           => __( 'Eventos do Cronograma', 'ifrs-ps-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions' ),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-calendar',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => array('evento', 'eventos'),
        'map_meta_cap'          => true,
        'capabilities'          => $capabilities,
        'rewrite'               => array('slug' => 'cronograma'),
    );
    register_post_type( 'evento', $args );
}, 0 );

add_action( 'cmb2_admin_init', function() {
    $prefix = '_evento_';

    $datas = new_cmb2_box( array(
        'id'            => $prefix . 'datas',
        'title'         => __( 'Datas', 'ifrs-ps-theme' ),
        'object_types'  => array( 'evento' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );

    $datas->add_field( array(
        'name' => '',
        'desc' => 'Em caso de data única, preencha os dois campos com a mesma data.',
        'type' => 'title',
        'id'   => $prefix . 'datas_desc',
    ) );

    $datas->add_field( array(
        'name'        => __( 'De', 'ifrs-ps-theme'),
        'desc'        => __( 'Data de início do evento.', 'ifrs-ps-theme' ),
        'id'          => $prefix . 'data-inicio',
        'type'        => 'text_date_timestamp',
        'date_format' => 'd/m/Y',
        'attributes'  => array(
            'required'    => 'required',
        ),
    ) );

    $datas->add_field( array(
        'name'        => __( 'Até', 'ifrs-ps-theme'),
        'desc'        => __( 'Data de término do evento.', 'ifrs-ps-theme' ),
        'id'          => $prefix . 'data-fim',
        'type'        => 'text_date_timestamp',
        'date_format' => 'd/m/Y',
        'attributes'  => array(
            'required'    => 'required',
        ),
    ) );
}, 5 );

/* Admin Columns */
add_filter( 'manage_evento_posts_columns' , function( $columns ) {
    if (array_key_exists('date', $columns)) {
        $new = array();
        foreach ($columns as $key => $value) {
            if ($key === 'date') {
                $new['datas'] = __('Período', 'ifrs-ps-theme');
            }
            $new[$key] = $value;
        }
        return $new;
    } else {
        return $columns;
    }
} );

add_action( 'manage_evento_posts_custom_column' , function( $column, $post_id ) {
	switch ( $column ) {
		case 'datas':
			$data_inicio = get_post_meta( $post_id, '_evento_data-inicio', true );
            $data_fim = get_post_meta( $post_id, '_evento_data-fim', true );

            echo date_i18n(get_option('date_format'), $data_inicio);

            if ($data_inicio !== $data_fim) {
                echo ' - ';
                echo date_i18n(get_option('date_format'), $data_fim);
            }
		break;
	}
}, 10, 2 );

add_filter( 'manage_edit-evento_sortable_columns', function( $columns ) {
    $columns['datas'] = 'Datas';
    return $columns;
} );

/* Default Sort */
add_filter( 'pre_get_posts', function( $query ) {
    if ($query->is_main_query() && $query->get('post_type') === 'evento') {
        $query->set('meta_key', '_evento_data-inicio');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
    }
    return $query;
} );

/* Archive Title */
add_filter( 'post_type_archive_title', function ( $title ) {
    if ( is_post_type_archive( 'evento' ) ) {
        $title = 'Cronograma';
    }

    return $title;
}, 99 );
