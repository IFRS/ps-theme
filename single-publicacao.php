<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <article class="publicacao">
                <div class="row">
                    <div class="col-12">
                        <h2 class="publicacao__title"><?php the_title(); ?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="publicacao__content">
                            <div class="row publicacao__meta">
                                <div class="col-12 col-md-6">
                                    <p class="publicacao__date text-left">Publicado em <?php the_date('d/m/Y'); ?></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="publicacao__date text-right">Atualizado em <?php the_modified_date('d/m/Y'); ?></p>
                                </div>
                            </div>
                            <?php the_content(); ?>
                            <?php $files = get_post_meta( get_the_ID(), '_publicacao_arquivos', true ); ?>
                            <?php if (!empty($files)) : ?>
                                <h3>Arquivos</h3>
                                <div class="list-group">
                                <?php foreach ($files as $id => $file) : ?>
                                    <a class="list-group-item" href="<?php echo esc_url($file); ?>"><span class="glyphicon glyphicon-save-file"></span>&nbsp;<?php echo get_the_title($id); ?></a>
                                <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-lg-4">
            <aside>
                <div class="row">
                    <div class="col-12">
                        <!-- Outras publicações. -->
                        <?php
                            global $post;

                            $cat_ID = array();
                            $categories = get_the_category();

                            foreach ($categories as $category) {
                                array_push($cat_ID, $category->cat_ID);
                            }

                            $args = array(
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post_type' => 'publicacao',
                                'numberposts' => 5,
                                'post__not_in' => array($post->ID),
                                'category__in' => $cat_ID,
                            );

                            $cat_posts = get_posts($args);
                        ?>
                        <?php if (!empty($cat_posts)) : ?>
                            <h3 class="aside__title">Outras Publica&ccedil;&otilde;es</h3>
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
