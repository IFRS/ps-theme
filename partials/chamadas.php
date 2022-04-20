<?php
    $formasingresso_all = get_terms(array(
        'taxonomy' => 'formaingresso',
        'orderby' => 'name',
        'fields' => 'ids',
    ));
    $campi_all = get_terms(array(
        'taxonomy' => 'campus',
        'orderby' => 'name',
        'fields' => 'ids',
    ));

    $formasingresso_selecionadas = chamada_get_option('formas', array());

    $chamadas = array();

    foreach ($formasingresso_selecionadas as $id1) {
        foreach ($campi_all as $id2) {
            $chamadas_query = new WP_Query(array(
                'post_type' => 'chamada',
                'post_status' => 'publish',
                'posts_per_page' => '-1',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'formaingresso',
                        'field'    => 'term_id',
                        'terms'    => $id1,
                    ),
                    array(
                        'taxonomy' => 'campus',
                        'field'    => 'term_id',
                        'terms'    => $id2,
                    ),
                )
            ));
            if ($chamadas_query->have_posts()) {
                while ($chamadas_query->have_posts()) {
                    $chamadas_query->the_post();
                    $chamadas[$id1][$id2][] = get_post();
                }
            }
        }
    }
?>
<div class="chamadas" aria-live="polite">
    <h2 class="chamadas__title"><?php echo chamada_get_option('title', __('Chamadas', 'ifrs-ps-theme')); ?></h2>
    <div id="formasingresso" class="chamadas__formasingresso">
        <p class="chamadas__text">
            <?php echo wpautop(chamada_get_option('desc', '')); ?>
        </p>
        <p class="chamadas__text">
            <?php _e('Selecione a sua forma de ingresso abaixo.', 'ifrs-ps-theme'); ?>
            <br>
            <small><?php printf(__('Os resultados de cada forma de ingresso serão divulgados conforme <a href="%s">cronograma</a>.', 'ifrs-ps-theme'), get_post_type_archive_link( 'evento' )); ?></small>
        </p>
        <?php foreach ($chamadas as $formaingresso_id => $campi) : ?>
            <?php $formaingresso_obj = get_term($formaingresso_id); ?>
            <a class="btn btn-formaingresso btn-lg toggle" href="#campi-<?php echo $formaingresso_obj->slug; ?>"><span class="visually-hidden">Ingresso por </span><?php echo $formaingresso_obj->name; ?></a>
            <div id="campi-<?php echo $formaingresso_obj->slug; ?>" class="chamadas__campi">
                <p class="chamadas__text">Selecione o seu Campus.</p>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $formaingresso_obj->name; ?></li>
                </ol>
                <?php foreach ($campi as $campus_id => $chamada) : ?>
                    <?php $campus_obj = get_term($campus_id); ?>
                    <a class="btn btn-campus toggle" href="#chamadas-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>"><span class="visually-hidden">Campus </span><?php echo $campus_obj->name; ?></a>
                    <div id="chamadas-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" class="chamadas__list">
                        <p class="chamadas__text">Confira abaixo as chamadas j&aacute; realizadas.</p>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
                            <li class="breadcrumb-item"><a href="#campi-<?php echo $formaingresso_obj->slug; ?>" class="breadcrumb-campus"><?php echo $formaingresso_obj->name; ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $campus_obj->name; ?></li>
                        </ol>
                        <?php foreach ($chamada as $resultado) : ?>
                            <div class="chamada">
                                <a class="chamada__link btn" href="<?php echo get_permalink($resultado); ?>" rel="bookmark">
                                    <h3 class="chamada__title"><?php echo $resultado->post_title; ?></h3>
                                    <p class="chamada__meta"><?php echo get_the_time('d/m/Y', $resultado); ?></p>
                                    <p class="chamada__badges">
                                        <?php $modalidades = get_post_meta($resultado->ID, '_chamada_resultados_group'); ?>
                                        <?php foreach ($modalidades[0] as $id => $modalidade) : ?>
                                            <?php
                                                if ($modalidade_obj = get_term($modalidade['modalidade'], 'modalidade')) {
                                                    echo $modalidade_obj->name; ?><?php echo ($id !== array_key_last($modalidades[0])) ? ' / ' : '';
                                                }
                                            ?>
                                        <?php endforeach; ?>
                                    </p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach ?>
    </div>
</div>
