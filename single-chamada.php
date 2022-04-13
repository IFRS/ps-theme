<?php get_header(); ?>

<?php the_post(); ?>

<?php
    $campi = get_the_terms(get_the_ID(), 'campus');
    $formasingresso = get_the_terms(get_the_ID(), 'formaingresso');
?>

<section class="container">
    <article class="chamada-single">
        <div class="row">
            <div class="col-12">
                <h2 class="chamada-single__title">
                    <?php the_title(); ?>
                    <?php foreach ($formasingresso as $key => $formaingresso) : ?>
                        <span class="chamada-single__title--formaingresso"><?php echo $formaingresso->name; ?></span>
                    <?php endforeach; ?>
                    <?php foreach ($campi as $key => $campus) : ?>
                        <span class="chamada-single__title--campus">Campus&nbsp;<?php echo $campus->name; ?></span>
                    <?php endforeach; ?>
                </h2>
            </div>
        </div>
        <div class="chamada-single__content">
            <div class="row">
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            </div>

            <?php
                $chamadas_matricula = cmb2_get_option( 'chamada_files', 'matricula', false );
                $chamadas_bancas = cmb2_get_option( 'chamada_files', 'bancas', false );
                $chamadas_renda = cmb2_get_option( 'chamada_files', 'renda', false );

                $matriculas = get_post_meta(get_the_ID(), '_chamada_matriculas');
                $bancas = get_post_meta(get_the_ID(), '_chamada_bancas');
                $renda = get_post_meta(get_the_ID(), '_chamada_renda');
                $resultados = get_post_meta(get_the_ID(), '_chamada_resultados_group');
            ?>

            <div class="row">
            <?php if (!empty($resultados)) : ?>
                <?php foreach ($resultados[0] as $resultado) : ?>
                    <div class="col-auto col-md-6 col-xl-4">
                        <div class="card bg-light mb-4">
                            <div class="card-header">
                                <strong><?php echo get_term($resultado['modalidade'], 'modalidade')->name; ?></strong>
                            </div>
                            <div class="list-group list-group-flush" role="list">
                                <?php foreach ($resultado['arquivos'] as $id => $url): ?>
                                    <a href="<?php echo esc_url($url); ?>" role="listitem" target="_blank" class="list-group-item list-group-item-action list-group-item-info"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
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
                                            <a href="#collapse-arquivos-<?php echo get_the_ID(); ?>" class="list-group-item list-group-item-action list-group-item-secondary collapsed chamada-single__documento-link" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-arquivos-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a>
                                            <div class="list-group collapse" role="list" id="collapse-arquivos-<?php echo get_the_ID(); ?>">
                                                <?php foreach ($arquivos[0] as $id => $url) : ?>
                                                    <a href="<?php echo esc_url($url); ?>" role="listitem" target="_blank" class="list-group-item list-group-item-action"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
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
            <?php endif; ?>

            <?php if (!empty($chamadas_matricula) || !empty($matriculas)) : ?>
                <div class="col-auto col-md-6 col-xl-4">
                    <div class="card bg-light mb-4">
                        <div class="card-header">
                            <strong><?php _e('Matrículas', 'ifrs-ps-theme'); ?></strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach($chamadas_matricula as $id => $url) : ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-success"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                            <?php endforeach; ?>
                            <?php foreach($matriculas[0] as $id => $url) : ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-success"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($chamadas_bancas) || !empty($bancas)) : ?>
                <div class="col-auto col-md-6 col-xl-4">
                    <div class="card bg-light mb-4">
                        <div class="card-header">
                            <strong><?php _e('Comissão de Heteroidentificação', 'ifrs-ps-theme'); ?></strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach($chamadas_bancas as $id => $url): ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                            <?php endforeach; ?>
                            <?php foreach($bancas[0] as $id => $url): ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($chamadas_renda) || !empty($renda)) : ?>
                <div class="col-auto col-md-6 col-xl-4">
                    <div class="card bg-light mb-4">
                        <div class="card-header">
                            <strong><?php _e('Análise de Reserva de Vagas para Renda Inferior a 1,5 Salário Mínimo', 'ifrs-ps-theme'); ?></strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach($chamadas_renda as $id => $url): ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                            <?php endforeach; ?>
                            <?php foreach($renda[0] as $id => $url): ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-warning"><?php echo get_the_title($id); ?><span class="visually-hidden">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            </div>
            <hr>
        </div>
        <p class="post__meta">
            <?php printf(__('Publicado em %s', 'ifrs-ps-theme'), get_the_date('d/m/Y')); ?>
            &mdash;
            <?php printf(__('Última atualização em %s às %s', 'ifrs-ps-theme'), get_the_modified_date('d/m/Y'), get_the_modified_time('G\hi')); ?>
        </p>
    </article>
</section>

<?php get_footer(); ?>
