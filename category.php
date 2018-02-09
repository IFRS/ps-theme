<?php get_header(); ?>

<?php
    $cur_cat_id = get_cat_id( single_cat_title('',false) );
    $category = get_category($cur_cat_id);
    $category = $category->slug;
?>

<section class="container">
    <div class="row">
        <div class="col-12 col-lg-6 col-lg-offset-3">
            <h2 class="category__title"><?php single_cat_title( 'Categoria&nbsp;', true ); ?></h2>
        </div>
    </div>
    <?php echo get_template_part('partials/loop-avisos'); ?>
</section>

<?php get_footer(); ?>
