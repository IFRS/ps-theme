<?php get_header(); ?>

<section class="container">
    <?php if (is_search()) : ?>
        <div class="row content">
            <div class="col-12">
                <h2 class="search__title">Resultados da busca por &quot;<?php the_search_query(); ?>&quot;</h2>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!have_posts()) : ?>
        <div class="alert alert-warning">
            <p><strong>Ops!</strong> Nenhum resultado encontrado para o termo &quot;<?php the_search_query(); ?>&quot;.</p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('partials/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <?php echo custom_pagination(); ?>
</section>

<?php get_footer(); ?>
