<?php
    $args = array(
        'post_type' => array('edital', 'publicacao'),
        'posts_per_page' => 6,
        'order' => 'DESC',
        'orderby' => 'modified'
    );

    $publicacoes = new WP_Query($args);
?>
<section class="publicacoes">
    <h2 class="publicacoes__title">&Uacute;ltimas Publica&ccedil;&otilde;es</h2>
    <?php if ($publicacoes->have_posts()) : ?>
        <ul class="publicacoes__list">
        <?php while ($publicacoes->have_posts()) : $publicacoes->the_post(); ?>
            <li class="publicacoes__item">
                <h3 class="publicacoes__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="publicacoes__item-meta" data-toggle="tooltip" data-placement="right" title="<?php echo get_the_modified_date('d/m/Y'); ?> - <?php echo get_the_modified_time('G\hi'); ?>">atualizado <?php echo ps_relative_past_time(get_the_modified_date('c')); ?></p>
                <?php the_excerpt(); ?>
            </li>
        <?php endwhile; ?>
        </ul>
        <a href="<?php echo get_post_type_archive_link('publicacao'); ?>" class="btn publicacoes__btn">Todas as Publica&ccedil;&otilde;es</a>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <p><strong>Ops!</strong> Ainda n&atilde;o existem publica&ccedil;&otilde;es cadastradas.</p>
        </div>
    <?php endif; ?>
</section>
