<?php
if ( ! function_exists( 'formaingresso_taxonomy' ) ) {
    // Register Custom Taxonomy
    function formaingresso_taxonomy() {
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
        register_taxonomy( 'formaingresso', array( 'chamada' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'formaingresso_taxonomy');
}

// Single Term
$single_term_formaingresso = new Taxonomy_Single_Term( 'formaingresso' );
$single_term_formaingresso->set( 'priority', 'default' );
// $single_term_forma_ingresso->set( 'context', 'normal' );
// $single_term_forma_ingresso->set( 'metabox_title', __( 'Custom Metabox Title', 'ifrs-ps-theme' ) );
$single_term_formaingresso->set( 'force_selection', true );
$single_term_formaingresso->set( 'indented', false );
$single_term_formaingresso->set( 'allow_new_terms', false );
