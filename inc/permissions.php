<?php
add_action('init', function() {
    // Fix Media Permissions
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'manage_files';
    $wp_post_types['attachment']->cap->delete_posts = 'manage_files';
});

add_action('after_switch_theme', function() {
    // Conteúdo Roles
    if (!get_role( 'gerente_conteudo' )) {
        add_role('gerente_conteudo', __('Cadastrador de Conteúdo', 'ifrs-ps-theme'), array(
            'read'                 => true,
            'upload_files'         => true,
            'manage_files'         => true,

            'assign_campus'        => true,
            'assign_turno'         => true,
            'assign_modalidade'    => true,
            'assign_formaingresso' => true,

            'create_chamadas'      => true,
            'edit_chamadas'        => true,
            'manage_chamadas'      => true,

            'create_cursos'        => true,
            'edit_cursos'          => true,
            'manage_cursos'        => true,

            'create_editais'       => true,
            'edit_editais'         => true,
            'manage_editais'       => true,

            'create_publicacoes'   => true,
            'edit_publicacoes'     => true,
            'manage_publicacoes'   => true,

            'create_eventos'       => true,
            'edit_eventos'         => true,
            'manage_eventos'       => true,
        ));
    }

    if (!get_role( 'cadastrador_conteudo' )) {
        add_role('cadastrador_conteudo', __('Cadastrador de Conteúdo', 'ifrs-ps-theme'), array(
            'read'               => true,
            'upload_files'       => true,
            'manage_files'       => true,

            'create_cursos'      => true,
            'edit_cursos'        => true,
            'manage_cursos'      => false,

            'assign_campus'      => true,
            'assign_turno'       => true,
            'assign_modalidade'  => true,

            'create_editais'     => true,
            'edit_editais'       => true,
            'manage_editais'     => false,

            'create_publicacoes' => true,
            'edit_publicacoes'   => true,
            'manage_publicacoes' => false,

            'create_eventos'     => true,
            'edit_eventos'       => true,
            'manage_eventos'     => false,
        ));
    }

    // Chamadas Role
    if (!get_role( 'cadastrador_chamadas' )) {
        add_role('cadastrador_chamadas', __('Cadastrador de Chamadas', 'ifrs-ps-theme'), array(
            'read'                 => true,
            'upload_files'         => true,
            'manage_files'         => true,

            'create_chamadas'      => true,
            'edit_chamadas'        => true,
            'manage_chamadas'      => false,

            'assign_campus'        => true,
            'assign_formaingresso' => true
        ));
    }
});

add_action('switch_theme', function() {
    if (get_role( 'gerente_conteudo' )) {
        remove_role( 'gerente_conteudo' );
    }

    if (get_role( 'cadastrador_conteudo' )) {
        remove_role( 'cadastrador_conteudo' );
    }

    if (get_role( 'cadastrador_chamadas' )) {
        remove_role( 'cadastrador_chamadas' );
    }
});
