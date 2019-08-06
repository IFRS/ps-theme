<?php get_header(); ?>

<section class="container">
    <div class="editais">
        <div class="row">
            <div class="col-12">
                <h2 class="editais__title">Editais</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php echo get_template_part('partials/editais/loop'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
