<?php if (have_posts()) : ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col">
            <article class="card">
                <?php if (!is_category()) : ?>
                <div class="card-header">
                    <?php $cats = get_the_category(); ?>
                    <?php if (!empty($cats)) : ?>
                        <ul class="list-inline mb-0">
                            <?php foreach ($cats as $key => $cat) : ?>
                                <li class="list-inline-item"><a href="<?php echo get_category_link( $cat->term_id ); ?>" class="text-muted"><?php echo $cat->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <small class="d-block text-muted mb-2"><?php the_date(); ?></small>
                    <div class="card-text"><?php the_excerpt(); ?></div>
                </div>
            </article>
        </div>
    <?php endwhile; ?>
    </div>

    <div class="row">
        <div class="col-12">
            <?php echo custom_pagination(); ?>
        </div>
    </div>
<?php endif; ?>
