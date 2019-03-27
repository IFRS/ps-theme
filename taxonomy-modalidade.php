<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="modalidades">
                <div class="modalidades__title">
                    <h2>Cursos na modalidade de ensino<span class="">&nbsp;<?php single_term_title(); ?></span>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownModalidades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Trocar Modalidade</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownModalidades">
                            <h3 class="dropdown-header">Trocar Modalidade</h3>
                            <?php
                                $queried_object = get_queried_object();
                                $term_id = $queried_object->term_id;
                            ?>
                            <?php $modalidades = get_terms('modalidade'); ?>
                            <?php foreach ($modalidades as $key => $modalidade) : ?>
                                <a class="dropdown-item" href="<?php echo get_term_link($modalidade); ?>"><?php echo $modalidade->name; ?></a>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    </h2>
                </div>

                <div class="modalidades__content">
                    <!-- Nav tabs -->
                    <?php get_template_part('partials/cursos', 'nav'); ?>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-todos" role="tabpanel">
                            <table class="table table-striped table-cursos">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Curso</th>
                                        <th>Campus</th>
                                        <th>Turnos</th>
                                        <th class="text-center">Vagas&sup1;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <tr>
                                        <td><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></td>
                                        <td>
                                            <?php foreach (get_the_terms(get_the_ID(), 'campus') as $campus) : ?>
                                                <p><?php echo $campus->name; ?></p>
                                            <?php endforeach; ?>
                                        </td>
                                        <td>
                                            <?php foreach (get_the_terms(get_the_ID(), 'turno') as $turno) : ?>
                                                <p><?php echo $turno->name; ?></p>
                                            <?php endforeach; ?>
                                        </td>
                                        <td>
                                            <p><?php echo get_post_meta(get_the_ID(), '_curso_vagas', true); ?></p>
                                        </td>
                                    </tr>
                                <?php endwhile;?>
                                </tbody>
                            </table>
                        </div>
                        <?php $terms = get_terms('campus'); ?>
                        <?php foreach ($terms as $key => $campus) : ?>
                        <div class="tab-pane fade" id="tab-<?php echo $campus->slug; ?>" role="tabpanel">
                            <table class="table table-striped table-cursos">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Curso</th>
                                        <th>Campus</th>
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
                                        <?php get_template_part('partials/cursos', 'row'); ?>
                                    <?php endwhile;?>
                                    <?php $cursos_per_campus->wp_reset_query(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php get_template_part('partials/cursos','alert-vagas'); ?>
                    <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-light">&larr;&nbsp;Voltar para a lista com todos os Cursos</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
