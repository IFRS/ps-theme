<?php
if ( ! function_exists( 'modalidade_taxonomy' ) ) {
    // Register Custom Taxonomy
    function modalidade_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'ingresso' ),
            'singular_name'              => _x( 'Modalidade', 'Taxonomy Singular Name', 'ingresso' ),
            'menu_name'                  => __( 'Modalidades', 'ingresso' ),
            'all_items'                  => __( 'Todas as Modalidades', 'ingresso' ),
            'parent_item'                => __( 'Modalidade pai', 'ingresso' ),
            'parent_item_colon'          => __( 'Modalidade pai:', 'ingresso' ),
            'new_item_name'              => __( 'Nova Modalidade', 'ingresso' ),
            'add_new_item'               => __( 'Adicionar Nova Modalidade', 'ingresso' ),
            'edit_item'                  => __( 'Editar Modalidade', 'ingresso' ),
            'update_item'                => __( 'Atualizar Modalidade', 'ingresso' ),
            'separate_items_with_commas' => __( 'Modalidades separadas por vírgula', 'ingresso' ),
            'search_items'               => __( 'Buscar Modalidade', 'ingresso' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Modalidades', 'ingresso' ),
            'choose_from_most_used'      => __( 'Escolher pela Modalidade mais usada', 'ingresso' ),
            'not_found'                  => __( 'Não encontrado', 'ingresso' ),
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
        register_taxonomy( 'modalidade', array( 'curso', 'resultado' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'modalidade_taxonomy', 0 );
}

// Single Term
$single_term_modalidade = new Taxonomy_Single_Term( 'modalidade' );
$single_term_modalidade->set( 'priority', 'default' );
// $single_term_modalidade->set( 'context', 'normal' );
// $single_term_modalidade->set( 'metabox_title', __( 'Custom Metabox Title', 'ps20162' ) );
$single_term_modalidade->set( 'force_selection', true );
$single_term_modalidade->set( 'indented', false );
$single_term_modalidade->set( 'allow_new_terms', false );
