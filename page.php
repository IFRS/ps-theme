<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <article class="post content">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="post-title"><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post-content">
                            <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('full', array('class' => 'post-thumb'));
                                }
                            ?>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <?php if (!dynamic_sidebar('banner')) : endif; ?>
                    <br/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Outras páginas. -->
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
                            'post_type' => 'page',
                            'numberposts' => 5,
                            'post__not_in' => array($post->ID),
                        );

                        $cat_posts = get_posts($args);
                    ?>
                    <?php if (!empty($cat_posts)) : ?>
                        <div class="well">
                            <h3>Outros Conte&uacute;dos</h3>
                            <?php foreach ($cat_posts as $cat_post) : ?>
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="<?php echo get_permalink($cat_post->ID); ?>">
                                            <?php if (has_post_thumbnail($cat_post->ID)) : ?>
                                                <?php echo get_the_post_thumbnail($cat_post->ID, 'thumbnail', array('class' => 'media-object')); ?>
                                            <?php else : ?>
                                                <img class="media-object" src="<?php echo get_stylesheet_directory_uri(); ?>/img/placeholder-content.png" alt="<?php echo $cat_post->post_title; ?>"/>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                                        <p><?php echo $cat_post->post_excerpt; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
