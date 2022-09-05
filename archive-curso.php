<?php get_header(); ?>

<section class="container cursos">
    <h2 class="cursos__title">Lista de Cursos ofertados<?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo get_search_query(); ?>&rdquo;)</small><?php endif; ?></h2>

    <?php echo wpautop(curso_get_option('desc', ''), true); ?>

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
                                <th>Modalidade</th>
                                <th>Turnos</th>
                                <th class="text-center">Vagas&sup1;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (have_posts()) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part('partials/cursos/row'); ?>
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
                                    <th>Campus</th>
                                    <th>Modalidade</th>
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
                                    <?php get_template_part('partials/cursos/row'); ?>
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
