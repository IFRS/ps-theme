<?php
    $args = array(
        'post_type' => array('edital', 'publicacao'),
        'posts_per_page' => 6,
        'order' => 'DESC',
        'orderby' => 'modified'
    );

    $publicacoes = new WP_Query($args);
?>
<section class="home-publicacoes">
    <div class="home-publicacoes__title">
        <h2 class="title-sobreposto"><span class="title-sobreposto__apoio">&Uacute;ltimas</span>&nbsp;<span class="title-sobreposto__principal">Publica&ccedil;&otilde;es</span></h2>
    </div>
    <?php if ($publicacoes->have_posts()) : ?>
        <ul class="home-publicacoes__list">
        <?php while ($publicacoes->have_posts()) : $publicacoes->the_post(); ?>
            <li class="home-publicacoes__item">
                <h3 class="home-publicacoes__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="home-publicacoes__item-meta"><span class="home-publicacoes__item-date"><?php echo get_the_modified_date('d/m/Y'); ?></span>&nbsp;<span class="home-publicacoes__item-time"><?php echo get_the_modified_time('G\hi'); ?></span></p>
                <?php the_excerpt(); ?>
            </li>
        <?php endwhile; ?>
        </ul>
        <a href="<?php echo get_post_type_archive_link('publicacao'); ?>" class="btn home-publicacoes__btn">Todas as Publica&ccedil;&otilde;es</a>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <p><strong>Ops!</strong> Ainda n&atilde;o existem publica&ccedil;&otilde;es cadastradas.</p>
        </div>
    <?php endif; ?>
</section>
