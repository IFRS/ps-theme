<div class="row">
    <div class="col-12">
        <a href="#inicio-lista-campi" id="inicio-lista-campi" class="sr-only">In&iacute;cio do filtro de Cursos por Campus.</a>
        <ul class="nav nav-pills cursos__nav" role="tablist">
            <li class="nav-item"><a href="#tab-todos" class="nav-link active" role="tab" data-toggle="pill" aria-controls="tab-todos" aria-selected="true">Todos<span class="sr-only">&nbsp;os Campi</span></a></li>
            <?php $terms = get_terms('campus'); ?>
            <?php foreach ($terms as $key => $campus) : ?>
                <li class="nav-item"><a href="#tab-<?php echo $campus->slug; ?>" class="nav-link" role="tab" data-toggle="pill" aria-controls="tab-<?php echo $campus->slug; ?>" aria-selected="false"><span class="sr-only">Campus&nbsp;</span><?php echo $campus->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <a href="#fim-lista-campi" id="fim-lista-campi" class="sr-only">Fim do filtro de Cursos por Campus.</a>
    </div>
</div>
