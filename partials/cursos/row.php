<tr>
    <td><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a><?php echo get_post_meta( get_the_ID(), '_curso_ead', 1 ) ? '&sup2;' : '' ?></td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'campus') as $campus) : ?>
            <?php echo $campus->name; ?>
        <?php endforeach; ?>
    </td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'modalidade') as $modalidade) : ?>
            <?php echo $modalidade->name; ?>
        <?php endforeach; ?>
    </td>
    <td>
        <?php $turnos = get_the_terms(get_the_ID(), 'turno'); ?>
        <?php foreach ($turnos as $key => $turno) : ?>
            <?php echo $turno->name; echo ($key !== array_key_last($turnos)) ? ',' : ''; ?>
        <?php endforeach; ?>
    </td>
    <td class="text-center">
        <?php echo get_post_meta(get_the_ID(), '_curso_vagas', true); ?>
    </td>
</tr>
