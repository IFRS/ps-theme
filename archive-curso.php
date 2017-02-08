<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="content">
                <?php echo is_search(); ?>
                <h2 class="title">Lista de Cursos ofertados<?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo get_search_query(); ?>&rdquo;)</small><?php endif; ?></h2>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <form class="inline-form" method="get" action="." role="form">
                            <div class="input-group">
                                <label class="sr-only" for="s">Termo da busca</label>
                                <input class="form-control" type="text" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" name="s" id="s" placeholder="Digite sua busca..."/>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                        </form>
                        <br/>
                    </div>
                </div>

                <?php if ( ! is_search()) : ?>
                    <!-- Nav tabs -->
                    <?php get_template_part('partials/cursos', 'nav'); ?>
                <?php endif; ?>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-todos">
                        <table class="table table-striped table-cursos">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>C&acirc;mpus</th>
                                    <th>Modalidade</th>
                                    <th>Turnos</th>
                                    <th>Vagas*</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (have_posts()) : ?>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part('partials/cursos', 'row'); ?>
                                <?php endwhile;?>
                            <?php else : ?>
                                <div class="alert alert-warning" role="alert">
                                    <p><strong>Aguarde!</strong> Em breve os cursos ser&atilde;o disponibilizados.</p>
                                </div>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ( ! is_search()) : ?>
                        <?php $terms = get_terms('campus'); ?>
                        <?php foreach ($terms as $key => $campus) : ?>
                        <div class="tab-pane fade" id="tab-<?php echo $campus->slug; ?>">
                            <table class="table table-striped table-cursos">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>C&acirc;mpus</th>
                                        <th>Modalidade</th>
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
                                        <?php get_template_part('partials/cursos', 'row'); ?>
                                    <?php endwhile;?>
                                    <?php $cursos_per_campus->wp_reset_query(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php get_template_part('partials/cursos', 'alert-vagas'); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <?php if (!dynamic_sidebar('banner')) : endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
