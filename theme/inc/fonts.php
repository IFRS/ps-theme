<?php
add_action('wp_head', function() {
    $fonts_file = esc_url(get_template_directory_uri()). '/css/fonts.css';
?>
    <!-- <link rel="preload" href="<?php echo esc_url(get_template_directory_uri()); ?>/fonts/kumbh-sans-v22-latin-regular.woff2" as="font" type="font/woff2"> -->
    <!-- <link rel="preload" href="<?php echo $fonts_file; ?>" as="style"> -->
    <!-- <link rel="stylesheet" href="<?php echo $fonts_file; ?>" media="print" onload="this.media='all'"> -->
    <!-- <noscript>
        <link rel="stylesheet" href="<?php echo $fonts_file; ?>">
    </noscript> -->
    <link rel="stylesheet" href="https://use.typekit.net/gug5jns.css">
<?php
}, 1);
