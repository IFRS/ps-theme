<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Campi', 'Taxonomy General Name', 'ifrs-ps-theme' ),
        'singular_name'              => _x( 'Campus', 'Taxonomy Singular Name', 'ifrs-ps-theme' ),
        'menu_name'                  => __( 'Campi', 'ifrs-ps-theme' ),
        'all_items'                  => __( 'Todos os Campi', 'ifrs-ps-theme' ),
        'parent_item'                => __( 'Campus pai', 'ifrs-ps-theme' ),
        'parent_item_colon'          => __( 'Campus pai:', 'ifrs-ps-theme' ),
        'new_item_name'              => __( 'Novo Campus', 'ifrs-ps-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Campus', 'ifrs-ps-theme' ),
        'edit_item'                  => __( 'Editar Campus', 'ifrs-ps-theme' ),
        'update_item'                => __( 'Atualizar Campus', 'ifrs-ps-theme' ),
        'separate_items_with_commas' => __( 'Campi separados por vírgula', 'ifrs-ps-theme' ),
        'search_items'               => __( 'Buscar Campus', 'ifrs-ps-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover Campus', 'ifrs-ps-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo Campus mais usado', 'ifrs-ps-theme' ),
        'not_found'                  => __( 'Não encontrado', 'ifrs-ps-theme' ),
    );
    $capabilities = array(
        'manage_terms'               => 'manage_campus',
        'assign_terms'               => 'assign_campus',
        'edit_terms'                 => 'edit_campus',
        'delete_terms'               => 'delete_campus',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'capabilities'               => $capabilities,
    );
    register_taxonomy( 'campus', array( 'curso', 'chamada' ), $args );
}, 0 );

// Metabox
add_action( 'cmb2_admin_init', function() {
    /**
	 * Taxonomy Campus
	 */
    $campus_metabox = new_cmb2_box( array(
		'id'           => '_campus_taxonomy_metabox',
		'title'        => __( 'Campus', 'ifrs-ps-theme' ),
		'object_types' => array( 'curso', 'chamada' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $campus_metabox->add_field( array(
        'id'                => '_campus_taxonomy',
        'name'              => __( 'Campus', 'ifrs-ps-theme' ),
        'taxonomy'          => 'campus',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhum Campus encontrado. Por favor, crie algum Campus antes de cadastrar isto.', 'ifrs-ps-theme')
        ),
        'remove_default'    => 'true',
    ) );
}, 2 );
