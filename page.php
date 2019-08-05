<?php
    // Outras páginas.
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

<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col">
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
        <?php if (!empty($cat_posts)) : ?>
            <div class="col-12 col-lg-4">
                <aside class="aside">
                    <h3 class="aside__title title-sobreposto"><span class="title-sobreposto__apoio">Outros</span>&nbsp;<span class="title-sobreposto__principal">Conte&uacute;dos</span></h3>
                    <div class="aside__content">
                    <?php foreach ($cat_posts as $cat_post) : ?>
                        <div class="aside__item">
                            <h4 class="aside__item-title"><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                            <p class="aside__item-meta"><?php echo $cat_post->post_excerpt; ?></p>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
