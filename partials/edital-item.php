<?php $parent = wp_get_post_parent_id(get_the_ID()); ?>
<a href="<?php echo get_post_meta(get_the_ID(), '_edital_arquivo', true); ?>" rel="bookmark" class="flex-column align-items-start list-group-item list-group-item-action<?php echo (empty($parent) ? ' list-group-item-primary' : ' list-group-item-light child'); ?>" target="_blank" title="<?php the_title(); ?> (abre em uma nova p&aacute;gina)">
    <div class="d-flex w-100 justify-content-between">
    <?php if (empty($parent)) : ?>
        <h3 class="mb-1"><?php the_title(); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></h3>
    <?php else : ?>
        <h4 class="mb-1"><?php the_title(); ?><span class="sr-only">&nbsp;(abre uma nova p&aacute;gina)</span></h4>
    <?php endif; ?>
    </div>
    <p class="mb-1">
        <small><?php if (get_the_modified_time() != get_the_time()) : ?>atualizado em <?php the_modified_time('d'); ?> de <?php the_modified_time('F'); ?> de <?php the_modified_time('Y'); ?>&nbsp; | &nbsp;<?php endif; ?>publicado em <?php the_time('d'); ?> de <?php the_time('F'); ?> de <?php the_time('Y'); ?></small>
    </p>
</a>
