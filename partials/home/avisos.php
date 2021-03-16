<?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5
    );

    $noticias = new WP_Query($args);
?>
<section class="home-avisos">
    <h2 class="home-avisos__title">&Uacute;ltimos Avisos</h2>
    <?php if ($noticias->have_posts()) : ?>
        <div class="home-avisos__content">
            <?php while ($noticias->have_posts()) : $noticias->the_post(); ?>
                <article class="home-avisos__item">
                    <p class="home-avisos__item-meta">
                        <span class="home-avisos__item-day"><?php echo get_the_date('d'); ?></span>
                        <span class="home-avisos__item-month"><?php echo get_the_date('M'); ?></span>
                    </p>
                    <div class="home-avisos__item-content">
                        <?php echo get_the_category_list(); ?>
                        <h4 class="home-avisos__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn home-avisos__btn">Todos os avisos</a>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <p><strong>Ops!</strong> Ainda n&atilde;o existem avisos cadastradas.</p>
        </div>
    <?php endif; ?>
</section>
