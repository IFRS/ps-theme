<?php
add_action('init', function() {
    // Fix Media Permissions
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'edit_files';
    $wp_post_types['attachment']->cap->delete_posts = 'delete_files';
});

add_action('after_switch_theme', function() {
    // Conteúdo Roles
    if (!get_role('gerente_conteudo')) {
        add_role('gerente_conteudo', __('Gerente de Conteúdo', 'ifrs-ps-theme'), array(
            'read'                 => true,

            'upload_files'         => true,
            'edit_files'           => true,
            'delete_files'         => true,

            'assign_campus'        => true,
            'assign_formaingresso' => true,
            'assign_modalidade'    => true,
            'assign_turno'         => true,

            'create_chamadas'      => true,
            'edit_chamadas'        => true,
            'manage_chamadas'      => true,

            'create_cursos'        => true,
            'edit_cursos'          => true,
            'manage_cursos'        => true,

            'create_documentos'    => true,
            'edit_documentos'      => true,
            'manage_documentos'    => true,

            'create_editais'       => true,
            'edit_editais'         => true,
            'manage_editais'       => true,

            'create_eventos'       => true,
            'edit_eventos'         => true,
            'manage_eventos'       => true,

            'create_publicacoes'   => true,
            'edit_publicacoes'     => true,
            'manage_publicacoes'   => true,
        ));
    }

    if (!get_role('cadastrador_conteudo')) {
        add_role('cadastrador_conteudo', __('Cadastrador de Conteúdo', 'ifrs-ps-theme'), array(
            'read'                 => true,

            'upload_files'         => true,
            'edit_files'           => true,
            // 'delete_files'         => false,

            'assign_campus'        => true,
            'assign_formaingresso' => true,
            'assign_modalidade'    => true,

            'create_cursos'        => true,
            'edit_cursos'          => true,
            // 'manage_cursos'        => false,

            'create_editais'       => true,
            'edit_editais'         => true,
            'manage_editais'       => false,

            'create_eventos'       => true,
            'edit_eventos'         => true,
            // 'manage_eventos'       => false,

            'create_publicacoes'   => true,
            'edit_publicacoes'     => true,
            'manage_publicacoes'   => false,

        ));
    }

    // Chamadas Role
    if (!get_role('cadastrador_chamadas')) {
        add_role('cadastrador_chamadas', __('Cadastrador de Chamadas', 'ifrs-ps-theme'), array(
            'read'                 => true,

            'upload_files'         => true,
            'edit_files'           => true,
            'delete_files'         => true,

            'create_chamadas'      => true,
            'edit_chamadas'        => true,
            // 'manage_chamadas'      => false,

            'assign_campus'        => true,
            'assign_formaingresso' => true,
            'assign_modalidade'    => true,
        ));
    }

    // Administrator
    $administrator = get_role('administrator');

    $administrator->add_cap('manage_campus');
    $administrator->add_cap('manage_formaingresso');
    $administrator->add_cap('manage_modalidade');
    $administrator->add_cap('manage_turno');

    $administrator->add_cap('create_chamadas');
    $administrator->add_cap('edit_chamadas');
    $administrator->add_cap('manage_chamadas');

    $administrator->add_cap('create_cursos');
    $administrator->add_cap('edit_cursos');
    $administrator->add_cap('manage_cursos');

    $administrator->add_cap('create_documentos');
    $administrator->add_cap('edit_documentos');
    $administrator->add_cap('manage_documentos');

    $administrator->add_cap('create_editais');
    $administrator->add_cap('edit_editais');
    $administrator->add_cap('manage_editais');

    $administrator->add_cap('create_eventos');
    $administrator->add_cap('edit_eventos');
    $administrator->add_cap('manage_eventos');

    $administrator->add_cap('create_publicacoes');
    $administrator->add_cap('edit_publicacoes');
    $administrator->add_cap('manage_publicacoes');
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
