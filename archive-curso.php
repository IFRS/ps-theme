<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="cursos">
                <h2 class="cursos__title">Lista de Cursos ofertados<?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo get_search_query(); ?>&rdquo;)</small><?php endif; ?></h2>
                <div class="cursos__content">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <form class="form-inline searchform" method="get" action="." role="form">
                                <div class="input-group">
                                    <label class="sr-only" for="s">Termo da busca</label>
                                    <input class="form-control searchform__input" type="text" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" name="s" id="s" placeholder="Buscar cursos..." required/>
                                    <span class="input-group-append">
                                        <button type="submit" class="btn searchform__submit" title="Buscar">
                                            <span class="sr-only">Buscar no Site</span>
                                            <svg version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
                                            x="0px" y="0px" width="20px" height="20px" viewBox="0 0 22.2 22.2" style="enable-background:new 0 0 22.2 22.2;"
                                            xml:space="preserve">
                                                <g><path class="st0" d="M21.8,19.3l-4.6-4.6c1.1-1.6,1.7-3.4,1.7-5.3c0-1.3-0.2-2.5-0.7-3.7c-0.5-1.2-1.2-2.2-2-3
                                                c-0.8-0.8-1.8-1.5-3-2C11.9,0.2,10.7,0,9.4,0C8.1,0,6.9,0.2,5.8,0.7c-1.2,0.5-2.2,1.2-3,2c-0.8,0.8-1.5,1.8-2,3
                                                C0.2,6.9,0,8.1,0,9.4c0,1.3,0.2,2.5,0.7,3.7c0.5,1.2,1.2,2.2,2,3c0.8,0.8,1.8,1.5,3,2c1.2,0.5,2.4,0.7,3.7,0.7c2,0,3.7-0.6,5.3-1.7
                                                l4.6,4.6c0.3,0.3,0.7,0.5,1.2,0.5c0.5,0,0.9-0.2,1.2-0.5c0.3-0.3,0.5-0.7,0.5-1.2C22.2,20.1,22.1,19.7,21.8,19.3z M13.6,13.6
                                                c-1.2,1.2-2.6,1.8-4.2,1.8c-1.6,0-3.1-0.6-4.2-1.8C4,12.5,3.4,11.1,3.4,9.4c0-1.6,0.6-3.1,1.8-4.2C6.4,4,7.8,3.4,9.4,3.4
                                                c1.6,0,3.1,0.6,4.2,1.8c1.2,1.2,1.8,2.6,1.8,4.2C15.4,11.1,14.8,12.5,13.6,13.6z"/></g>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <br/>
                        </div>
                    </div>

                    <?php if ( ! is_search()) : ?>
                        <!-- Nav tabs -->
                        <?php get_template_part('partials/cursos-nav'); ?>
                    <?php endif; ?>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-todos" role="tabpanel">
                            <div class="table-responsive-md">
                                <table class="table table-striped table-cursos">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Curso</th>
                                            <th>C&acirc;mpus</th>
                                            <th>Modalidade</th>
                                            <th>Turnos</th>
                                            <th>Vagas&sup1;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (have_posts()) : ?>
                                        <?php while ( have_posts() ) : the_post(); ?>
                                            <?php get_template_part('partials/cursos', 'row'); ?>
                                        <?php endwhile;?>
                                    <?php else : ?>
                                        <?php if ( ! is_search()) : ?>
                                            <div class="alert alert-warning" role="alert">
                                                <p><strong>Aguarde!</strong> Em breve os cursos ser&atilde;o disponibilizados.</p>
                                            </div>
                                        <?php endif; ?>
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
                                                <th>C&acirc;mpus</th>
                                                <th>Modalidade</th>
                                                <th>Turnos</th>
                                                <th>Vagas&sup1;</th>
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
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php get_template_part('partials/cursos', 'alert-vagas'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
