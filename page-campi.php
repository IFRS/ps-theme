<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <article class="post">
        <h2 class="post__title"><?php the_title(); ?></h2>
        <div class="post__content">
            <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('class' => 'post__thumb'));
                }
            ?>
            <?php the_content(); ?>
            <?php
                $campi = get_terms(array(
                    'taxonomy' => 'campus',
                    'orderby' => 'name',
                    'hide_empty' => false,
                ));
            ?>
            <div class="campi-list">
            <?php foreach ($campi as $campus) : ?>
                <dl class="campi-list__item">
                    <dt class="campi-list__title"><em>Campus</em>&nbsp;<?php echo $campus->name; ?></dt>
                    <?php if (!empty($campus->description)) : ?>
                        <dd><?php echo nl2br($campus->description); ?></dd>
                    <?php endif; ?>
                </dl>
            <?php endforeach; ?>
            </div>
        </div>
    </article>
</section>

<?php get_footer(); ?>
