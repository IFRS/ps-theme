<?php
function ps_custom_queries( $query ) {
    if ($query->is_main_query() & !is_admin()) {
        if ($query->is_post_type_archive('edital')) {
            $query->query_vars['posts_per_page'] = -1;
            $query->query_vars['nopaging'] = true;
            $query->query_vars['post_parent'] = 0;
            $query->query_vars['orderby'] = 'date';
            $query->query_vars['order'] = 'DESC';
        }

        if ($query->is_post_type_archive('curso') || $query->is_tax('modalidade') || $query->is_tax('turno')) {
            $query->set('posts_per_page', -1);
            $query->set('nopaging', true);
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }
}

add_action( 'pre_get_posts', 'ps_custom_queries' );
