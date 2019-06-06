<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <article class="post">
                <div class="row">
                    <div class="col-12">
                        <p class="chamada-labels">
                        <?php
                            $campi = get_the_terms(get_the_ID(), 'campus');
                            foreach ($campi as $key => $campus) :
                        ?>
                                <span class="badge label-campus"><?php echo $campus->name; ?></span>
                        <?php
                            endforeach;
                        ?>
                        <?php
                            $formasingresso = get_the_terms(get_the_ID(), 'formaingresso');
                            foreach ($formasingresso as $key => $formaingresso) :
                        ?>
                                <span class="badge label-formaingresso"><?php echo $formaingresso->name; ?></span>
                        <?php
                            endforeach;
                        ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="post__title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="post__content">
                            <?php the_content(); ?>

                            <?php $matriculas = get_post_meta(get_the_ID(), '_chamada_matriculas'); ?>
                            <?php $bancas = get_post_meta(get_the_ID(), '_chamada_bancas'); ?>
                            <?php if (!empty($matriculas) || !empty($bancas)) : ?>
                                <div class="row mb-5">
                                    <?php if (!empty($matriculas)) : ?>
                                        <div class="col col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-header">
                                                    <strong><?php _e('Matrículas', 'ifrs-ps-theme'); ?></strong>
                                                </div>
                                                <div class="list-group list-group-flush">
                                                    <?php foreach($matriculas[0] as $id => $url) : ?>
                                                        <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-success"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($bancas)) : ?>
                                        <div class="col col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-header">
                                                    <strong><?php _e('Bancas de Heteroidentificação', 'ifrs-ps-theme'); ?></strong>
                                                </div>
                                                <div class="list-group list-group-flush">
                                                    <?php foreach($bancas[0] as $id => $url): ?>
                                                        <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php $resultados = get_post_meta(get_the_ID(), '_chamada_resultados_group'); ?>
                            <?php if (!empty($resultados)) : ?>
                                <div class="row">
                                    <?php foreach ($resultados[0] as $resultado) : ?>
                                        <div class="col-12 col-lg-6">
                                            <div class="card bg-light mb-2">
                                                <div class="card-header">
                                                    <strong>N&iacute;vel <?php echo get_term($resultado['modalidade'], 'modalidade')->name; ?></strong>
                                                </div>
                                                <div class="list-group list-group-flush" role="list">
                                                    <?php foreach ($resultado['arquivos'] as $id => $url): ?>
                                                        <a href="<?php echo esc_url($url); ?>" role="listitem" target="_blank" class="list-group-item list-group-item-action list-group-item-info"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                                    <?php endforeach; ?>

                                                    <?php
                                                        $formaingresso = get_terms(array(
                                                            'taxonomy' => 'formaingresso',
                                                            'object_ids' => get_the_ID(),
                                                            'fields' => 'tt_ids',
                                                        ));

                                                        $args = array(
                                                            'post_type' => 'documento',
                                                            'nopaging ' => true,
                                                            'posts_per_page' => -1,
                                                            'order' => 'ASC',
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'formaingresso',
                                                                    'terms' => $formaingresso
                                                                ),
                                                                array(
                                                                    'taxonomy' => 'modalidade',
                                                                    'terms' => get_term($resultado['modalidade'], 'modalidade')->term_id
                                                                )
                                                            )
                                                        );

                                                        $documentos = new WP_Query($args);
                                                    ?>
                                                    <?php if ($documentos->have_posts()) : ?>
                                                        <?php while ($documentos->have_posts()) : $documentos->the_post(); ?>
                                                            <?php $arquivos = get_post_meta(get_the_ID(), '_documento_arquivos'); ?>
                                                            <?php if (!empty($arquivos)) : ?>
                                                                <a href="#collapse-arquivos-<?php echo get_the_ID(); ?>" class="list-group-item list-group-item-action list-group-item-secondary collapsed chamada-documentos__link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-arquivos-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a>
                                                                <div class="list-group collapse" role="list" id="collapse-arquivos-<?php echo get_the_ID(); ?>">
                                                                    <?php foreach ($arquivos[0] as $id => $url) : ?>
                                                                        <a href="<?php echo esc_url($url); ?>" role="listitem" target="_blank" class="list-group-item list-group-item-action"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                        <?php $documentos->wp_reset_query(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <hr>
                            <p class="post__meta">
                                <?php printf(__('Publicado em %s', 'ifrs-ps-theme'), get_the_date('d/m/Y')); ?>
                                &mdash;
                                <?php printf(__('Última atualização em %s', 'ifrs-ps-theme'), get_the_modified_date('d/m/Y')); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<?php get_footer(); ?>
