<?php
// Programação
add_action( 'cmb2_admin_init', function() {
	$options = new_cmb2_box( array(
		'id'           => 'ps_programacao_options_metabox',
		'title'        => esc_html__( 'Programação do Processo Seletivo', 'ifrs-ps-theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'programacao_options',
		// 'icon_url'        => 'dashicons-palmtree',
		'menu_title'      => esc_html__( 'Programação', 'ifrs-ps-theme' ),
		'parent_slug'     => 'options-general.php',
		'capability'      => 'manage_options',
		// 'position'        => 1,
		// 'admin_menu_hook' => 'network_admin_menu',
		// 'display_cb'      => false,
		// 'save_button'     => esc_html__( 'Salvar Opções', 'ifrs-ps-theme' ),
	) );

  $options->add_field( array(
    'name' => __( 'Inscrições', 'ifrs-ps-theme' ),
    'id'   => 'inscricao',
    'type' => 'title',
  ) );

	$options->add_field( array(
		'name' => __( 'Endereço', 'ifrs-ps-theme' ),
		'desc' => __( 'Indique a URL para o sistema de inscrições.', 'ifrs-ps-theme' ),
		'id'   => 'inscricao_url',
		'type' => 'text_url',
	) );

	$options->add_field( array(
		'name' => __( 'Início', 'ifrs-ps-theme' ),
		'desc' => __( 'Data de abertura das inscrições.', 'ifrs-ps-theme' ),
		'id'   => 'inscricao_inicio',
		'type' => 'text_datetime_timestamp',
	) );

  $options->add_field( array(
		'name' => __( 'Fim', 'ifrs-ps-theme' ),
		'desc' => __( 'Data de encerramento das inscrições.', 'ifrs-ps-theme' ),
		'id'   => 'inscricao_fim',
		'type' => 'text_datetime_timestamp',
	) );

  $options->add_field( array(
    'name' => __( 'Matrículas', 'ifrs-ps-theme' ),
    'id'   => 'matricula',
    'type' => 'title',
  ) );

	$options->add_field( array(
		'name' => __( 'Endereço', 'ifrs-ps-theme' ),
		'desc' => __( 'Indique a URL para o sistema de matrículas.', 'ifrs-ps-theme' ),
		'id'   => 'matricula_url',
		'type' => 'text_url',
	) );

	$options->add_field( array(
		'name' => __( 'Início', 'ifrs-ps-theme' ),
		'desc' => __( 'Data de abertura das matrículas.', 'ifrs-ps-theme' ),
		'id'   => 'matricula_inicio',
		'type' => 'text_datetime_timestamp',
	) );

  $options->add_field( array(
		'name' => __( 'Fim', 'ifrs-ps-theme' ),
		'desc' => __( 'Data de encerramento das matrículas.', 'ifrs-ps-theme' ),
		'id'   => 'matricula_fim',
		'type' => 'text_datetime_timestamp',
	) );
} );
