<?php
if ( ! function_exists( 'modalidade_taxonomy' ) ) {
    // Register Custom Taxonomy
    function modalidade_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'ifrs-ps-theme' ),
            'singular_name'              => _x( 'Modalidade', 'Taxonomy Singular Name', 'ifrs-ps-theme' ),
            'menu_name'                  => __( 'Modalidades', 'ifrs-ps-theme' ),
            'all_items'                  => __( 'Todas as Modalidades', 'ifrs-ps-theme' ),
            'parent_item'                => __( 'Modalidade pai', 'ifrs-ps-theme' ),
            'parent_item_colon'          => __( 'Modalidade pai:', 'ifrs-ps-theme' ),
            'new_item_name'              => __( 'Nova Modalidade', 'ifrs-ps-theme' ),
            'add_new_item'               => __( 'Adicionar Nova Modalidade', 'ifrs-ps-theme' ),
            'edit_item'                  => __( 'Editar Modalidade', 'ifrs-ps-theme' ),
            'update_item'                => __( 'Atualizar Modalidade', 'ifrs-ps-theme' ),
            'separate_items_with_commas' => __( 'Modalidades separadas por vírgula', 'ifrs-ps-theme' ),
            'search_items'               => __( 'Buscar Modalidade', 'ifrs-ps-theme' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Modalidades', 'ifrs-ps-theme' ),
            'choose_from_most_used'      => __( 'Escolher pela Modalidade mais usada', 'ifrs-ps-theme' ),
            'not_found'                  => __( 'Não encontrado', 'ifrs-ps-theme' ),
        );
        $capabilities = array(
    		'manage_terms'       => 'manage_modalidade',
            'assign_terms'       => 'assign_modalidade',
    		'edit_terms'         => 'edit_modalidade',
    		'delete_terms'       => 'delete_modalidade',
    	);
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => false,
            'capabilities'      => $capabilities,
        );
        register_taxonomy( 'modalidade', array( 'curso' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'modalidade_taxonomy', 0 );
}

// MetaBox
add_action( 'cmb2_admin_init', 'modalidade_metaboxes', 2 );
/**
 * Define the metabox and field configurations.
 */
function modalidade_metaboxes() {
    /**
	 * Taxonomy Modalidade
	 */
    $modalidade_metabox = new_cmb2_box( array(
		'id'           => '_modalidade_taxonomy_metabox',
		'title'        => __( 'Modalidade', 'ifrs-ps-theme' ),
		'object_types' => array( 'curso' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $modalidade_metabox->add_field( array(
        'id'                => '_modalidade_taxonomy',
        'name'              => __( 'Modalidade', 'ifrs-ps-theme' ),
        'taxonomy'          => 'modalidade',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhuma Modalidade encontrada. Por favor, crie alguma Modalidade antes de cadastrar isto.', 'ifrs-ps-theme')
        ),
        'remove_default'    => 'true',
    ) );
}
