<?php
if ( ! function_exists( 'formaingresso_taxonomy' ) ) {
    // Register Custom Taxonomy
    function formaingresso_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Formas de Ingresso', 'Taxonomy General Name', 'ingresso' ),
            'singular_name'              => _x( 'Forma de Ingresso', 'Taxonomy Singular Name', 'ingresso' ),
            'menu_name'                  => __( 'Formas de Ingresso', 'ingresso' ),
            'all_items'                  => __( 'Todas as Formas de Ingresso', 'ingresso' ),
            'parent_item'                => __( 'Forma de Ingresso pai', 'ingresso' ),
            'parent_item_colon'          => __( 'Forma de Ingresso pai:', 'ingresso' ),
            'new_item_name'              => __( 'Nova Forma de Ingresso', 'ingresso' ),
            'add_new_item'               => __( 'Adicionar Nova Forma de Ingresso', 'ingresso' ),
            'edit_item'                  => __( 'Editar Forma de Ingresso', 'ingresso' ),
            'update_item'                => __( 'Atualizar Forma de Ingresso', 'ingresso' ),
            'separate_items_with_commas' => __( 'Formas de Ingresso separadas por vírgula', 'ingresso' ),
            'search_items'               => __( 'Buscar Forma de Ingresso', 'ingresso' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Formas de Ingresso', 'ingresso' ),
            'choose_from_most_used'      => __( 'Escolher pela Forma de Ingresso mais usada', 'ingresso' ),
            'not_found'                  => __( 'Não encontrado', 'ingresso' ),
        );
        $capabilities = array(
    		'manage_terms'       => 'manage_formaingresso',
            'assign_terms'       => 'assign_formaingresso',
    		'edit_terms'         => 'edit_formaingresso',
    		'delete_terms'       => 'delete_formaingresso',
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
        register_taxonomy( 'formaingresso', array( 'resultado' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'formaingresso_taxonomy');
}

// Single Term
$single_term_formaingresso = new Taxonomy_Single_Term( 'formaingresso' );
$single_term_formaingresso->set( 'priority', 'default' );
// $single_term_forma_ingresso->set( 'context', 'normal' );
// $single_term_forma_ingresso->set( 'metabox_title', __( 'Custom Metabox Title', 'ps20162' ) );
$single_term_formaingresso->set( 'force_selection', true );
$single_term_formaingresso->set( 'indented', false );
$single_term_formaingresso->set( 'allow_new_terms', false );
