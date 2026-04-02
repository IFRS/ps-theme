<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <article class="publicacao">
        <h2 class="publicacao__title"><?php the_title(); ?></h2>
        <div class="publicacao__content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <p class="publicacao__date text-left">Publicado em <?php the_date('d/m/Y'); ?></p>
                </div>
                <div class="col-12 col-md-6">
                    <p class="publicacao__date text-right">Atualizado em <?php the_modified_date('d/m/Y'); ?></p>
                </div>
            </div>
            <?php the_content(); ?>
            <?php $files = get_post_meta( get_the_ID(), '_publicacao_arquivos', true ); ?>
            <?php if (!empty($files)) : ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Arquivos</h3>
                    </div>
                    <div class="list-group list-group-flush">
                    <?php foreach ($files as $id => $file) : ?>
                        <a class="list-group-item list-group-item-action" href="<?php echo esc_url($file); ?>"><?php echo get_the_title($id); ?></a>
                    <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </article>
    <?php
        // Outras publicações.
        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'publicacao',
            'numberposts' => 4,
            'post__not_in' => array($post->ID),
        );

        $outras_publicacoes = get_posts($args);
    ?>
    <?php if (!empty($outras_publicacoes)) : ?>
        <aside class="aside">
            <h3 class="aside__title">Outras Publica&ccedil;&otilde;es</h3>
            <div class="aside__content">
                <?php foreach ($outras_publicacoes as $cat_post) : ?>
                    <?php if (has_post_thumbnail($cat_post->ID)) : ?>
                        <?php echo get_the_post_thumbnail($cat_post->ID, 'thumbnail', array('class' => 'card-img-top')); ?>
                    <?php endif; ?>
                    <div class="aside__item">
                        <h4 class="aside__item-title"><a href="<?php echo get_permalink($cat_post); ?>" rel="bookmark"><?php echo $cat_post->post_title; ?></a></h4>
                        <p class="aside__item-meta"><?php echo get_the_date('d/m/Y', $cat_post->ID); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </aside>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
