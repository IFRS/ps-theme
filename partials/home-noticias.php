<?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4
    );

    $noticias = new WP_Query($args);
?>
<section class="home-noticias">
    <div class="home-noticias__title">
        <h2 class="title-sobreposto"><span class="title-sobreposto__apoio">&Uacute;ltimos</span>&nbsp;<span class="title-sobreposto__principal">Avisos</strong></h2>
    </div>
        <?php if ($noticias->have_posts()) : ?>
            <div class="home-noticias__content">
                <?php while ($noticias->have_posts()) : $noticias->the_post(); ?>
                    <article class="home-noticias__item">
                        <div class="row">
                            <div class="col-3 col-md-2 col-lg-4 col-xl-3">
                                <p class="home-noticias__item-meta">
                                    <span class="home-noticias__item-day"><?php echo get_the_date('d'); ?></span>
                                    <span class="home-noticias__item-month"><?php echo get_the_date('M'); ?></span>
                                </p>
                            </div>
                            <div class="col-9 col-md-8 col-lg-8 col-xl-9">
                                <?php echo get_the_category_list(); ?>
                                <h4 class="home-noticias__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn home-noticias__btn">Todas as not&iacute;cias</a>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                <p><strong>Ops!</strong> Ainda não existem notícias cadastradas.</p>
            </div>
        <?php endif; ?>
</section>
