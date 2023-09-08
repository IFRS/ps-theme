<?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5
    );

    $noticias = new WP_Query($args);
?>
<section class="home-avisos">
    <h2 class="home-avisos__title">Se liga!</h2>
    <?php if ($noticias->have_posts()) : ?>
        <div class="home-avisos__content">
            <?php while ($noticias->have_posts()) : $noticias->the_post(); ?>
                <article class="home-aviso">
                    <p class="home-aviso__meta">
                        <?php echo get_the_date('d \d\e F'); ?>
                        &ndash;
                    </p>
                    <?php echo get_the_category_list(); ?>
                    <h3 class="home-aviso__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </article>
            <?php endwhile; ?>
        </div>
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn btn-ps text-uppercase"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></a>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <p>Ainda n&atilde;o h&aacute; novidades para esse Processo Seletivo.</p>
        </div>
    <?php endif; ?>
</section>
