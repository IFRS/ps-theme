<?php
if ( ! function_exists( 'campus_taxonomy' ) ) {
    // Register Custom Taxonomy
    function campus_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Campi', 'Taxonomy General Name', 'ingresso' ),
            'singular_name'              => _x( 'Campus', 'Taxonomy Singular Name', 'ingresso' ),
            'menu_name'                  => __( 'Campi', 'ingresso' ),
            'all_items'                  => __( 'Todos os Campi', 'ingresso' ),
            'parent_item'                => __( 'Campus pai', 'ingresso' ),
            'parent_item_colon'          => __( 'Campus pai:', 'ingresso' ),
            'new_item_name'              => __( 'Novo Campus', 'ingresso' ),
            'add_new_item'               => __( 'Adicionar Novo Campus', 'ingresso' ),
            'edit_item'                  => __( 'Editar Campus', 'ingresso' ),
            'update_item'                => __( 'Atualizar Campus', 'ingresso' ),
            'separate_items_with_commas' => __( 'Campi separados por vírgula', 'ingresso' ),
            'search_items'               => __( 'Buscar Campus', 'ingresso' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Campus', 'ingresso' ),
            'choose_from_most_used'      => __( 'Escolher pelo Campus mais usado', 'ingresso' ),
            'not_found'                  => __( 'Não encontrado', 'ingresso' ),
        );
        $capabilities = array(
    		'manage_terms'       => 'manage_campus',
            'assign_terms'       => 'assign_campus',
    		'edit_terms'         => 'edit_campus',
    		'delete_terms'       => 'delete_campus',
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
        register_taxonomy( 'campus', array( 'curso', 'resultado' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'campus_taxonomy', 0 );
}

// Single Term
$single_term_campus = new Taxonomy_Single_Term( 'campus' );
$single_term_campus->set( 'priority', 'default' );
// $single_term_campus->set( 'context', 'normal' );
// $single_term_campus->set( 'metabox_title', __( 'Custom Metabox Title', 'ps20162' ) );
$single_term_campus->set( 'force_selection', true );
$single_term_campus->set( 'indented', false );
$single_term_campus->set( 'allow_new_terms', false );
