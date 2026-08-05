<?php
// YoastSEO
add_filter('wpseo_breadcrumb_output_class', function ($class) {
  $class = 'breadcrumb breadcrumb-yoast';
  return $class;
}, 99);

add_filter('wpseo_breadcrumb_output_wrapper', function ($wrapper) {
  $wrapper = 'ol';
  return $wrapper;
}, 99);

add_filter('wpseo_breadcrumb_single_link_wrapper', function ($wrapper) {
  $wrapper = 'li';
  return $wrapper;
}, 99);

add_filter('wpseo_breadcrumb_single_link', function ($link_output) {
  $is_last = strpos($link_output, 'breadcrumb_last') !== false;

  return preg_replace_callback('/<li\b[^>]*>/', function ($matches) use ($is_last) {
    $li_tag = $matches[0];

    if (preg_match('/class=("|\')(.*?)\1/', $li_tag, $class_match)) {
      $classes = preg_split('/\s+/', trim($class_match[2]));
      if (!in_array('breadcrumb-item', $classes, true)) {
        $classes[] = 'breadcrumb-item';
      }
      if ($is_last && !in_array('active', $classes, true)) {
        $classes[] = 'active';
      }

      $new_classes = implode(' ', array_filter($classes));
      $old_class_attr = 'class=' . $class_match[1] . $class_match[2] . $class_match[1];
      $new_class_attr = 'class=' . $class_match[1] . $new_classes . $class_match[1];
      return str_replace($old_class_attr, $new_class_attr, $li_tag);
    }

    $new_classes = $is_last ? 'breadcrumb-item active' : 'breadcrumb-item';
    return preg_replace('/<li\b/', '<li class="' . $new_classes . '"', $li_tag, 1);
  }, $link_output, 1);
}, 99);

// Custom
function ps_breadcrumb()
{
  $home      = 'Home';
  $before    = '<li class="breadcrumb-item active" aria-current="page">';
  $sep       = '';
  $after     = '</li>';

  if (!is_front_page() || is_paged()) {
    echo '<div class="breadcrumb-wrapper">';
    echo '<nav aria-label="Você está em:" class="container">';
    echo '<ol class="breadcrumb">';

    global $post;
    $homeLink = home_url();
    $siteprincipal = get_home_url('1', '/');
    $nomesite = get_bloginfo('name');

    echo '<li class="breadcrumb-item"><a href="' . $homeLink . '">' . $nomesite . '</a> ' . $sep . '</li> ';

    if (is_home()) {
      echo $before . get_the_title(get_option('page_for_posts')) . $after;
    } elseif (is_category()) {
      global $wp_query;
      $cat_obj   = $wp_query->get_queried_object();
      $thisCat   = $cat_obj->term_id;
      $thisCat   = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
        echo get_category_parents($parentCat, true, $sep);
      }
      echo $before . single_cat_title('', false) . $after;
      /* } elseif (is_tax('modalidade')) {
            echo $before . single_term_title('Cursos na modalidade de ensino&nbsp;', false) . $after; */
    } elseif (is_day()) {
      echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
        'Y'
      ) . '</a></li> ';
      echo '<li class="breadcrumb-item"><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
        'F'
      ) . '</a></li> ';
      echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
      echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
        'Y'
      ) . '</a></li> ';
      echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
      echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
      if (get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        $slug      = $post_type->rewrite;
        echo '<li class="breadcrumb-item"><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a></li> ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category();
        $cat = $cat[0];
        echo '<li class="breadcrumb-item">' . get_category_parents($cat, true, $sep) . '</li>';
        echo $before . get_the_title() . $after;
      }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      echo $before . post_type_archive_title('', false) . $after;
    } elseif (is_attachment()) {
      $parent = get_post($post->post_parent);
      $cat    = get_the_category($parent->ID);
      $cat    = $cat[0];
      echo get_category_parents($cat, true, $sep);
      echo '<li class="breadcrumb-item"><a href="' . get_permalink(
        $parent
      ) . '">' . $parent->post_title . '</a></li> ';
      echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
      echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
      $parent_id   = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page          = get_page($parent_id);
        $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title(
          $page->ID
        ) . '</a>' . $sep . '</li>';
        $parent_id     = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) {
        echo $crumb;
      }
      echo $before . get_the_title() . $after;
    } elseif (is_search()) {
      echo $before . 'Resultado da pesquisa: "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . ' ' . $userdata->display_name . $after;
    } elseif (is_404()) {
      echo $before . 'Erro 404' . $after;
    }

    echo '</ol>';
    echo '</nav>';
    echo '</div>';
  }
}
