<?php
// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);

// Permissions & Roles
require_once('inc/permissions.php');

// Custom Header
require_once('inc/custom-header.php');

// Post Thumbnail
require_once('inc/post-thumbnails.php');

// Breadcrumb
require_once('inc/breadcrumb.php');

// Script Condicional
require_once('inc/script_conditional.php');

// Scripts & Styles
require_once('inc/assets.php');

// Menu do Bootstrap
require_once('inc/vendor/bootstrap-navwalker.php');

// Widgets
require_once('inc/widgets/widgets.php');
require_once('inc/widgets/chamadas.php');

// Tamanho do resumo e resumo em páginas
require_once('inc/page-excerpt.php');
require_once('inc/excerpt.php');

// Adicionar PrettyPhoto automaticamente.
require_once('inc/fancybox_rel.php');

// Paginação personalizada
require_once('inc/pagination.php');

// Queries personalizadas em determinados templates.
require_once('inc/custom-queries.php');

// Filtro para buscas vazias
require_once('inc/empty-search-filter.php');

// Taxonomy Single Term
require_once('inc/taxonomy-single-term/class.taxonomy-single-term.php');

// Taxonomies
require_once('inc/taxonomies/campus-taxonomy.php');
require_once('inc/taxonomies/modalidade-taxonomy.php');
require_once('inc/taxonomies/turno-taxonomy.php');
require_once('inc/taxonomies/formaingresso-taxonomy.php');

// Post Types
require_once('inc/post-types/edital.php');
require_once('inc/post-types/curso.php');
require_once('inc/post-types/pergunta.php');
require_once('inc/post-types/publicacao.php');
require_once('inc/post-types/chamada.php');

// Shortcodes
require_once('inc/shortcodes/campi.php');
