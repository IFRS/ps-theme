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

    $eventos_js = array();
?>

<section class="container">
    <h2 class="cronograma__title"><?php echo post_type_archive_title(); ?></h2>
    <?php if (!empty($atualizacao)) : ?>
        <p class="cronograma__meta">Atualizado em <?php echo $atualizacao; ?></p>
    <?php endif; ?>
    <p></p>
    <?php if (have_posts()) : ?>
        <div class="table-responsive-sm">
            <table class="table cronograma__table">
                <thead class="thead-light">
                    <tr>
                        <th>Per&iacute;odo</th>
                        <th>Evento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php $eventos_js[] = get_the_ID(); ?>
                        <?php
                            $data_inicio = get_post_meta( get_the_ID(), '_evento_data-inicio', true );
                            $data_fim = get_post_meta( get_the_ID(), '_evento_data-fim', true );

                            $hoje = strtotime('today midnight');

                            $evento_inicia_hoje = ($data_inicio == $hoje);
                            $evento_termina_hoje = ($data_fim == $hoje);
                            $evento_atual = ($data_inicio <= $hoje && $data_fim > $hoje);
                            $evento_passou = ($data_fim < $hoje);
                        ?>
                        <tr class="<?php echo ($evento_passou) ? 'evento--passado' : '' ?>" id="evento-<?php echo get_the_ID(); ?>">
                            <td class="evento__datas<?php echo ($evento_atual) ? ' text-success' : ''; ?>">
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
                            <td class="evento__content">
                                <strong><?php the_title(); ?></strong>
                                <?php the_content(); ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            Nenhuma data cadastrada at&eacute; o momento.
        </div>
    <?php endif; ?>
</section>

<?php wp_localize_script( 'cronograma', 'cronograma', $eventos_js ); ?>

<?php get_footer(); ?>
