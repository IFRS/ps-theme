<?php get_header(); ?>

<?php
    $ultimo_evento = new WP_Query( array(
		'post_type'      => 'evento',
		'posts_per_page' => 1,
		'orderby'        => 'modified',
		'no_found_rows'  => true,
	) );
    if ($ultimo_evento->have_posts()) {
        $ultimo_evento->the_post();
        $atualizacao = get_the_modified_date();
    }
    wp_reset_postdata();
?>

<section class="container">
    <h2 class="cronograma__title"><?php echo post_type_archive_title(); ?></h2>
    <?php if (!empty($atualizacao)) : ?>
        <p class="cronograma__meta">Atualizado em <?php echo $atualizacao; ?></p>
    <?php endif; ?>
    <p></p>
    <?php if (have_posts()) : ?>
        <table class="table cronograma__table">
            <thead class="thead-light">
                <tr>
                    <th>Período</th>
                    <th>Evento</th>
                </tr>
            </thead>
            <tbody>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $data_inicio = get_post_meta( get_the_ID(), '_evento_data-inicio', true );
                        $data_fim = get_post_meta( get_the_ID(), '_evento_data-fim', true );

                        $hoje = strtotime('today midnight');

                        $evento_inicia_hoje = ($data_inicio == $hoje);
                        $evento_termina_hoje = ($data_fim == $hoje);
                        $evento_ja_passou = ($data_fim < $hoje);
                    ?>
                    <tr class="<?php echo ($evento_ja_passou) ? 'evento--passado' : '' ?>">
                        <td class="evento__datas">
                            <?php if ($data_inicio !== $data_fim) : ?>
                                <?php echo date_i18n('d/m', $data_inicio); ?> a
                            <?php endif; ?>
                            <?php if ($evento_termina_hoje) : ?>
                                <span class="text-danger">
                                    <strong><?php echo date_i18n('d/m/Y', $data_fim); ?></strong>
                                </span>
                            <?php else : ?>
                                <?php echo date_i18n('d/m/Y', $data_fim); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php the_title(); ?></strong>
                            <div class="evento__content">
                                <?php the_content(); ?>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info">
            Nenhuma data cadastrada até o momento.
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
