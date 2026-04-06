<?php
add_filter('pre_get_posts', function($query) {
    $search_get = isset($_GET['s']) && !is_array($_GET['s']) ? trim(sanitize_text_field(wp_unslash($_GET['s']))) : null;
    $search_post = isset($_POST['s']) && !is_array($_POST['s']) ? trim(sanitize_text_field(wp_unslash($_POST['s']))) : null;

    if ((($search_get !== null && $search_get === '') || ($search_post !== null && $search_post === '')) && $query->is_main_query()) {
        $query->is_search = false;
    }
    return $query;
});
