<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <article class="edital">
        <h2 class="edital__title"><?php the_title(); ?></h2>
        <div class="edital__content">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p class="edital__date text-left">Publicado em <?php the_date('d/m/Y'); ?></p>
                </div>
                <div class="col-12 col-sm-6">
                    <p class="edital__date text-right">Atualizado em <?php the_modified_date('d/m/Y'); ?></p>
                </div>
            </div>
            <?php the_content(); ?>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="edital__files-title">Arquivos</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="<?php echo get_post_meta(get_the_ID(), '_edital_arquivo', true); ?>" class="list-group-item list-group-item-action"><?php the_title(); ?></a>
                            <?php $retificacoes = get_post_meta(get_the_ID(), '_edital_retificacoes', true); ?>
                            <?php if (!empty($retificacoes)) : ?>
                                <?php foreach ($retificacoes as $id => $retificacao) : ?>
                                    <a href="<?php echo esc_url($retificacao); ?>" class="list-group-item list-group-item-action"><?php echo get_the_title($id); ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php $anexos = get_post_meta(get_the_ID(), '_edital_anexos', true); ?>
                <?php if (!empty($anexos)) : ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="edital__files-title">Anexos</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php foreach ($anexos as $id => $anexo) : ?>
                                    <a href="<?php echo esc_url($anexo); ?>" class="list-group-item list-group-item-action list-group-item-secondary"><?php echo get_the_title($id); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </article>
    <?php
        // Outros editais
        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'edital',
            'numberposts' => 5,
            'post__not_in' => array($post->ID),
        );

        $cat_posts = get_posts($args);
    ?>
    <?php if (!empty($cat_posts)) : ?>
        <aside class="aside">
            <h3 class="aside__title">Outros Editais</h3>
            <div class="aside__content">
                <?php foreach ($cat_posts as $cat_post) : ?>
                    <?php if (has_post_thumbnail($cat_post->ID)) : ?>
                        <?php echo get_the_post_thumbnail($cat_post->ID, 'thumbnail', array('class' => 'card-img-top')); ?>
                    <?php endif; ?>
                    <div class="aside__item">
                        <h4 class="aside__item-title"><a href="<?php echo get_permalink($cat_post); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                        <p class="aside__item-meta"><?php echo get_the_date('d/m/Y', $cat_post->ID); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </aside>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
