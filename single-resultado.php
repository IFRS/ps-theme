<?php get_header(); ?>

<?php the_post(); ?>

<section class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <article class="content">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-7">
                        <h2 class="post-title">
                            <?php the_title(); ?>
                        </h2>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-5">
                        <p class="resultado-labels">
                        <?php
                            $modalidades = get_the_terms(get_the_ID(), 'modalidade');
                            foreach ($modalidades as $key => $modalidade) :
                        ?>
                                <span class="label label-modalidade"><?php echo $modalidade->name; ?></span>
                        <?php
                            endforeach;
                        ?>
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
                <div class="row">
                    <div class="col-xs-12">
                        <?php $arquivos = rwmb_meta('resultado_files'); ?>
                        <?php if (!empty($arquivos)) : ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>Arquivos</strong>
                                </div>
                                <div class="list-group">
                                    <?php foreach ($arquivos as $key => $file): ?>
                                        <a href="<?php echo $file['url']; ?>" class="list-group-item list-group-item-info"><?php echo $file['title']; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
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
