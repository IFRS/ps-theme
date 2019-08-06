<?php if (have_posts()) : ?>
    <div class="list-group">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php echo get_template_part('partials/editais/item'); ?>
            <?php
                $args = array(
                	'posts_per_page'   => -1,
                    'nopaging'         => true,
                	'orderby'          => 'menu_order',
                	'order'            => 'DESC',
                	'post_type'        => 'edital',
                	'post_parent'      => get_the_ID(),
                	'post_status'      => 'publish'
                );
                $edital_children = new WP_Query( $args );
            ?>
            <?php while ( $edital_children->have_posts() ) : $edital_children->the_post(); ?>
                <?php echo get_template_part('partials/editais/item'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="alert alert-warning" role="alert">
        <p><strong>Aguarde!</strong> Em breve os editais ser&atilde;o publicados.</p>
    </div>
<?php endif; ?>
