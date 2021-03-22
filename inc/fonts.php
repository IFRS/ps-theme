<?php
add_action('wp_head', function() {
    $fonts_file = esc_url(get_template_directory_uri()). '/css/fonts.css';
?>
    <link rel="preload" href="<?php echo esc_url(get_template_directory_uri()); ?>/fonts/Regular/OpenSans-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="<?php echo esc_url(get_template_directory_uri()); ?>/fonts/Bold/OpenSans-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="<?php echo $fonts_file; ?>" as="style"/>
    <link rel="stylesheet" href="<?php echo $fonts_file; ?>" media="print" onload="this.media='all'"/>
    <noscript>
        <link rel="stylesheet" href="<?php echo $fonts_file; ?>"/>
    </noscript>

    <?php $google_fonts = 'https://fonts.googleapis.com/css2?family=Rubik:wght@800&display=swap'; ?>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="preload" as="style" href="<?php echo $google_fonts; ?>" />

    <link rel="stylesheet" href="<?php echo $google_fonts; ?>" media="print" onload="this.media='all'" />

    <noscript>
        <link rel="stylesheet" href="<?php echo $google_fonts; ?>" />
    </noscript>
<?php
}, 1);
