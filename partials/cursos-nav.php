<div class="row">
    <div class="col-xs-12">
        <a href="#inicio-lista-campi" id="inicio-lista-campi" class="sr-only">In&iacute;cio do filtro de Cursos por Campus.</a>
        <ul class="list-campi" role="tablist">
            <li class="active"><a href="#tab-todos" class="btn btn-primary" role="button" data-toggle="tab">Todos<span class="sr-only">&nbsp;os Campi</span></a></li>
            <?php $terms = get_terms('campus'); ?>
            <?php foreach ($terms as $key => $campus) : ?>
                <li><a href="#tab-<?php echo $campus->slug; ?>" class="btn btn-campus" role="button" data-toggle="tab"><span class="sr-only">Campus&nbsp;</span><?php echo $campus->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <a href="#fim-lista-campi" id="fim-lista-campi" class="sr-only">Fim do filtro de Cursos por Campus.</a>
    </div>
</div>
