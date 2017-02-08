<?php if (have_posts()) : ?>
    <div class="row" id="home-avisos">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-xs-12 col-md-6 ms-item">
            <article class="home-aviso">
                <div class="row">
                    <div class="col-xs-3 col-sm-2 col-md-3 col-lg-2 aviso-data-wrapper">
                        <div class="aviso-data">
                            <span class="dia"><?php the_time('d'); ?></span>
                            <?php echo str_replace('.', '', get_the_time('M')); ?>
                        </div>
                    </div>
                    <div class="col-xs-9 col-sm-10 col-md-9 col-lg-10">
                        <div class="aviso-titulo">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </div>
                        <div class="aviso-content"><?php the_excerpt(); ?></div>
                        <?php $cats = get_the_category(); ?>
                        <?php if (!empty($cats)) : ?>
                            <span class="aviso-categorias-title">Categorias:</span>
                            <ul class="aviso-categorias">
                                <?php foreach ($cats as $key => $cat) : ?>
                                    <li><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-leia-mais btn-sm pull-right">Leia mais<span class="sr-only">&nbsp;sobre &quot;<?php the_title(); ?>&quot;</span></a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </article>
        </div>
    <?php endwhile; ?>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <nav class="text-center">
                <?php echo custom_pagination(); ?>
            </nav>
        </div>
    </div>
<?php endif; ?>
