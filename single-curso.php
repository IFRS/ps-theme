<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col">
            <article class="post">
                <h2 class="post__title"><?php the_title(); ?></h2>
                <div class="post__content">
                    <?php the_content(); ?>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p>
                                <strong>Dura&ccedil;&atilde;o: </strong>
                                <?php
                                    $duracao = get_post_meta(get_the_ID(), '_curso_duracao', true);
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
                                    $vagas = get_post_meta(get_the_ID(), '_curso_vagas', true);
                                    if (!empty($vagas)) {
                                        echo $vagas;
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </p>

                            <?php $turnos = get_the_terms(get_the_ID(), 'turno'); ?>
                            <?php $turnos_counter = 1; ?>
                            <p>
                                <strong>Turnos: </strong>
                                <?php
                                    if (!empty($turnos)) {
                                        foreach ($turnos as $turno) :
                                            echo ($turnos_counter == sizeof($turnos) ? $turno->name : $turno->name . ', ');
                                            $turnos_counter++;
                                        endforeach;
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col-12 col-md-6">
                            <?php $modalidades = get_the_terms(get_the_ID(), 'modalidade'); ?>
                            <p>
                                <strong>Modalidade de ensino: </strong>
                                <?php
                                    if (!empty($modalidades)) {
                                        foreach ($modalidades as $modalidade) {
                                            echo $modalidade->name;
                                        }
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </p>

                            <?php $campi = get_the_terms(get_the_ID(), 'campus'); ?>
                            <p>
                                <strong>Curso oferecido no Campus: </strong>
                                <?php
                                    if (!empty($campi)) {
                                        foreach ($campi as $campus) {
                                            echo $campus->name;
                                        }
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php if (get_post_meta( get_the_ID(), '_curso_ead', 1 )) : ?>
                        <hr>
                        <div class="alert alert-info" role="alert"><p><small><strong>Fique atento!</strong>&nbsp;Esse Curso possui parte da carga hor&aacute;ria a dist&acirc;ncia.</small></p></div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
        <?php
            // Outros cursos do mesmo Campus.
            global $post;

            $camp_slug = array();

            $campus = get_the_terms(get_the_ID(), 'campus');
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
            <div class="col-12 col-lg-4">
                <aside class="aside">
                    <h3 class="aside__title">Outros Cursos do mesmo Campus</h3>
                    <div class="aside__content">
                        <?php foreach ($cat_posts as $cat_post) : ?>
                            <div class="aside__item">
                                <h3 class="aside__item-title"><a href="<?php echo get_permalink($cat_post); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h3>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
