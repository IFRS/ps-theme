<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Diretoria de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, processo, seletivo, vestibular, ingresso">
    <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/100918">
    <link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr( get_bloginfo('name') ); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
    <?php echo get_template_part('partials/title'); ?>
    <?php echo get_template_part('partials/favicons'); ?>
    <?php wp_head(); ?>
</head>

<body>
    <a href="#main" class="sr-only">Pular para o conte&uacute;do</a>

    <?php echo get_template_part('partials/barrabrasil'); ?>

    <!-- Cabeçalho -->
    <header>
        <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
        <section class="menu-main">
            <div class="container">
                <?php echo get_template_part('partials/menu'); ?>
            </div>
        </section>
        <section class="header-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-banner__link">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/header-foto<?php echo mt_rand(1, 2); ?>.png" alt="" class="img-fluid header-banner__foto" aria-hidden="true"/>
                            <img src="<?php header_image(); ?>" alt="" class="img-fluid header-banner__ps" aria-hidden="true"/>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/header-selo.png" alt="" class="img-fluid header-banner__selo"/>
                            <span class="sr-only">Ir para P&aacute;gina Inicial</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </header>

    <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>

    <main role="main" id="main">
    <?php ps_breadcrumb(); ?>
