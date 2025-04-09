<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Níveis', 'Taxonomy General Name', 'ifrs-ps-theme' ),
        'singular_name'              => _x( 'Nível', 'Taxonomy Singular Name', 'ifrs-ps-theme' ),
        'menu_name'                  => __( 'Níveis', 'ifrs-ps-theme' ),
        'all_items'                  => __( 'Todos os Níveis', 'ifrs-ps-theme' ),
        'parent_item'                => __( 'Nível pai', 'ifrs-ps-theme' ),
        'parent_item_colon'          => __( 'Nível pai:', 'ifrs-ps-theme' ),
        'new_item_name'              => __( 'Novo Nível', 'ifrs-ps-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Nível', 'ifrs-ps-theme' ),
        'edit_item'                  => __( 'Editar Nível', 'ifrs-ps-theme' ),
        'update_item'                => __( 'Atualizar Nível', 'ifrs-ps-theme' ),
        'separate_items_with_commas' => __( 'Níveis separados por vírgula', 'ifrs-ps-theme' ),
        'search_items'               => __( 'Buscar Nível', 'ifrs-ps-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover Níveis', 'ifrs-ps-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo Nível mais usado', 'ifrs-ps-theme' ),
        'not_found'                  => __( 'Não encontrado', 'ifrs-ps-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_modalidade',
        'assign_terms'               => 'assign_modalidade',
        'edit_terms'                 => 'edit_modalidade',
        'delete_terms'               => 'delete_modalidade',
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

    register_taxonomy( 'modalidade', array( 'curso', 'documento' ), $args );
}, 0 );

// Metabox
add_action( 'cmb2_admin_init', function() {
    /**
	 * Taxonomy Modalidade
	 */
    $modalidade_metabox = new_cmb2_box( array(
		'id'           => '_modalidade_taxonomy_metabox',
		'title'        => __( 'Nível', 'ifrs-ps-theme' ),
		'object_types' => array( 'curso', 'documento' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $modalidade_metabox->add_field( array(
        'id'                => '_modalidade_taxonomy',
        'name'              => __( 'Nível', 'ifrs-ps-theme' ),
        'taxonomy'          => 'modalidade',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhum Nível encontrado. Por favor, crie algum Nível antes de cadastrar isto.', 'ifrs-ps-theme')
        ),
        'remove_default'    => 'true',
    ) );
}, 2 );
