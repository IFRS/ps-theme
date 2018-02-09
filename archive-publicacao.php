<?php get_header(); ?>

<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => array('edital', 'publicacao'),
        'posts_per_page' => 12,
        'order' => 'DESC',
        'orderby' => 'date',
        'paged' => $paged
    );

    $publicacoes = new WP_Query($args);
?>

<div class="container">
    <article class="home-publicacoes">
        <div class="home-publicacoes__title">
            <div class="row">
                <div class="col-12">
                    <h3><strong>Publica&ccedil;&otilde;es</strong></h3>
                </div>
            </div>
        </div>
        <div class="home-publicacoes__body">
            <div class="row">
                <div class="col-12">
                <?php if ($publicacoes->have_posts()) : ?>
                    <ul class="home-publicacoes__list">
                    <?php while ($publicacoes->have_posts()) : $publicacoes->the_post(); ?>
                        <li class="home-publicacoes__item">
                            <p class="home-publicacoes__item-meta"><span class="home-publicacoes__item-date"><?php echo get_the_date('d/m/Y'); ?></span>&nbsp;<span class="home-publicacoes__item-time"><?php echo get_the_time('G\hi'); ?></span></p>
                            <h4 class="home-publicacoes__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php the_excerpt(); ?>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        <p><strong>Ops!</strong> Ainda não existem publicações cadastradas.</p>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <?php wp_reset_query(); ?>
            <div class="row">
                <div class="col-12">
                    <nav class="text-center">
                        <?php echo custom_pagination(); ?>
                    </nav>
                </div>
            </div>
        </div>
    </arttcle>
</div>

<?php get_footer(); ?>
