<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Cronograma', 'Post Type General Name', 'ifrs-ps-theme' ),
        'singular_name'         => _x( 'Evento', 'Post Type Singular Name', 'ifrs-ps-theme' ),
        'menu_name'             => __( 'Cronograma', 'ifrs-ps-theme' ),
        'name_admin_bar'        => __( 'Cronograma', 'ifrs-ps-theme' ),
        'archives'              => __( 'Datas Importantes', 'ifrs-ps-theme' ),
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
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => array('evento', 'eventos'),
        'map_meta_cap'          => true,
        'capabilities'          => $capabilities,
        'rewrite'               => array('slug' => 'cronograma'),
        'show_in_rest'          => true,
        'rest_base'             => 'cronograma',
    );

    register_post_type( 'evento', $args );
}, 2 );

// Metabox
add_action( 'cmb2_init', function() {
    $prefix = '_evento_';

    $datas = new_cmb2_box( array(
        'id'            => $prefix . 'datas',
        'title'         => __( 'Datas', 'ifrs-ps-theme' ),
        'object_types'  => array( 'evento' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_in_rest'  => WP_REST_Server::READABLE,
    ) );

    $datas->add_field( array(
        'name' => '',
        'desc' => 'Em caso de data única, preencha os dois campos com a mesma data.<br><strong>Atenção</strong>: as datas e horários estão em formato dos EUA.',
        'type' => 'title',
        'id'   => $prefix . 'datas_desc',
        'show_in_rest' => false,
    ) );

    $datas->add_field( array(
        'name'        => __( 'De', 'ifrs-ps-theme'),
        'desc'        => __( 'Data de início do evento.', 'ifrs-ps-theme' ),
        'id'          => $prefix . 'data-inicio',
        'type'        => 'text_datetime_timestamp',
        'default'     => '12:00 AM',
        'attributes'  => array(
            'required'    => 'required',
            'data-timepicker' => json_encode( array(
        		'stepMinute' => 1,
        	) ),
        ),
    ) );

    $datas->add_field( array(
        'name'        => __( 'Até', 'ifrs-ps-theme'),
        'desc'        => __( 'Data de término do evento.', 'ifrs-ps-theme' ),
        'id'          => $prefix . 'data-fim',
        'type'        => 'text_datetime_timestamp',
        'default'     => '11:59 PM',
        'attributes'  => array(
            'required'    => 'required',
            'data-timepicker' => json_encode( array(
        		'stepMinute' => 1,
        	) ),
        ),
    ) );

    $marco = new_cmb2_box( array(
        'id'            => $prefix . 'etapa',
        'title'         => __( 'Etapa Importante', 'ifrs-ps-theme' ),
        'object_types'  => array( 'evento' ),
        'context'       => 'side',
        'priority'      => 'low',
        'show_names'    => false,
    ) );

    $marco->add_field( array(
        'name' => '',
        'desc' => 'Marque caso esse evento seja uma etapa importante do PS.',
        'type' => 'checkbox',
        'id'   => $prefix . 'marco',
    ) );

    $programacao = new_cmb2_box( array(
        'id'            => $prefix . 'programacao',
        'title'         => __( 'Programação de link no Menu', 'ifrs-ps-theme' ),
        'object_types'  => array( 'evento' ),
        'context'       => 'side',
        'priority'      => 'low',
        'show_names'    => false,
    ) );

    $programacao->add_field( array(
        'id'   => $prefix . 'programacao_desc',
        'desc' => __( 'Ao preencher título e endereço, um link será adicionado ao menu principal durante essa etapa.', 'ifrs-ps-theme' ),
        'type' => 'title',
    ) );

    $programacao->add_field( array(
		'name' => __( 'Título', 'ifrs-ps-theme' ),
		'desc' => __( 'Título do item de menu.', 'ifrs-ps-theme' ),
		'id'   => $prefix . 'programacao_titulo',
		'type' => 'text',
	) );

    $programacao->add_field( array(
		'name' => __( 'Endereço', 'ifrs-ps-theme' ),
		'desc' => __( 'Indique a URL para essa etapa.', 'ifrs-ps-theme' ),
		'id'   => $prefix . 'programacao_url',
		'type' => 'text_url',
	) );
}, 5 );

/* Admin Columns */
add_filter( 'manage_evento_posts_columns' , function( $columns ) {
    $pos = array_search('date', array_keys($columns));

    if ($pos) {
        return array_merge(
            array_slice($columns, 0 , $pos),
            array(
                'datas' => __('Período', 'ifrs-ps-theme'),
                'marco' => __('Etapa Importante', 'ifrs-ps-theme'),
            ),
            array_slice($columns, $pos)
        );
    }

    return $columns;
} );

add_action( 'manage_evento_posts_custom_column' , function( $column, $post_id ) {
	switch ( $column ) {
		case 'datas':
			$data_inicio = get_post_meta( $post_id, '_evento_data-inicio', true );
            $data_fim = get_post_meta( $post_id, '_evento_data-fim', true );

            $format = get_option('date_format');

            echo wp_date($format, $data_inicio, new DateTimeZone('UTC'));

            if (date('Ymd', $data_inicio) !== date('Ymd', $data_fim)) {
                echo ' - ';
                echo wp_date($format, $data_fim, new DateTimeZone('UTC'));
            }
		break;
        case 'marco':
            $is_marco = get_post_meta( $post_id, '_evento_marco', true );
            echo !empty($is_marco) ? 'Sim' : '-';
        break;
	}
}, 10, 2 );

/* Custom Query */
add_filter( 'pre_get_posts', function( $query ) {
    if ($query->is_main_query() && $query->is_post_type_archive('evento')) {
        $query->set('posts_per_page', -1);
        $query->set('nopaging', true);
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_key', array('_evento_data-inicio', '_evento_data-fim'));
    }
    return $query;
} );

/* Archive Title */
add_filter( 'post_type_archive_title', function ( $title ) {
    if ( is_post_type_archive( 'evento' ) ) {
        $title = 'Datas Importantes';
    }

    return $title;
}, 99 );

/* Disable Single Template */
add_action( 'template_redirect', function() {
    if ( is_singular( 'evento' ) ) {
        wp_safe_redirect( get_post_type_archive_link( 'evento' ), 308 );
        exit;
    }
} );

/* Disable Gutenberg */
add_filter('use_block_editor_for_post_type', function($current_status, $post_type) {
	if ($post_type === 'evento') return false;
	return $current_status;
}, 10, 2);

/* Options */
add_action( 'cmb2_admin_init', function() {
	$options = new_cmb2_box( array(
		'id'           => 'ps_evento_option_metabox',
		'title'        => esc_html__( 'Opções para Cronograma', 'ifrs-ps-theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'evento_options',
		// 'icon_url'        => 'dashicons-palmtree',
		'menu_title'      => esc_html__( 'Opções', 'ifrs-ps-theme' ),
		'parent_slug'     => 'edit.php?post_type=evento',
		'capability'      => 'manage_eventos',
		// 'position'        => 1,
		// 'admin_menu_hook' => 'network_admin_menu',
		// 'display_cb'      => false,
		// 'save_button'     => esc_html__( 'Salvar Opções', 'ifrs-ps-theme' ),
	) );

	$options->add_field( array(
		'name' => __( 'Descrição', 'ifrs-ps-theme' ),
		'desc' => __( 'Texto para a lista de Eventos.', 'ifrs-ps-theme' ),
		'id'   => 'desc',
		'type' => 'wysiwyg',
		'options' => array(
			'wpautop'       => true,
			'media_buttons' => false,
			'textarea_rows' => get_option('default_post_edit_rows', 10),
			'teeny'         => true,
		),
	) );
} );
