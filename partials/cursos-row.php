<tr>
    <td><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'campus') as $campus) : ?>
            <p><?php echo $campus->name; ?></p>
        <?php endforeach; ?>
    </td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'modalidade') as $modalidade) : ?>
            <p><a href="<?php echo get_term_link($modalidade); ?>"><?php echo $modalidade->name; ?></a></p>
        <?php endforeach; ?>
    </td>
    <td>
        <?php foreach (get_the_terms(get_the_ID(), 'turno') as $turno) : ?>
            <p><?php echo $turno->name; ?></p>
        <?php endforeach; ?>
    </td>
    <td>
        <p><?php echo get_post_meta(get_the_ID(), '_curso_vagas', true); ?></p>
    </td>
</tr>
