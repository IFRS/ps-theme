<?php get_header(); ?>

<?php
    $cur_cat_id = get_cat_id( single_cat_title('',false) );
    $category = get_category($cur_cat_id);
    $category = $category->slug;
?>

<section class="container">
    <h2 class="avisos__title"><?php single_cat_title( 'Categoria&nbsp;', true ); ?></h2>
    <?php echo get_template_part('partials/avisos/loop'); ?>
</section>

<?php get_footer(); ?>
