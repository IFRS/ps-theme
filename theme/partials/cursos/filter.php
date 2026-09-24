<?php
$campus = get_taxonomy('campus');
$modalidades = ifrs_ps_get_modalidades();
$turnos = ifrs_ps_get_turnos();
?>
<form class="cursos__filters" method="POST" action="<?php echo esc_url(get_post_type_archive_link('curso')); ?>">
  <input type="hidden" name="curso_filter" value="1">
  <div class="row g-2 align-items-center justify-content-start">
    <?php foreach (array('modalidade' => array('label' => __('Todos os Níveis', 'ifrs-ps-theme'), 'options' => $modalidades), 'turno' => array('label' => __('Todos os Turnos', 'ifrs-ps-theme'), 'options' => $turnos)) as $name => $filter) : ?>
      <div class="col-auto">
        <?php $field_id = uniqid(); ?>
        <label for="<?php echo $field_id; ?>" class="visually-hidden"><?php echo esc_html($filter['label']); ?></label>
        <select name="<?php echo esc_attr($name); ?>" id="<?php echo $field_id; ?>" class="form-select">
          <option value=""><?php echo esc_html($filter['label']); ?></option>
          <?php foreach ($filter['options'] as $value => $label) : ?>
            <option value="<?php echo esc_attr($value); ?>" <?php selected(isset($_POST[$name]) && !is_array($_POST[$name]) ? sanitize_key(wp_unslash($_POST[$name])) : '', $value); ?>><?php echo esc_html($label); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endforeach; ?>

    <div class="col-auto">
      <?php $field_id = uniqid(); ?>
      <label for="<?php echo $field_id; ?>" class="visually-hidden"><?php echo esc_html($campus->labels->singular_name); ?></label>
      <?php $campus_selected = isset($_POST['campus']) && !is_array($_POST['campus']) ? sanitize_key(wp_unslash($_POST['campus'])) : ''; ?>
      <?php wp_dropdown_categories(array('show_option_all' => $campus->labels->all_items, 'taxonomy' => 'campus', 'name' => 'campus', 'orderby' => 'name', 'value_field' => 'slug', 'selected' => $campus_selected, 'hierarchical' => true, 'hide_empty' => false, 'id' => $field_id, 'class' => 'form-select')); ?>
    </div>

    <div class="col">
      <?php $field_id = uniqid(); ?>
      <label class="visually-hidden" for="<?php echo $field_id; ?>">Buscar por:</label>
      <input class="form-control" type="text" value="<?php echo isset($_POST['s']) && !is_array($_POST['s']) ? esc_attr(sanitize_text_field(wp_unslash($_POST['s']))) : esc_attr(get_search_query()); ?>" name="s" id="<?php echo $field_id; ?>" placeholder="Busque pelo curso..." style="min-width: 250px;" />
    </div>

    <div class="col-auto ms-auto">
      <button type="submit" class="btn btn-sm btn-primary me-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round">
          <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
        </svg>
        <span>Filtrar Cursos</span>
      </button>
      <a href="<?php echo get_post_type_archive_link('curso'); ?>" class="btn btn-sm btn-outline-dark">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round">
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
