<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <article class="content">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-7">
                        <h2 class="post-title"><?php the_title(); ?></h2>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-5">
                        <p class="resultado-labels">
                        <?php
                            $campi = get_the_terms(get_the_ID(), 'campus');
                            foreach ($campi as $key => $campus) :
                        ?>
                                <span class="label label-campus"><?php echo $campus->name; ?></span>
                        <?php
                            endforeach;
                        ?>
                        <?php
                            $formasingresso = get_the_terms(get_the_ID(), 'formaingresso');
                            foreach ($formasingresso as $key => $formaingresso) :
                        ?>
                                <span class="label label-formaingresso"><?php echo $formaingresso->name; ?></span>
                        <?php
                            endforeach;
                        ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php $resultados = get_post_meta(get_the_ID(), '_resultado_arquivos_group'); ?>
                <?php if (!empty($resultados)) : ?>
                    <div class="row">
                        <?php foreach ($resultados[0] as $resultado) : ?>
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong><?php echo get_term($resultado['modalidade'], 'modalidade')->name; ?></strong>
                                    </div>
                                    <div class="list-group">
                                        <?php foreach ($resultado['arquivos'] as $id => $url): ?>
                                            <a href="<?php echo esc_url($url); ?>" class="list-group-item list-group-item-info" target="_blank"><?php echo get_the_title($id); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <hr/>
                <div class="row post-meta">
                    <div class="col-xs-12">
                        <p class="post-date">Publicado em <?php the_date('d/m/Y'); ?></p>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-xs-12">
                    <?php if (!dynamic_sidebar('banner')) : endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
