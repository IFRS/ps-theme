<?php
    $modalidades = get_terms(array(
        'taxonomy' => 'modalidade',
        'hide_empty' => false,
        'orderby' => 'term_order',
    ));

    $turnos = get_terms(array(
        'taxonomy' => 'turno',
        'hide_empty' => false,
        'orderby' => 'term_order',
    ));
?>
<form class="cursos__filters row g-2 align-items-center justify-content-start" method="POST" action="<?php echo get_post_type_archive_link( 'curso' ); ?>">
    <div class="col-auto">
        <?php $field_id = uniqid(); ?>
        <label for="<?php echo $field_id; ?>" class="visually-hidden">Modalidade</label>
        <select name="modalidade[]" id="<?php echo $field_id; ?>" class="form-select form-select-sm my-1 mr-1">
            <option hidden selected disabled>Modalidades</option>
            <?php foreach ($modalidades as $modalidade): ?>
                <?php $modalidade_check = (isset($_POST['modalidade']) && in_array($modalidade->slug, $_POST['modalidade'])) || is_tax('modalidade', $modalidade->slug); ?>
                <option value="<?php echo $modalidade->slug; ?>"<?php echo $modalidade_check ? ' selected' : ''; ?>><?php echo $modalidade->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-auto">
        <?php $field_id = uniqid(); ?>
        <label for="<?php echo $field_id; ?>" class="visually-hidden">Turno</label>
        <select name="turno[]" id="<?php echo $field_id; ?>" class="form-select form-select-sm my-1 mr-1">
            <option hidden selected disabled>Turnos</option>
            <?php foreach ($turnos as $turno): ?>
                <?php $turno_check = (isset($_POST['turno']) && in_array($turno->slug, $_POST['turno'])) || is_tax('turno', $turno->slug); ?>
                <option value="<?php echo $turno->slug; ?>"<?php echo $turno_check ? ' selected' : ''; ?>><?php echo $turno->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-auto">
        <?php $field_id = uniqid(); ?>
        <label class="visually-hidden" for="<?php echo $field_id; ?>">Termo da busca</label>
        <input class="form-control form-control-sm my-1 mr-1" type="text" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" name="s" id="<?php echo $field_id; ?>" placeholder="Buscar cursos..."/>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Filtrar Cursos">
            <span class="visually-hidden">Buscar no Site</span>
            <svg version="1.1"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
            x="0px" y="0px" width="20" height="20" viewBox="0 0 22.2 22.2" style="enable-background:new 0 0 22.2 22.2;"
            xml:space="preserve">
                <g><path class="st0" d="M21.8,19.3l-4.6-4.6c1.1-1.6,1.7-3.4,1.7-5.3c0-1.3-0.2-2.5-0.7-3.7c-0.5-1.2-1.2-2.2-2-3
                c-0.8-0.8-1.8-1.5-3-2C11.9,0.2,10.7,0,9.4,0C8.1,0,6.9,0.2,5.8,0.7c-1.2,0.5-2.2,1.2-3,2c-0.8,0.8-1.5,1.8-2,3
                C0.2,6.9,0,8.1,0,9.4c0,1.3,0.2,2.5,0.7,3.7c0.5,1.2,1.2,2.2,2,3c0.8,0.8,1.8,1.5,3,2c1.2,0.5,2.4,0.7,3.7,0.7c2,0,3.7-0.6,5.3-1.7
                l4.6,4.6c0.3,0.3,0.7,0.5,1.2,0.5c0.5,0,0.9-0.2,1.2-0.5c0.3-0.3,0.5-0.7,0.5-1.2C22.2,20.1,22.1,19.7,21.8,19.3z M13.6,13.6
                c-1.2,1.2-2.6,1.8-4.2,1.8c-1.6,0-3.1-0.6-4.2-1.8C4,12.5,3.4,11.1,3.4,9.4c0-1.6,0.6-3.1,1.8-4.2C6.4,4,7.8,3.4,9.4,3.4
                c1.6,0,3.1,0.6,4.2,1.8c1.2,1.2,1.8,2.6,1.8,4.2C15.4,11.1,14.8,12.5,13.6,13.6z"/></g>
            </svg>
        </button>

        <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar Filtros">
            <span class="visually-hidden">Limpar Filtros</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="arcs">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
        </a>
    </div>
</form>
