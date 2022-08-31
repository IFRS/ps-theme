<?php if (has_header_image()) : ?>
<?php
    $header_image_id = get_theme_mod( 'header_image_data' )->attachment_id;

    $header_image = array();
    $header_image['xs'] = wp_get_attachment_image_src($header_image_id, 'xs')[0];
    $header_image['sm'] = wp_get_attachment_image_src($header_image_id, 'sm')[0];
    $header_image['md'] = wp_get_attachment_image_src($header_image_id, 'md')[0];
    $header_image['lg'] = wp_get_attachment_image_src($header_image_id, 'lg')[0];
    $header_image['full'] = wp_get_attachment_image_src($header_image_id, 'full')[0];
?>
<style>
  header {
    --bg-xs: url("<?php echo $header_image['xs']; ?>");
    --bg-sm: url("<?php echo $header_image['sm']; ?>");
    --bg-md: url("<?php echo $header_image['md']; ?>");
    --bg-lg: url("<?php echo $header_image['lg']; ?>");
    --bg-full: url("<?php echo $header_image['full']; ?>");
  }
</style>

<?php endif; ?>
