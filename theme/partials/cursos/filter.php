<?php
  $taxonomies = array();
  $taxonomies[] = get_taxonomy( 'campus' );
  $taxonomies[] = get_taxonomy( 'modalidade' );
  $taxonomies[] = get_taxonomy( 'turno' );
  // $taxonomies[] = get_taxonomy( 'formaingresso' );
?>
<form class="cursos__filters" method="POST" action="<?php echo esc_url(get_post_type_archive_link( 'curso' )); ?>">
  <div class="row g-2 align-items-center justify-content-start">
    <?php foreach ($taxonomies as $taxonomy) : ?>
    <div class="col-auto">
      <?php $field_id = uniqid(); ?>
      <label for="<?php echo $field_id; ?>" class="visually-hidden"><?php echo $taxonomy->labels->singular_name ?></label>
      <?php
        $selected = 0;

        if (isset($_POST[$taxonomy->name]) && !is_array($_POST[$taxonomy->name])) {
          $candidate = sanitize_key(wp_unslash($_POST[$taxonomy->name]));

          if (!empty($candidate) && term_exists($candidate, $taxonomy->name)) {
            $selected = $candidate;
          }
        }

        wp_dropdown_categories( array(
          'show_option_all' => $taxonomy->labels->all_items,
          'taxonomy'        => $taxonomy->name,
          'name'            => $taxonomy->name,
          'orderby'         => 'name',
          'value_field'     => 'slug',
          'selected'        => $selected,
          'hierarchical'    => true,
          'hide_empty'      => false,
          'id'              => $field_id,
          'class'           => 'form-select',
        ) );
        ?>
    </div>
    <?php endforeach; ?>

    <div class="col">
        <?php $field_id = uniqid(); ?>
        <label class="visually-hidden" for="<?php echo $field_id; ?>">Buscar por:</label>
        <input class="form-control" type="text" value="<?php echo (get_search_query() ?? ''); ?>" name="s" id="<?php echo $field_id; ?>" placeholder="Busque pelo curso..." style="min-width: 250px;"/>
    </div>

    <div class="col-auto ms-auto">
      <button type="submit" class="btn btn-sm btn-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Filtrar Cursos">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
        </svg>
        <span>Filtrar Cursos</span>
      </button>
      <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-sm btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar Filtros">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M4 7l16 0" />
          <path d="M10 11l0 6" />
          <path d="M14 11l0 6" />
          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>
        <span>Limpar Filtros</span>
      </a>
    </div>
  </div>
</form>
