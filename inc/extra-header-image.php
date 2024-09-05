<?php
add_action('customize_register', function($wp_customize) {
  $wp_customize->add_setting('extra-header-image');
  $wp_customize->add_setting('extra-header-image-position');

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'extra-header-image',
    array(
      'section' => 'title_tagline',
      'label' => 'Imagem de Cabeçalho Extra',
      'priority' => 100,
    )
  ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'extra-header-image-position',
    array(
      'section' => 'title_tagline',
      'label' => 'Posição da Imagem de Cabeçalho Extra',
      'priority' => 100,
      'type' => 'radio',
      'choices' => array(
        0 => 'Direita',
        1 => 'Esquerda',
      ),
    )
  ) );
});
