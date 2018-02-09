<?php if (have_posts()) : ?>
    <div class="row ms-grid">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-12 col-lg-6 ms-item">
            <article class="aviso">
                <div class="aviso__title">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>
                <div class="aviso__date">
                  <p><?php the_date(); ?></p>
                </div>
                <div class="aviso__content"><?php the_excerpt(); ?></div>
                <?php $cats = get_the_category(); ?>
                <?php if (!empty($cats)) : ?>
                  <span class="aviso__category-title">Categorias:</span>
                  <ul class="aviso__categories">
                      <?php foreach ($cats as $key => $cat) : ?>
                          <li><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li>
                      <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
            </article>
        </div>
    <?php endwhile; ?>
    </div>

    <div class="row">
        <div class="col-12">
            <nav class="text-center">
                <?php echo custom_pagination(); ?>
            </nav>
        </div>
    </div>
<?php endif; ?>
