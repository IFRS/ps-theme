<?php
    $hide_unidades = $args['hide_unidades'] ?? false;

    $campi = get_the_terms(get_the_ID(), 'campus');
    $modalidades = get_the_terms(get_the_ID(), 'modalidade');
    $formasingresso = get_the_terms(get_the_ID(), 'formaingresso');
?>

<tr>
    <td><a href="<?php echo get_permalink() ?>" data-bs-toggle="modal" data-bs-target="#modal-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a><?php echo get_post_meta( get_the_ID(), '_curso_ead', 1 ) ? '&sup2;' : '' ?></td>
    <?php if (!$hide_unidades) : ?>
        <td>
            <?php if (!empty($campi)) : ?>
                <?php foreach ($campi as $campus) : ?>
                    <?php echo $campus->name; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </td>
    <?php endif; ?>
    <td>
        <?php if (!empty($modalidades)) : ?>
            <?php foreach ($modalidades as $modalidade) : ?>
                <?php echo $modalidade->name; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </td>
    <td>
        <?php
            if (!empty($formasingresso)) {
                foreach ($formasingresso as $key => $formaingresso) {
                    if (!empty($formaingresso->description)) {
                        printf('<span class="formaingresso-help" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="%s">%s</span>', $formaingresso->description, $formaingresso->name);
                    } else {
                        echo $formaingresso->name;
                    }
                    echo ($key !== array_key_last($formasingresso)) ? ' ou ' : '';
                }
            }
        ?>
    </td>
    <td>
        <?php $turnos = wp_get_post_terms(get_the_ID(), 'turno', array('orderby' => 'term_order')); ?>
        <?php foreach ($turnos as $key => $turno) : ?>
            <?php echo $turno->name; echo ($key !== array_key_last($turnos)) ? ' e ' : ''; ?>
        <?php endforeach; ?>
    </td>
    <td class="text-center">
        <?php echo get_post_meta(get_the_ID(), '_curso_vagas', true); ?>
    </td>
</tr>
