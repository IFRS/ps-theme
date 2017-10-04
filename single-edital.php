<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <article class="edital">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="edital__title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="row edital__meta">
                    <div class="col-xs-12 col-sm-6">
                        <p class="edital__date">Publicado em <?php the_date('d/m/Y'); ?></p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p class="edital__date">Atualizado em <?php the_modified_date('d/m/Y'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="edital__content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?php echo get_post_meta(get_the_ID(), '_edital_arquivo', true); ?>" class="btn btn-primary">Baixar Arquivo</a>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-xs-12 col-md-4">
            <aside>
                <div class="row">
                    <div class="col-xs-12">
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
                            <h3>Outros Editais</h3>
                            <?php foreach ($cat_posts as $cat_post) : ?>
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <?php if (has_post_thumbnail($cat_post->ID)) : ?>
                                            <a href="<?php echo get_permalink($cat_post->ID); ?>">
                                                <?php echo get_the_post_thumbnail($cat_post->ID, 'thumbnail', array('class' => 'media-object')); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                                        <p><?php echo get_the_date('d/m/Y', $cat_post->ID); ?></p>
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
