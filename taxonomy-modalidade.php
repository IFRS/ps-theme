<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="modalidades">
                <div class="modalidades__title">
                    <h2>Cursos na modalidade de ensino<span class="">&nbsp;<?php single_term_title(); ?></span>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownModalidades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="sr-only">Trocar Modalidade</span><span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownModalidades">
                            <li class="dropdown-header">Trocar Modalidade</li>
                            <?php
                                $queried_object = get_queried_object();
                                $term_id = $queried_object->term_id;
                            ?>
                            <?php $modalidades = get_terms('modalidade'); ?>
                            <?php foreach ($modalidades as $key => $modalidade) : ?>
                                <li><a href="<?php echo get_term_link($modalidade); ?>"><?php echo $modalidade->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    </h2>
                </div>

                <!-- Nav tabs -->
                <?php get_template_part('partials/cursos', 'nav'); ?>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-todos">
                        <table class="table table-striped table-cursos">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>C&acirc;mpus</th>
                                    <th>Turnos</th>
                                    <th>Vagas*</th>
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
                    <div class="tab-pane fade" id="tab-<?php echo $campus->slug; ?>">
                        <table class="table table-striped table-cursos">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>C&acirc;mpus</th>
                                    <th>Turnos</th>
                                    <th>Vagas*</th>
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
                                    <tr>
                                        <td><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></td>
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
                                            <p><?php echo get_post_meta(get_the_ID(), 'vagas', true); ?></p>
                                        </td>
                                    </tr>
                                <?php endwhile;?>
                                <?php $cursos_per_campus->wp_reset_query(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php get_template_part('partials/cursos','alert-vagas'); ?>
                <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Voltar para a lista com todos os Cursos</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
