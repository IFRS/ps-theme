<?php get_header(); ?>

<section class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title">Perguntas Frequentes<?php if (is_search() && get_search_query()) : ?><small>&nbsp;(Resultados da busca por &ldquo;<?php echo get_search_query(); ?>&rdquo;)</small><?php endif; ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 col-lg-offset-6">
                        <form class="inline-form" method="get" action="." role="form">
                            <div class="input-group">
                                <label class="sr-only" for="s">Termo da busca</label>
                                <input class="form-control" type="text" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" name="s" id="s" placeholder="Digite sua busca..."/>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                        </form>
                        <br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="panel-group" id="accordion">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" id="heading<?php the_ID(); ?>">
                                    <h3 class="panel-title">
                                        <span class="glyphicon glyphicon-triangle-right"></span>
                                        <a data-toggle="collapse" data-parent="#accordion" href="<?php the_permalink(); ?>#collapse<?php the_ID(); ?>" aria-controls="collapse<?php the_ID(); ?>" aria-expanded="false">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse<?php if (is_search() && get_search_query()) : echo ' in'; endif; ?>" role="tabpanel" aria-labelledby="heading<?php the_ID(); ?>">
                                    <div class="panel-body">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <?php if (!dynamic_sidebar('banner')) : endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
