<?php
add_action('init', function() {
    // Fix Media Permissions
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'manage_files';
    $wp_post_types['attachment']->cap->delete_posts = 'manage_files';

    // Cursos Role
    if (get_role( 'cadastrador_cursos' )) {
        remove_role( 'cadastrador_cursos' );
    }
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

    // Resultados Role
    if (get_role( 'cadastrador_resultados' )) {
        remove_role( 'cadastrador_resultados' );
    }
    add_role('cadastrador_resultados', __('Cadastrador de Resultados'), array(
        'read'                 => true,
        'upload_files'         => true,
        'manage_files'         => true,

        'create_resultados'    => true,
        'edit_resultados'      => true,
        'manage_resultados'    => false,

        'assign_campus'        => true,
        'assign_formaingresso' => true
    ));
});
