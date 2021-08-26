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
    <article class="publicacoes publicacoes--archive">
        <div class="row">
            <div class="col-12">
                <h3 class="publicacoes__title">Publica&ccedil;&otilde;es</h3>
            </div>
        </div>
        <div class="publicacoes__body">
            <div class="row">
                <div class="col-12">
                <?php if ($publicacoes->have_posts()) : ?>
                    <ul class="publicacoes__list">
                    <?php while ($publicacoes->have_posts()) : $publicacoes->the_post(); ?>
                        <li class="publicacoes__item">
                            <h4 class="publicacoes__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <p class="publicacoes__item-meta"><span class="publicacoes__item-date"><?php echo get_the_date('d/m/Y'); ?></span>&nbsp;<span class="publicacoes__item-time"><?php echo get_the_time('G\hi'); ?></span></p>
                            <?php the_excerpt(); ?>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        <p><strong>Ops!</strong> Ainda n&atilde;o existem publica&ccedil;&otilde;es cadastradas.</p>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <?php wp_reset_query(); ?>
            <div class="row">
                <div class="col-12">
                    <?php echo custom_pagination(); ?>
                </div>
            </div>
        </div>
    </article>
</div>

<?php get_footer(); ?>
