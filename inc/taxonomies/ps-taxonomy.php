<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Processos Seletivos', 'Taxonomy General Name', 'ifrs-ps-theme' ),
        'singular_name'              => _x( 'Processo Seletivo', 'Taxonomy Singular Name', 'ifrs-ps-theme' ),
        'menu_name'                  => __( 'Processos Seletivos', 'ifrs-ps-theme' ),
        'all_items'                  => __( 'Todos os Processos', 'ifrs-ps-theme' ),
        'parent_item'                => __( 'Processo Pai', 'ifrs-ps-theme' ),
        'parent_item_colon'          => __( 'Processo Pai:', 'ifrs-ps-theme' ),
        'new_item_name'              => __( 'Novo Processo', 'ifrs-ps-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Processo', 'ifrs-ps-theme' ),
        'edit_item'                  => __( 'Editar Processo', 'ifrs-ps-theme' ),
        'update_item'                => __( 'Atualizar Processo', 'ifrs-ps-theme' ),
        'view_item'                  => __( 'Visualizar Processo', 'ifrs-ps-theme' ),
        'separate_items_with_commas' => __( 'Processos separados com vírgulas', 'ifrs-ps-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Processos', 'ifrs-ps-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo mais usado', 'ifrs-ps-theme' ),
        'popular_items'              => __( 'Processos Populares', 'ifrs-ps-theme' ),
        'search_items'               => __( 'Buscar Processos', 'ifrs-ps-theme' ),
        'not_found'                  => __( 'Não Encontrado', 'ifrs-ps-theme' ),
        'no_terms'                   => __( 'Sem Processos', 'ifrs-ps-theme' ),
        'items_list'                 => __( 'Lista de Processos', 'ifrs-ps-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Processos', 'ifrs-ps-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_ps',
        'edit_terms'                 => 'manage_ps',
        'delete_terms'               => 'manage_ps',
        'assign_terms'               => 'assign_ps',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'capabilities'               => $capabilities,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'ps', array( 'chamada', 'curso', 'documento', 'edital', 'evento', 'publicacao' ), $args );
}, 0 );

// Metabox
add_action( 'cmb2_admin_init', function() {
    /**
     * Taxonomy Modalidade
     */
    $ps_metabox = new_cmb2_box( array(
        'id'                => '_ps_taxonomy_metabox',
        // 'title'             => __( 'Processo Seletivo', 'ifrs-ps-theme' ),
        'object_types'      => array( 'chamada', 'curso', 'documento', 'edital', 'evento', 'publicacao' ),
        'context'           => 'form_top',
        'priority'          => 'high',
        'show_names'        => true,
        'remove_box_wrap'   => true,
    ) );

    $ps_metabox->add_field( array(
        'id'                => '_ps_taxonomy',
        'name'              => __( 'Processo Seletivo', 'ifrs-ps-theme' ),
        'taxonomy'          => 'ps',
        'type'              => 'taxonomy_radio_inline',
        'default_cb'        => 'get_preselected_ps',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhum Processo Seletivo encontrado. Por favor, crie algum Processo Seletivo antes de cadastrar isto.', 'ifrs-ps-theme')
        ),
        'remove_default'    => 'true',
        'attributes'  => array(
            'required'      => 'required',
        ),
    ) );

    /**
     * Options
     */
    $preselect_metabox = new_cmb2_box( array(
		'id'                => 'ps_preselect_metabox',
		'title'             => __( 'Processo Seletivo Padrão', 'ifrs-ps-theme' ),
		'object_types'      => array( 'options-page' ),
        'parent_slug'       => 'options-general.php',
        'option_key'        => 'ps_options',
        'show_names'        => false,
        'save_button'       => esc_html__( 'Salvar PS Padrão', 'ifrs-ps-theme' ),
    ) );

	$preselect_metabox->add_field( array(
        'id'                => 'preselect',
        'name'              => __( 'Processo Seletivo Padrão', 'ifrs-ps-theme' ),
        'taxonomy'          => 'ps',
        'type'              => 'taxonomy_radio_inline',
    ) );
}, 2 );

function get_preselected_ps( $field_args, $field ) {
    return cmb2_get_option( 'ps_options', 'preselect', false );
}
