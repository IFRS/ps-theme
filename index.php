<?php get_header(); ?>

<section class="container">
    <?php if (is_search()) : ?>
        <div class="row">
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
        <?php while (have_posts()) : the_post(); ?>
            <div class="row">
                <div class="col-12">
                    <article class="search__entry">
                        <h3 class="search__entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="search__entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                </div>
            </div>
            <hr>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php echo custom_pagination(); ?>
</section>

<?php get_footer(); ?>
