<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <article class="post">
                <div class="row">
                    <div class="col-12">
                        <h2 class="post__title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="post__content">
                            <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('full', array('class' => 'post__thumb'));
                                }
                            ?>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="row post__meta">
                    <div class="col-12 col-md-6">
                        <p class="post__date">Publicado em <?php the_date('d/m/Y'); ?></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php $cats = get_the_category(); ?>
                        <?php if (!empty($cats)) : ?>
                            <ul class="post__categories">
                                <?php foreach ($cats as $key => $cat) : ?>
                                    <li><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-lg-4">
            <aside>
                <div class="row">
                    <div class="col-12">
                        <!-- Outros posts das mesmas categorias. -->
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
                                'post_type' => 'post',
                                'numberposts' => 5,
                                'post__not_in' => array($post->ID),
                                'category__in' => $cat_ID,
                            );

                            $cat_posts = get_posts($args);
                        ?>
                        <?php if (!empty($cat_posts)) : ?>
                            <h3 class="aside__title">Conte&uacute;do Relacionado</h3>
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
