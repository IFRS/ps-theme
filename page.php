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
            </article>
        </div>
        <div class="col-12 col-lg-4">
            <aside>
                <div class="row">
                    <div class="col-12">
                        <!-- Outras páginas. -->
                        <?php
                            global $post;

                            $frontpage_id = get_option( 'page_on_front' );
                            $blog_id = get_option( 'page_for_posts' );

                            $args = array(
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post_type' => 'page',
                                'numberposts' => 5,
                                'post__not_in' => array($post->ID, $frontpage_id, $blog_id),
                            );

                            $cat_posts = get_posts($args);
                        ?>
                        <?php if (!empty($cat_posts)) : ?>
                            <h3 class="aside__title">Outros Conte&uacute;dos</h3>
                            <?php foreach ($cat_posts as $cat_post) : ?>
                                <div class="card">
                                    <?php if (has_post_thumbnail($cat_post->ID)) : ?>
                                        <?php echo get_the_post_thumbnail($cat_post->ID, 'thumbnail', array('class' => 'card-img-top')); ?>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                                        <p class="card-text"><?php echo $cat_post->post_excerpt; ?></p>
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
