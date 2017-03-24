<?php $parent = wp_get_post_parent_id(get_the_ID()); ?>
<a href="<?php echo get_post_meta(get_the_ID(), '_edital_arquivo', true); ?>" rel="bookmark" class="list-group-item<?php echo (empty($parent) ? ' active' : ' child'); ?>" target="_blank" title="<?php the_title(); ?> (abre em uma nova p&aacute;gina)">
    <h4 class="list-group-item-heading"><?php the_title(); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span><span class="glyphicon glyphicon-new-window pull-right"></span></h4>
    <p class="list-group-item-text">
        <small>
            <span class="glyphicon glyphicon-calendar"></span>&nbsp;<?php if (get_the_modified_time() != get_the_time()) : ?>atualizado em <?php the_modified_time('d'); ?> de <?php the_modified_time('F'); ?> de <?php the_modified_time('Y'); ?>&nbsp; | &nbsp;<?php endif; ?>publicado em <?php the_time('d'); ?> de <?php the_time('F'); ?> de <?php the_time('Y'); ?>
        </small>
    </p>
</a>
