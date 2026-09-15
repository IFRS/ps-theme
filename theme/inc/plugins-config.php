<?php
/* YoastSEO Configuration */
// Breadcrumbs
add_theme_support('yoast-seo-breadcrumbs');

// Metabox Priority
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );

// Primary Term Taxonomies
add_filter( 'wpseo_primary_term_taxonomies', '__return_empty_array' );

// Exclude Custom Post Types from Bulk Editor
add_filter( 'wpseo_bulk_editor_excluded_post_types', function( $excluded_post_types ) {
  $excluded_post_types[] = 'chamada';
  $excluded_post_types[] = 'curso';
  $excluded_post_types[] = 'evento';
  $excluded_post_types[] = 'pergunta';
  $excluded_post_types[] = 'publicacao';

  return $excluded_post_types;
} );
