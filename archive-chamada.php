<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <?php the_widget( 'Chamadas_Widget', array('title' => 'Chamadas do Processo Seletivo'), array('before_title' => '<div class="widget-chamadas__title"><h3>', 'after_title' => '</h3></div>') ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
