<?php
    if (!has_site_icon()) :
?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/safari-pinned-tab.svg" color="#195128">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#195128">
    <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="<?php echo get_stylesheet_directory_uri(); ?>/favicons/browserconfig.xml">
    <meta name="theme-color" content="#195128">
<?php
    endif;
