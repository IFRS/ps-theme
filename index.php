<?php get_header(); ?>

<section class="container">
    <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
        <p>Nenhum resultado encontrado.</p>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>

    <?php if (is_search()) : ?>
    <div class="row content">
      <div class="col-xs-12">
        <h2 class="title">Resultados da busca por &quot;<?php the_search_query(); ?>&quot;</h2>
      </div>
    </div>
    <?php endif; ?>

    <div class="row content">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('partials/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
      <?php endwhile; ?>
    </div>

    <?php the_posts_navigation(array('next_text' => 'Resultados anteriores', 'prev_text' => 'Mais resultados', 'screen_reader_text' => ' ')); ?>
</section>

<?php get_footer(); ?>
