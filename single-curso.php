<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <article class="content post">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="post-title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p>
                            <strong>Dura&ccedil;&atilde;o: </strong>
                            <?php
                                $duracao = get_post_meta(get_the_ID(), 'duracao', true);
                                if (!empty($duracao)) {
                                    echo $duracao;
                                } else {
                                    echo '-';
                                }
                            ?>
                        </p>

                        <p>
                            <strong>Vagas: </strong>
                            <?php
                                $vagas = get_post_meta(get_the_ID(), 'vagas', true);
                                if (!empty($vagas)) {
                                    echo $vagas;
                                } else {
                                    echo '-';
                                }
                            ?>
                        </p>

                        <?php $turnos = get_the_terms(get_the_ID(), 'turno'); ?>
                        <?php $turnos_int = 1; ?>
                        <p>
                            <strong>Turnos: </strong>
                            <?php
                                if (!empty($turnos)) {
                                    foreach ($turnos as $key => $turno) :
                                        echo ($turnos_int == sizeof($turnos) ? $turno->name : $turno->name.', ');
                                        $turnos_int++;
                                    endforeach;
                                } else {
                                    echo '-';
                                }
                            ?>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?php $modalidades = get_the_terms(get_the_ID(), 'modalidade'); ?>
                        <p>
                            <strong>Modalidade de ensino: </strong>
                            <?php if (!empty($modalidades)) : ?>
                                <?php foreach ($modalidades as $key => $modalidade) : ?>
                                    <a href="<?php echo get_term_link($modalidade); ?>"><?php echo $modalidade->name; ?></a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </p>

                        <?php $campus = get_the_terms(get_the_ID(), 'campus'); ?>
                        <p>
                            <strong>Curso oferecido no Campus: </strong>
                            <?php if (!empty($campus)) : ?>
                                <?php foreach ($campus as $key => $camp) : ?>
                                    <?php echo $camp->name; ?>&nbsp;
                                <?php endforeach; ?>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <?php if (!dynamic_sidebar('banner')) : endif; ?>
                    <br/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Outros cursos do mesmo Campus. -->
                    <?php
                        global $post;

                        $camp_slug = array();

                        foreach ($campus as $camp) {
                            array_push($camp_slug, $camp->slug);
                        }

                        $args = array(
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post_type' => 'curso',
                            'numberposts' => -1,
                            'post__not_in' => array($post->ID),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'campus',
                                    'field' => 'slug',
                                    'terms' => $camp_slug,
                                ),
                            ),
                        );

                        $cat_posts = get_posts($args);
                    ?>
                    <?php if (!empty($cat_posts)) : ?>
                        <div class="well">
                            <h3>Cursos no mesmo Campus</h3>
                            <?php foreach ($cat_posts as $cat_post) : ?>
                                <p><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
