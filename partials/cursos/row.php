<tr>
    <td><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a><?php echo get_post_meta( get_the_ID(), '_curso_ead', 1 ) ? '&sup2;' : '' ?></td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'campus') as $campus) : ?>
            <p><?php echo $campus->name; ?></p>
        <?php endforeach; ?>
    </td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'modalidade') as $modalidade) : ?>
            <p><?php echo $modalidade->name; ?></p>
        <?php endforeach; ?>
    </td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'turno') as $turno) : ?>
            <p><?php echo $turno->name; ?></p>
        <?php endforeach; ?>
    </td>
    <td class="text-center">
        <p><?php echo get_post_meta(get_the_ID(), '_curso_vagas', true); ?></p>
    </td>
</tr>
