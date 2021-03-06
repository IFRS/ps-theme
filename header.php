<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Departamento de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, processo, seletivo, vestibular, ingresso">
    <meta name="description" content="Site com informações do Processo Seletivo IFRS">
    <!-- Contexto Barra Brasil -->
    <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/100918">
    <!-- Facebook -->
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <meta property="og:url" content="<?php echo esc_attr( wp_get_canonical_url() ); ?>">
    <meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>">
    <meta property="og:type" content="<?php echo (!is_front_page() && !is_home()) ? 'article' : 'website' ?>">
    <meta property="og:title" content="<?php echo esc_attr( get_template_part('partials/title') ); ?>">
    <meta property="og:image" content="<?php has_post_thumbnail() ? esc_attr( the_post_thumbnail_url('full') ) : esc_attr( header_image() ); ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@IF_RS">
    <meta name="twitter:creator" content="@IF_RS">
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url( wp_get_canonical_url() ); ?>">
    <?php if (!has_site_icon()) echo get_template_part('partials/favicons'); ?>
    <!-- WP -->
    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <a href="#main" class="sr-only">Pular para o conte&uacute;do</a>

    <?php wp_body_open(); ?>

    <?php echo get_template_part('partials/barrabrasil'); ?>

    <!-- Cabeçalho -->
    <header class="lazyload">
        <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
        <section class="container header">
            <div class="header__foto">
                <img data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/header-foto.png" width="385" height="551" alt="" class="img-fluid" aria-hidden="true"/>
            </div>
            <div class="header__principal">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__link">
                    <img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?> - Ir para P&aacute;gina Inicial" class="img-fluid"/>
                </a>
                <div class="header__social">
                    <ul class="menu-social">
                        <li class="menu-social__item"><a href="https://www.facebook.com/IFRSOficial" class="menu-social__link menu-social__link--facebook"><span class="sr-only">Página do IFRS no Facebook</span></a></li>
                        <li class="menu-social__item"><a href="https://www.twitter.com/IFRSOficial" class="menu-social__link menu-social__link--twitter"><span class="sr-only">Perfil do IFRS no Twitter</span></a></li>
                        <li class="menu-social__item"><a href="https://www.instagram.com/IFRSOficial" class="menu-social__link menu-social__link--instagram"><span class="sr-only">Perfil do IFRS no Instagram</span></a></li>
                        <li class="menu-social__item"><a href="https://www.youtube.com/IFRSOficial" class="menu-social__link menu-social__link--youtube"><span class="sr-only">Canal do IFRS no Youtube</span></a></li>
                        <li class="menu-social__item"><a href="https://www.linkedin.com/school/ifrs" class="menu-social__link menu-social__link--linkedin"><span class="sr-only">Página do IFRS no Linkedin</span></a></li>
                    </ul>
                </div>
                <div class="header__search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </section>
    </header>

    <div class="menu">
        <div class="container">
            <div class="col-12">
                <?php echo get_template_part('partials/menu'); ?>
            </div>
        </div>
    </div>

    <!-- Corpo -->
    <a href="#inicio-conteudo" id="inicio-conteudo" class="sr-only">In&iacute;cio do conte&uacute;do</a>

    <main role="main" id="main">
    <?php ps_breadcrumb(); ?>
