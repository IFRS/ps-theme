<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <article class="edital">
                <div class="row">
                    <div class="col-12">
                        <h2 class="edital__title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="edital__content">
                            <div class="row edital__meta">
                                <div class="col-12 col-md-6">
                                    <p class="edital__date text-left">Publicado em <?php the_date('d/m/Y'); ?></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="edital__date text-right">Atualizado em <?php the_modified_date('d/m/Y'); ?></p>
                                </div>
                            </div>
                            <?php the_content(); ?>
                            <div class="row">
                                <div class="col">
                                    <h3 class="edital__files-title">Arquivos</h3>
                                    <div class="list-group">
                                        <a href="<?php echo get_post_meta(get_the_ID(), '_edital_arquivo', true); ?>" class="list-group-item list-group-item-action active">Baixar Edital</a>
                                        <?php $retificacoes = get_post_meta(get_the_ID(), '_edital_retificacoes', true); ?>
                                        <?php if (!empty($retificacoes)) : ?>
                                            <?php foreach ($retificacoes as $id => $retificacao) : ?>
                                                <a href="<?php echo esc_url($retificacao); ?>" class="list-group-item list-group-item-action"><?php echo get_the_title($id); ?></a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $anexos = get_post_meta(get_the_ID(), '_edital_anexos', true); ?>
                                <?php if (!empty($anexos)) : ?>
                                    <div class="col-12 col-lg-6">
                                        <h3 class="edital__files-title">Anexos</h3>
                                        <div class="list-group">
                                            <?php foreach ($anexos as $id => $anexo) : ?>
                                                <a href="<?php echo esc_url($anexo); ?>" class="list-group-item list-group-item-action"><?php echo get_the_title($id); ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-lg-4">
            <aside>
                <div class="row">
                    <div class="col-12">
                        <!-- Outros editais. -->
                        <?php
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
                            <h3 class="aside__title">Outros Editais</h3>
                            <?php foreach ($cat_posts as $cat_post) : ?>
                                <div class="card">
                                    <?php if (has_post_thumbnail($cat_post->ID)) : ?>
                                        <?php echo get_the_post_thumbnail($cat_post->ID, 'thumbnail', array('class' => 'card-img-top')); ?>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                                        <p class="card-subtitle"><?php echo get_the_date('d/m/Y', $cat_post->ID); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
