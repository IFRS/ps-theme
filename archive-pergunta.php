<?php get_header(); ?>

<section class="container">
    <article class="faq" id="faq">
        <h2 class="faq__title">Voc&ecirc; tem alguma d&uacute;vida?</h2>
        <?php $accordion_id = uniqid('perguntas-'); ?>
        <?php $field_id = uniqid(); ?>
        <label for="<?php echo $field_id; ?>" class="visually-hidden">Buscar nas perguntas</label>
        <input type="search" id="<?php echo $field_id; ?>" class="form-control form-control-sm faq__busca search" placeholder="buscar nas perguntas..." aria-controls="<?php echo $accordion_id; ?>">
        <?php if (have_posts()) : ?>
            <div class="accordion faq__perguntas" id="<?php echo $accordion_id; ?>" aria-live="assertive">
                <?php while (have_posts()) : the_post(); ?>
                    <dl class="accordion-item">
                        <dt class="accordion-header" id="pergunta<?php the_ID(); ?>">
                            <button type="button" class="pt-4 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#resposta<?php the_ID(); ?>" aria-expanded="false" aria-controls="resposta<?php the_ID(); ?>">
                                <span class="position-absolute top-0 start-0 badge bg-light text-dark">
                                    <?php
                                        $categories = get_the_category();
                                        foreach ($categories as $category) {
                                            echo $category->name;
                                            if ($category !== end($categories)) echo ', ';
                                        }
                                    ?>
                                </span>
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
</section>

<?php get_footer(); ?>
