<div class="row align-items-center">
    <p class="col-auto my-2">
        <strong>Dura&ccedil;&atilde;o: </strong>
        <?php
            $duracao = get_post_meta(get_the_ID(), '_curso_duracao', true);
            if (!empty($duracao)) {
                echo $duracao;
            } else {
                echo '-';
            }
        ?>
    </p>

    <p class="col-auto my-2">
        <strong>Vagas: </strong>
        <?php
            $vagas = get_post_meta(get_the_ID(), '_curso_vagas', true);
            if (!empty($vagas)) {
                echo $vagas;
            } else {
                echo '-';
            }
        ?>
    </p>

    <?php $turnos = wp_get_post_terms(get_the_ID(), 'turno', array('orderby' => 'term_order')); ?>
    <?php $turnos_counter = 1; ?>
    <p class="col-auto my-2">
        <strong><?php echo _n( 'Turno', 'Turnos', count($turnos), 'ifrs-ps-theme' ) ?>: </strong>
        <?php
            if (!empty($turnos)) {
                foreach ($turnos as $turno) :
                    echo ($turnos_counter == count($turnos) ? $turno->name : $turno->name . ' e ');
                    $turnos_counter++;
                endforeach;
            } else {
                echo '-';
            }
        ?>
    </p>

    <?php $modalidades = get_the_terms(get_the_ID(), 'modalidade'); ?>
    <p class="col-auto my-2">
        <strong>N&iacute;vel: </strong>
        <?php
            if (!empty($modalidades)) {
                foreach ($modalidades as $modalidade) {
                    echo $modalidade->name;
                }
            } else {
                echo '-';
            }
        ?>
    </p>

    <?php $formasingresso = get_the_terms(get_the_ID(), 'formaingresso'); ?>
    <p class="col-auto my-2">
        <strong><?php echo _n( 'Forma', 'Formas', count($formasingresso), 'ifrs-ps-theme' ) ?> de Ingresso: </strong>
        <?php
            if (!empty($formasingresso)) {
                foreach ($formasingresso as $key => $formaingresso) {
                    if (!empty($formaingresso->description)) {
                        printf('<span class="formaingresso-help" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="%s">%s</span>', $formaingresso->description, $formaingresso->name);
                    } else {
                        echo $formaingresso->name;
                    }
                    echo ($key !== array_key_last($formasingresso)) ? ' ou ' : '';
                }
            } else {
                echo '-';
            }
        ?>
    </p>

    <?php $campi = get_the_terms(get_the_ID(), 'campus'); ?>
    <p class="col-auto my-2">
        <strong>Curso oferecido no Campus: </strong>
        <?php
            if (!empty($campi)) {
                foreach ($campi as $campus) {
                    echo $campus->name;
                }
            } else {
                echo '-';
            }
        ?>
    </p>

    <?php if (get_post_meta( get_the_ID(), '_curso_ead', 1 )) : ?>
        <div class="col-auto mt-3">
            <p class="alert alert-info" role="alert">
                <small><strong>Fique atento!</strong>&nbsp;Esse Curso possui parte da carga hor&aacute;ria a dist&acirc;ncia.</small>
            </p>
        </div>
    <?php endif; ?>
  </div>

  <?php the_content(); ?>
