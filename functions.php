<?php
// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);

// Permissions & Roles
require_once('lib/permissions.php');

// Custom Header
require_once('lib/custom-header.php');

// Post Thumbnail
require_once('lib/post-thumbnails.php');

// Breadcrumb
require_once('lib/breadcrumb.php');

// Script Condicional
require_once('lib/script_conditional.php');

// Scripts & Styles
require_once('lib/assets.php');

// Menu do Bootstrap
require_once('lib/vendor/bootstrap-navwalker.php');

// Widgets
require_once('lib/widgets/widgets.php');
require_once('lib/widgets/chamadas.php');

// Tamanho do resumo e resumo em páginas
require_once('lib/page-excerpt.php');
require_once('lib/excerpt.php');

// Adicionar PrettyPhoto automaticamente.
require_once('lib/fancybox_rel.php');

// Paginação personalizada
require_once('lib/pagination.php');

// Queries personalizadas em determinados templates.
require_once('lib/custom-queries.php');

// Filtro para buscas vazias
require_once('lib/empty-search-filter.php');

// Taxonomy Single Term
require_once('lib/taxonomy-single-term/class.taxonomy-single-term.php');

// Taxonomies
require_once('lib/taxonomies/campus-taxonomy.php');
require_once('lib/taxonomies/modalidade-taxonomy.php');
require_once('lib/taxonomies/turno-taxonomy.php');
require_once('lib/taxonomies/formaingresso-taxonomy.php');

// Post Types
require_once('lib/post-types/edital.php');
require_once('lib/post-types/curso.php');
require_once('lib/post-types/pergunta.php');
require_once('lib/post-types/publicacao.php');
require_once('lib/post-types/chamada.php');
