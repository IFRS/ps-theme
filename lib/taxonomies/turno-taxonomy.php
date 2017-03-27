<?php
if ( ! function_exists( 'turno_taxonomy' ) ) {
    // Register Custom Taxonomy
    function turno_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Turnos', 'Taxonomy General Name', 'ifrs-ps-theme' ),
            'singular_name'              => _x( 'Turno', 'Taxonomy Singular Name', 'ifrs-ps-theme' ),
            'menu_name'                  => __( 'Turnos', 'ifrs-ps-theme' ),
            'all_items'                  => __( 'Todos os Turnos', 'ifrs-ps-theme' ),
            'parent_item'                => __( 'Turno pai', 'ifrs-ps-theme' ),
            'parent_item_colon'          => __( 'Turno pai:', 'ifrs-ps-theme' ),
            'new_item_name'              => __( 'Novo Turno', 'ifrs-ps-theme' ),
            'add_new_item'               => __( 'Adicionar Novo Turno', 'ifrs-ps-theme' ),
            'edit_item'                  => __( 'Editar Turno', 'ifrs-ps-theme' ),
            'update_item'                => __( 'Atualizar Turno', 'ifrs-ps-theme' ),
            'separate_items_with_commas' => __( 'Turnos separados por vírgulas', 'ifrs-ps-theme' ),
            'search_items'               => __( 'Buscar Turnos', 'ifrs-ps-theme' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Turnos', 'ifrs-ps-theme' ),
            'choose_from_most_used'      => __( 'Escolher pelo Turno mais usado', 'ifrs-ps-theme' ),
            'not_found'                  => __( 'Não encontrado', 'ifrs-ps-theme' ),
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
