<?php
add_filter('use_block_editor_for_post_type', function($current_status, $post_type) {
    if ($post_type === 'edital' || $post_type === 'curso' || $post_type === 'pergunta' || $post_type === 'evento' || $post_type === 'publicacao' || $post_type === 'chamada' || $post_type === 'documento') {
      return false;
    }
    return $current_status;
}, 10, 2);
