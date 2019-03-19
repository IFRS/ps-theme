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
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong><?php _e('Matrículas', 'ifrs-ps-theme'); ?></strong>
                                                </div>
                                                <div class="list-group list-group-flush">
                                                    <?php foreach($matriculas as $id => $url): ?>
                                                        <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-info"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($bancas)) : ?>
                                        <div class="col col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong><?php _e('Bancas de Heteroidentificação', 'ifrs-ps-theme'); ?></strong>
                                                </div>
                                                <div class="list-group list-group-flush">
                                                    <?php foreach($bancas as $id => $url): ?>
                                                        <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-info"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
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
                                            <div class="card mb-2">
                                                <div class="card-header">
                                                    <strong><?php echo get_term($resultado['modalidade'], 'modalidade')->name; ?></strong>
                                                </div>
                                                <div class="list-group list-group-flush">
                                                    <?php foreach ($resultado['arquivos'] as $id => $url): ?>
                                                        <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-info"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                                    <?php endforeach; ?>
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
