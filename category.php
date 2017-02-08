<?php get_header(); ?>

<?php
    $cur_cat_id = get_cat_id( single_cat_title('',false) );
    $category = get_category($cur_cat_id);
    $category = $category->slug;
?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="title cat-title"><?php single_cat_title( 'Categoria&nbsp;', true ); ?></h2>
                </div>
            </div>
            <div id="ms-grid">
                <?php echo get_template_part('partials/loop-avisos'); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <?php if (!dynamic_sidebar('banner')) : endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
