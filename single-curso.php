<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <article class="post">
        <h2 class="post__title"><?php the_title(); ?></h2>
        <div class="post__content">
            <?php echo get_template_part( 'partials/cursos/curso' ); ?>
        </div>
    </article>
    <?php
        // Outros cursos do mesmo Campus.
        global $post;

        $camp_slug = array();

        $campus = get_the_terms(get_the_ID(), 'campus');
        foreach ($campus as $camp) {
            array_push($camp_slug, $camp->slug);
        }

        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'curso',
            'numberposts' => -1,
            'post__not_in' => array($post->ID),
            'tax_query' => array(
                array(
                    'taxonomy' => 'campus',
                    'field' => 'slug',
                    'terms' => $camp_slug,
                ),
            ),
        );

        $cat_posts = get_posts($args);
    ?>
    <?php if (!empty($cat_posts)) : ?>
            <aside class="aside">
                <h3 class="aside__title">Outros Cursos do mesmo Campus</h3>
                <div class="aside__content">
                    <?php foreach ($cat_posts as $cat_post) : ?>
                        <div class="aside__item">
                            <h3 class="aside__item-title"><a href="<?php echo get_permalink($cat_post); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
