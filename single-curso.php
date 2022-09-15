<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <article class="post">
        <h2 class="post__title"><?php the_title(); ?></h2>
        <div class="post__content">
            <hr>
            <div class="row align-items-center">
                <p class="col-auto my-2">
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

                <p class="col-auto my-2">
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
                <p class="col-auto my-2">
                    <strong><?php echo _n( 'Turno', 'Turnos', count($turnos), 'ifrs-ps-theme' ) ?>: </strong>
                    <?php
                        if (!empty($turnos)) {
                            foreach ($turnos as $turno) :
                                echo ($turnos_counter == count($turnos) ? $turno->name : $turno->name . ', ');
                                $turnos_counter++;
                            endforeach;
                        } else {
                            echo '-';
                        }
                    ?>
                </p>

                <?php $modalidades = get_the_terms(get_the_ID(), 'modalidade'); ?>
                <p class="col-auto my-2">
                    <strong>Modalidade: </strong>
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

                <?php $formasingresso = get_the_terms(get_the_ID(), 'formaingresso'); ?>
                <p class="col-auto my-2">
                    <strong>Formas de Ingresso: </strong>
                    <?php
                        if (!empty($formasingresso)) {
                            foreach ($formasingresso as $key => $formaingresso) {
                                if (!empty($formaingresso->description)) {
                                    printf('<span class="formaingresso-help" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="%s">%s</span>', $formaingresso->description, $formaingresso->name);
                                } else {
                                    echo $formaingresso->name;
                                }
                                echo ($key !== array_key_last($formasingresso)) ? ', ' : '';
                            }
                        } else {
                            echo '-';
                        }
                    ?>
                </p>

                <?php $campi = get_the_terms(get_the_ID(), 'campus'); ?>
                <p class="col-auto my-2">
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

                <?php if (get_post_meta( get_the_ID(), '_curso_ead', 1 )) : ?>
                    <div class="col-auto">
                        <p class="alert alert-info" role="alert">
                            <small><strong>Fique atento!</strong>&nbsp;Esse Curso possui parte da carga hor&aacute;ria a dist&acirc;ncia.</small>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <hr>
            <?php the_content(); ?>
        </div>
    </article>
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
    <?php endif; ?>
</section>

<?php get_footer(); ?>
