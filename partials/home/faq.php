<article class="home-faq">
    <h2 class="home-faq__title">Voc&ecirc; tem alguma d&uacute;vida?</h2>
    <?php
        $args = array(
            'post_type' => 'pergunta',
            'nopaging ' => true,
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'menu_order'
        );

        $perguntas = new WP_Query($args);
    ?>
    <?php if ($perguntas->have_posts()) : ?>
        <div class="home-faq__perguntas" id="home-faq__perguntas">
        <?php while ($perguntas->have_posts()) : $perguntas->the_post(); ?>
            <div class="card home-faq__item">
                <div class="card-header" id="heading<?php the_ID(); ?>">
                    <h4 class="mb-0 home-faq__item-title">
                        <a href="<?php the_permalink(); ?>" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapse<?php the_ID(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                </div>

                <div id="collapse<?php the_ID(); ?>" class="collapse" aria-labelledby="heading<?php the_ID(); ?>" data-parent="#home-faq__perguntas">
                    <div class="card-body home-faq__item-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <p><strong>Ops!</strong> Ainda n&atilde;o existem perguntas cadastradas.</p>
        </div>
    <?php endif; ?>
</article>
