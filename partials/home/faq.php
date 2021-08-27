<article class="faq" id="faq">
    <h2 class="faq__title">Voc&ecirc; tem alguma d&uacute;vida?</h2>
    <?php $field_id = uniqid(); ?>
    <label for="<?php echo $field_id; ?>" class="visually-hidden">Buscar nas perguntas</label>
    <input type="search" id="<?php echo $field_id; ?>" class="form-control form-control-sm faq__busca search" placeholder="buscar nas perguntas...">
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
        <?php $accordion_id = uniqid('perguntas-'); ?>
        <div class="accordion faq__perguntas" id="<?php echo $accordion_id; ?>">
            <?php while ($perguntas->have_posts()) : $perguntas->the_post(); ?>
                <dl class="accordion-item">
                    <dt class="accordion-header" id="pergunta<?php the_ID(); ?>">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#resposta<?php the_ID(); ?>" aria-expanded="false" aria-controls="resposta<?php the_ID(); ?>">
                            <?php the_title(); ?>
                        </button>
                    </dt>
                    <dd id="resposta<?php the_ID(); ?>" class="accordion-collapse collapse" data-bs-parent="#<?php echo $accordion_id; ?>" aria-labelledby="pergunta<?php the_ID(); ?>">
                        <div class="accordion-body">
                            <?php the_content(); ?>
                        </div>
                    </dd>
                </dl>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <strong>Ops!</strong> Ainda n&atilde;o existem perguntas cadastradas.
        </div>
    <?php endif; ?>
</article>
