<?php $parent = wp_get_post_parent_id(get_the_ID()); ?>
<a href="<?php echo get_the_permalink(); ?>" rel="bookmark" class="flex-column align-items-start list-group-item list-group-item-action<?php echo (empty($parent) ? '' : ' list-group-item-light child'); ?>" title="<?php the_title(); ?>">
    <div class="d-flex w-100 justify-content-between">
    <?php if (empty($parent)) : ?>
        <h3 class="mb-1"><?php the_title(); ?></h3>
    <?php else : ?>
        <h4 class="mb-1"><?php the_title(); ?></h4>
    <?php endif; ?>
    </div>
    <p class="mb-1">
        <small>publicado em <?php the_time('d \d\e F \d\e Y'); ?></small>
        <?php if (get_the_modified_time() != get_the_time()) : ?>
            &nbsp;&mdash;&nbsp;
            <small>atualizado em <?php the_modified_time('d \d\e F \d\e Y'); ?></small>
        <?php endif; ?>
    </p>
</a>
