<article class="home-noticias">
    <div class="home-noticias__title">
        <div class="row">
            <div class="col-xs-12">
                <h3><strong>Not&iacute;cias</strong></h3>
            </div>
        </div>
    </div>
    <div class="home-noticias__body">
        <div class="row">
            <div class="col-xs-12">
            <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 4
                );
            
                $noticias = new WP_Query($args);
            ?>
            <?php if ($noticias->have_posts()) : ?>
                <ul class="home-noticias__list">
                <?php while ($noticias->have_posts()) : $noticias->the_post(); ?>
                    <li class="home-noticias__item">
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <p class="home-noticias__item-meta">
                                    <span class="home-noticias__item-day"><?php echo get_the_date('d'); ?></span>
                                    <span class="home-noticias__item-month"><?php echo get_the_date('M'); ?></span>
                                </p>
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <?php echo get_the_category_list(); ?>
                                <h4 class="home-noticias__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    <p><strong>Ops!</strong> Ainda não existem publicações cadastradas.</p>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</arttcle>