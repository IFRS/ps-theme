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

$chamadas = array();

foreach ($formasingresso_all as $id1) {
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
<?php get_header(); ?>

<section class="container">
    <div class="chamadas-lista">
        <div class="row">
            <div class="col-12">
                <div class="chamadas-lista__title">
                    <h2>Chamadas</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <?php foreach ($chamadas as $formaingresso_id => $campi) : ?>
                        <?php $formaingresso_obj = get_term($formaingresso_id); ?>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-<?php echo $formaingresso_id; ?>" data-toggle="pill" href="#pane-<?php echo $formaingresso_id; ?>" role="tab" aria-controls="pane-<?php echo $formaingresso_id; ?>" aria-selected="true"><?php echo $formaingresso_obj->name; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content chamadas-lista__content">
                    <?php foreach ($chamadas as $formaingresso_id => $campi) : ?>
                        <?php $formaingresso_obj = get_term($formaingresso_id); ?>
                        <div class="tab-pane fade" id="pane-<?php echo $formaingresso_id; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $formaingresso_id; ?>">
                            <div class="accordion" id="accordion-<?php echo $formaingresso_id; ?>">
                                <?php foreach ($campi as $campus_id => $chamada) : ?>
                                    <?php $campus_obj = get_term($campus_id); ?>
                                    <div class="card">
                                        <div class="card-header" id="heading-<?php echo $formaingresso_id; ?>-<?php echo $campus_id; ?>">
                                            <h3 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $formaingresso_id; ?>-<?php echo $campus_id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $formaingresso_id; ?>-<?php echo $campus_id; ?>">
                                                    <?php echo $campus_obj->name; ?>
                                                </button>
                                            </h3>
                                        </div>
                                        <div id="collapse-<?php echo $formaingresso_id; ?>-<?php echo $campus_id; ?>" class="collapse" aria-labelledby="heading-<?php echo $formaingresso_id; ?>-<?php echo $campus_id; ?>" data-parent="#accordion-<?php echo $formaingresso_id; ?>">
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php foreach ($chamada as $resultado) : ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="chamada">
                                                                <h5 class="chamada__title"><a href="<?php echo get_permalink($resultado); ?>" rel="bookmark"><?php echo $resultado->post_title; ?></a></h5>
                                                                <p class="chamada__meta"><?php echo get_the_time('d/m/Y', $resultado); ?></p>
                                                                <div class="chamada__badges">
                                                                    <?php $modalidades = get_post_meta($resultado->ID, '_chamada_resultados_group'); ?>
                                                                    <?php foreach ($modalidades[0] as $id => $modalidade) : ?>
                                                                        <?php echo get_term($modalidade['modalidade'], 'modalidade')->name; ?><?php echo ($id !== array_key_last($modalidades[0])) ? ', ' : ''; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
