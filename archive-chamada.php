<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="widget-home widget_resultados_widget">
                <?php the_widget( 'Resultados_Widget', array('title' => 'Resultados do Processo Seletivo', array('before_title' => '<h2>', 'after_title' => '</h2>')) ); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <?php if (!dynamic_sidebar('banner')) : endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
