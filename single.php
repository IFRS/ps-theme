<?php
    // Outros posts das mesmas categorias.
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
                            <hr>
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
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-lg-4">
            <aside class="aside">
                <?php if (!empty($cat_posts)) : ?>
                    <h3 class="aside__title title-sobreposto"><span class="title-sobreposto__apoio">Conte&uacute;do</span>&nbsp;<span class="title-sobreposto__principal">Relacionado</span></h3>
                    <div class="aside__content">
                        <?php foreach ($cat_posts as $cat_post) : ?>
                            <div class="aside__item">
                                <h4 class="aside__item-title"><a href="<?php echo get_permalink($cat_post->ID); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                                <p class="aside__item-meta"><?php echo get_the_date('d/m/Y', $cat_post->ID); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
