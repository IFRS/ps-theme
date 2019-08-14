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
                <?php //the_widget( 'Chamadas_Widget', array('title' => 'Chamadas do Processo Seletivo') ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <?php $accordion_id = uniqid(); ?>
                <div class="accordion chamadas-lista__content" id="accordion-<?php echo $accordion_id; ?>">
                    <?php foreach ($chamadas as $formaingresso_id => $campi) : ?>
                        <?php $formaingresso_obj = get_term($formaingresso_id); ?>
                        <?php $heading_id = uniqid(); ?>
                        <?php $collapse_id = uniqid(); ?>
                        <div class="card bg-light">
                            <div class="card-header" id="heading-<?php echo $heading_id; ?>">
                                <h3 class="mb-0">
                                    <a class="" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $collapse_id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $collapse_id; ?>">
                                        <?php echo $formaingresso_obj->name; ?>
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse-<?php echo $collapse_id; ?>" class="collapse" aria-labelledby="heading-<?php echo $heading_id; ?>" data-parent="#accordion-<?php echo $accordion_id; ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach ($campi as $campus_id => $chamada) : ?>
                                            <?php $campus_obj = get_term($campus_id); ?>
                                            <div class="col-12 col-lg-6 col-xl-4">
                                                <div class="card bg-light">
                                                    <div class="card-header">
                                                        <h4><?php echo $campus_obj->name; ?></h4>
                                                    </div>
                                                    <ul class="card-body">
                                                        <?php foreach ($chamada as $resultado) : ?>
                                                            <div class="chamada">
                                                                <h5 class="chamada__title"><a href="<?php echo get_permalink($resultado); ?>" rel="bookmark"><?php echo $resultado->post_title; ?></a></h5>
                                                                <p class="chamada__meta"><?php echo get_the_time('d/m/Y', $resultado); ?></p>
                                                                <div class="chamada__badges">
                                                                    <?php $modalidades = get_post_meta($resultado->ID, '_chamada_resultados_group'); ?>
                                                                    <?php foreach ($modalidades[0] as $id => $modalidade) : ?>
                                                                        <span class="badge badge-modalidade"><?php echo get_term($modalidade['modalidade'], 'modalidade')->name; ?></span>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </ul>
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
        </div>
    </div>
</section>

<?php get_footer(); ?>
