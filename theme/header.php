<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Departamento de Comunicação do IFRS">
  <meta name="keywords" content="ifrs, processo, seletivo, vestibular, ingresso, estudar">
  <meta name="description" content="Site com informações sobre o Processo Seletivo de Estudantes do IFRS.">
  <!-- WP -->
  <?php wp_head(); ?>
  <?php echo get_template_part('partials/header-image'); ?>
</head>

<?php
  $extra_image = get_theme_mod('extra-header-image');
  $extra_image_position = get_theme_mod('extra-header-image-position');
  $extra_image_class = $extra_image_position ? 'order-first' : 'order-last';
?>

<body <?php body_class() ?>>
  <a href="#inicio-conteudo" class="visually-hidden">Pular para o conte&uacute;do</a>

  <?php wp_body_open(); ?>

  <!-- Menu -->
  <?php echo get_template_part('partials/menu'); ?>

  <!-- Cabeçalho -->
  <header>

    <section class="container">
      <h1 class="<?php echo display_header_text() ? 'header-text' : 'visually-hidden'; ?>"><?php bloginfo('name'); ?></h1>

      <?php if (display_header_text()) : ?>
        <p class="header-text"><?php bloginfo('description'); ?></p>
      <?php endif; ?>

      <div class="header-content">
        <?php the_custom_logo(); ?>
        <?php if ($extra_image) : ?>
          <?php list($width, $height, $type, $attr) = getimagesize($extra_image); ?>
          <img src="<?php echo esc_url($extra_image); ?>" aria-hidden="true" alt="" loading="lazy" class="header-content__extra-image <?php echo $extra_image_class ?>" <?php echo $attr; ?>>
        <?php endif; ?>
      </div>
    </section>



    <?php if (is_active_sidebar('faixa_destaque')) : ?>
      <?php dynamic_sidebar('faixa_destaque'); ?>
    <?php endif; ?>
  </header>

  <!-- Corpo -->
  <a href="#inicio-conteudo" id="inicio-conteudo" class="visually-hidden">In&iacute;cio do conte&uacute;do</a>

  <main>
  <?php
    if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
      yoast_breadcrumb( '<div class="breadcrumb-wrapper"><nav aria-label="Você está em:" class="container">', '</nav></div>' );
    } else {
      ps_breadcrumb();
    }
  ?>
