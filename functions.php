<?php
// Carregamento eficiente de fontes
require_once('inc/fonts.php');

// Remove a versão do WP
require_once('inc/remove-version.php');

// Desabilita o suporte a emojis
require_once('inc/disable-emojis.php');

// Permissions & Roles
require_once('inc/permissions.php');

// Resource Hints
require_once('inc/resource-hints.php');

// Configuração do Tema
require_once('inc/theme-config.php');

// Scripts & Styles
require_once('inc/assets.php');

// Breadcrumb
require_once('inc/breadcrumb.php');

// Widgets
require_once('inc/widgets/chamadas.php');

// Tamanho do resumo e resumo em páginas
require_once('inc/page-excerpt.php');
require_once('inc/excerpt.php');

// Paginação personalizada
require_once('inc/pagination.php');

// Queries personalizadas em determinados templates.
require_once('inc/custom-queries.php');

// Controla a busca com termo vazio
require_once('inc/empty-search.php');

// Função para mostrar tempo relativo
require_once('inc/relative-time.php');

// Taxonomies
require_once('inc/taxonomies/campus-taxonomy.php');
require_once('inc/taxonomies/modalidade-taxonomy.php');
require_once('inc/taxonomies/turno-taxonomy.php');
require_once('inc/taxonomies/formaingresso-taxonomy.php');

// Custom Post Types
require_once('inc/post-types/edital.php');
require_once('inc/post-types/curso.php');
require_once('inc/post-types/pergunta.php');
require_once('inc/post-types/publicacao.php');
require_once('inc/post-types/chamada.php');
require_once('inc/post-types/documento.php');

// Shortcodes
require_once('inc/shortcodes/campi.php');
