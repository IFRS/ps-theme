<?php
add_action('init', function() {
    // Fix Media Permissions
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'manage_files';
    $wp_post_types['attachment']->cap->delete_posts = 'manage_files';
});

add_action('after_switch_theme', function() {
    // Cursos Role
    if (!get_role( 'cadastrador_cursos' )) {
        add_role('cadastrador_cursos', __('Cadastrador de Cursos'), array(
            'read'              => true,
            'upload_files'      => true,
            'manage_files'      => true,

            'create_cursos'     => true,
            'edit_cursos'       => true,
            'manage_cursos'     => false,

            'assign_campus'     => true,
            'assign_turno'      => true,
            'assign_modalidade' => true
        ));
    }

    // Chamadas Role
    if (!get_role( 'cadastrador_chamadas' )) {
        add_role('cadastrador_chamadas', __('Cadastrador de Chamadas'), array(
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

    // Editais Role
    if (!get_role( 'cadastrador_editais' )) {
        add_role('cadastrador_editais', __('Cadastrador de Editais'), array(
            'read'                 => true,
            'upload_files'         => true,
            'manage_files'         => true,

            'create_editais'      => true,
            'edit_editais'        => true,
            'manage_editais'      => false
        ));
    }
});

add_action('switch_theme', function() {
    if (get_role( 'cadastrador_cursos' )) {
        remove_role( 'cadastrador_cursos' );
    }
    if (get_role( 'cadastrador_chamadas' )) {
        remove_role( 'cadastrador_chamadas' );
    }
});
