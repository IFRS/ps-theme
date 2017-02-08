<?php
if ( ! function_exists( 'turno_taxonomy' ) ) {
    // Register Custom Taxonomy
    function turno_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Turnos', 'Taxonomy General Name', 'ingresso' ),
            'singular_name'              => _x( 'Turno', 'Taxonomy Singular Name', 'ingresso' ),
            'menu_name'                  => __( 'Turnos', 'ingresso' ),
            'all_items'                  => __( 'Todos os Turnos', 'ingresso' ),
            'parent_item'                => __( 'Turno pai', 'ingresso' ),
            'parent_item_colon'          => __( 'Turno pai:', 'ingresso' ),
            'new_item_name'              => __( 'Novo Turno', 'ingresso' ),
            'add_new_item'               => __( 'Adicionar Novo Turno', 'ingresso' ),
            'edit_item'                  => __( 'Editar Turno', 'ingresso' ),
            'update_item'                => __( 'Atualizar Turno', 'ingresso' ),
            'separate_items_with_commas' => __( 'Turnos separados por vírgulas', 'ingresso' ),
            'search_items'               => __( 'Buscar Turnos', 'ingresso' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Turnos', 'ingresso' ),
            'choose_from_most_used'      => __( 'Escolher pelo Turno mais usado', 'ingresso' ),
            'not_found'                  => __( 'Não encontrado', 'ingresso' ),
        );
        $capabilities = array(
    		'manage_terms'       => 'manage_turno',
            'assign_terms'       => 'assign_turno',
    		'edit_terms'         => 'edit_turno',
    		'delete_terms'       => 'delete_turno',
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
        register_taxonomy( 'turno', array( 'curso' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'turno_taxonomy', 0 );
}
