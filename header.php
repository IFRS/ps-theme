<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Meta Init -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Diretoria de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, processo, seletivo, 2016/2, vestibular, ingresso">
    <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/100918">
    <?php echo get_template_part('partials/title'); ?>
    <link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr( get_bloginfo('name') ); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
    <!-- Favicon -->
    <?php echo get_template_part('partials/favicons'); ?>
    <!-- CSS, JS & etc. -->
    <?php wp_head(); ?>
</head>

<body>
    <?php echo get_template_part('partials/barrabrasil'); ?>

    <!-- Cabeçalho -->
    <header>
        <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
        <div class="container">
            <div class="row">
                <?php if (get_header_image() != '') : ?>
                <div class="col-xs-12">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="header-link"><img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="center-block img-responsive" id="header-image"/></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Menu -->
    <div id="menu">
        <div class="container">
            <div class="row">
                <?php echo get_template_part('partials/menu'); ?>
            </div>
        </div>
    </div>

    <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>

    <?php ps_breadcrumb(); ?>
