<?php
if (!WP_DEBUG) {
    add_action('wp_head', function() {
?>
    <link rel="preload" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/header-bg.png" as="image" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://vlibras.gov.br">
<?php
    }, 0);
}
