<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="editais">
                <h2 class="editais__title">Editais</h2>
                <?php echo get_template_part('partials/loop', 'editais'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
