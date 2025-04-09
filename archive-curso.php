<?php get_header(); ?>

<?php $desc = curso_get_option('desc', ''); ?>

<section class="container cursos">
    <h2 class="cursos__title">Lista de Cursos ofertados<?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo get_search_query(); ?>&rdquo;)</small><?php endif; ?></h2>

    <?php if (!empty($desc)) : ?>
        <div class="cursos__text">
            <?php echo wpautop($desc, true); ?>
        </div>
    <?php endif; ?>

    <?php get_template_part('partials/cursos/filter'); ?>

    <div class="cursos__content">
        <!-- Nav tabs -->
        <?php get_template_part('partials/cursos/nav'); ?>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-todos" role="tabpanel">
                <div class="table-responsive-md">
                    <table class="table table-striped table-cursos">
                        <thead class="thead-light">
                            <tr>
                                <th>Curso</th>
                                <th>Campus</th>
                                <th>N&iacute;vel</th>
                                <th>Formas de Ingresso</th>
                                <th>Turnos</th>
                                <th class="text-center">Vagas&sup1;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (have_posts()) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part('partials/cursos/row', null, array('hide_unidades' => false)); ?>
                                <?php add_action( 'wp_footer', function() { the_post(); ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-<?php echo get_the_ID(); ?>" tabindex="-1" aria-labelledby="modal-title-<?php echo get_the_ID(); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo get_template_part( 'partials/cursos/curso' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ); ?>
                            <?php endwhile;?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if ( ! is_search()) : ?>
                <?php $terms = get_terms('campus'); ?>
                <?php foreach ($terms as $key => $campus) : ?>
                <div class="tab-pane fade" id="tab-<?php echo $campus->slug; ?>" role="tabpanel">
                    <div class="table-responsive-md">
                        <table class="table table-striped table-cursos">
                            <thead class="thead-light">
                                <tr>
                                    <th>Curso</th>
                                    <th>N&iacute;vel</th>
                                    <th>Formas de Ingresso</th>
                                    <th>Turnos</th>
                                    <th class="text-center">Vagas&sup1;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    global $wp_query;
                                    $args = array(
                                        'post_type' => 'curso',
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                        'campus' => $campus->slug,
                                        'posts_per_page' => -1,
                                        'nopaging' => true
                                    );
                                    $args = array_merge($wp_query->query_vars, $args);
                                    $cursos_per_campus = new WP_Query($args);
                                ?>
                                <?php while ( $cursos_per_campus->have_posts() ) : $cursos_per_campus->the_post(); ?>
                                    <?php get_template_part('partials/cursos/row', null, array('hide_unidades' => true)); ?>
                                <?php endwhile;?>
                                <?php $cursos_per_campus->wp_reset_query(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php get_template_part('partials/cursos/alert'); ?>
    </div>
</section>

<?php get_footer(); ?>
