<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Formas de Ingresso', 'Taxonomy General Name', 'ifrs-ps-theme' ),
        'singular_name'              => _x( 'Forma de Ingresso', 'Taxonomy Singular Name', 'ifrs-ps-theme' ),
        'menu_name'                  => __( 'Formas de Ingresso', 'ifrs-ps-theme' ),
        'all_items'                  => __( 'Todas as Formas de Ingresso', 'ifrs-ps-theme' ),
        'parent_item'                => __( 'Forma de Ingresso pai', 'ifrs-ps-theme' ),
        'parent_item_colon'          => __( 'Forma de Ingresso pai:', 'ifrs-ps-theme' ),
        'new_item_name'              => __( 'Nova Forma de Ingresso', 'ifrs-ps-theme' ),
        'add_new_item'               => __( 'Adicionar Nova Forma de Ingresso', 'ifrs-ps-theme' ),
        'edit_item'                  => __( 'Editar Forma de Ingresso', 'ifrs-ps-theme' ),
        'update_item'                => __( 'Atualizar Forma de Ingresso', 'ifrs-ps-theme' ),
        'separate_items_with_commas' => __( 'Formas de Ingresso separadas por vírgula', 'ifrs-ps-theme' ),
        'search_items'               => __( 'Buscar Forma de Ingresso', 'ifrs-ps-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover Formas de Ingresso', 'ifrs-ps-theme' ),
        'choose_from_most_used'      => __( 'Escolher pela Forma de Ingresso mais usada', 'ifrs-ps-theme' ),
        'not_found'                  => __( 'Não encontrado', 'ifrs-ps-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_formaingresso',
        'assign_terms'               => 'assign_formaingresso',
        'edit_terms'                 => 'edit_formaingresso',
        'delete_terms'               => 'delete_formaingresso',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'show_tagcloud'              => false,
        'capabilities'               => $capabilities,
    );

    register_taxonomy( 'formaingresso', array( 'chamada', 'documento' ), $args );
}, 0);

// Metabox
add_action( 'cmb2_admin_init', function() {
    /**
	 * Taxonomy Forma de Ingresso for Chamada
	 */
    $formaingresso_chamada_metabox = new_cmb2_box( array(
		'id'           => '_formaingresso_chamada_taxonomy_metabox',
		'title'        => __( 'Forma de Ingresso', 'ifrs-ps-theme' ),
		'object_types' => array( 'chamada' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $formaingresso_chamada_metabox->add_field( array(
        'id'                => '_formaingresso_chamada_taxonomy',
        'name'              => __( 'Forma de Ingresso', 'ifrs-ps-theme' ),
        'taxonomy'          => 'formaingresso',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhuma Forma de Ingresso encontrada. Por favor, crie alguma Forma de Ingresso antes de cadastrar isto.', 'ifrs-ps-theme')
        ),
        'remove_default'    => 'true',
    ) );

    /**
	 * Taxonomy Forma de Ingresso for Documento
	 */
    $formaingresso_documento_metabox = new_cmb2_box( array(
		'id'           => '_formaingresso_documento_taxonomy_metabox',
		'title'        => __( 'Formas de Ingresso', 'ifrs-ps-theme' ),
		'object_types' => array( 'documento' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $formaingresso_documento_metabox->add_field( array(
        'id'                => '_formaingresso_documento_taxonomy',
        'name'              => __( 'Formas de Ingresso', 'ifrs-ps-theme' ),
        'taxonomy'          => 'formaingresso',
        'type'              => 'taxonomy_multicheck',
        'select_all_button' => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhuma Forma de Ingresso encontrada. Por favor, crie alguma Forma de Ingresso antes de cadastrar isto.', 'ifrs-ps-theme')
        ),
        'remove_default'    => true,
    ) );
}, 2 );
