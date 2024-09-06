<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Departamento de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, processo, seletivo, vestibular, ingresso, estudar">
    <meta name="description" content="Site com informações sobre o Processo Seletivo de Estudantes do IFRS.">
    <!-- Favicons -->
    <?php if (!has_site_icon()) echo get_template_part('partials/favicons'); ?>
    <!-- WP -->
    <?php wp_head(); ?>
    <?php echo get_template_part('partials/header-image'); ?>
</head>

<?php
    $extra_image = get_theme_mod('extra-header-image');
    $extra_image_position = get_theme_mod('extra-header-image-position');
?>

<body <?php body_class() ?>>
    <a href="#main" class="visually-hidden">Pular para o conte&uacute;do</a>

    <?php wp_body_open(); ?>

    <!-- Cabeçalho -->
    <header>
        <h1 class="visually-hidden"><?php bloginfo('name'); ?></h1>
        <section class="container header">
            <div class="row align-items-center justify-content-center">
                <div class="col-auto col-lg-6 col-xl-auto flex-shrink-1">
                    <?php the_custom_logo(); ?>
                </div>
                <?php if ($extra_image) : ?>
                    <div class="col-lg-6 col-xl-auto flex-shrink-1 d-none d-lg-block <?php echo ($extra_image_position ? 'order-first' : 'order-last') ?>">
                        <img src="<?php echo esc_url($extra_image); ?>" aria-hidden="true" alt="" loading="lazy" class="extra-header-image">
                    </div>
                <?php endif; ?>
            </div>
            <?php if (display_header_text()) : ?>
                <p><?php bloginfo('description'); ?></p>
            <?php endif; ?>

        </section>
    </header>

    <!-- Menu -->
    <?php echo get_template_part('partials/menu'); ?>

    <!-- Corpo -->
    <a href="#inicio-conteudo" id="inicio-conteudo" class="visually-hidden">In&iacute;cio do conte&uacute;do</a>

    <main role="main" id="main">
    <?php
        if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
            yoast_breadcrumb( '<div class="breadcrumb-wrapper"><nav aria-label="Você está em:" class="container">', '</nav></div>' );
        } else {
            ps_breadcrumb();
        }
    ?>
