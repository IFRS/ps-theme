<?php if (has_header_image()) : ?>
  <?php
  $header_image_data = get_theme_mod('header_image_data');
  $header_image_id = is_array($header_image_data)
    ? ($header_image_data['attachment_id'] ?? 0)
    : ($header_image_data->attachment_id ?? 0);
  $header_image_url = get_header_image();

  if (! $header_image_id || ! $header_image_url) return;

  $header_image = array();
  foreach (array('xs', 'sm', 'md', 'lg', 'full') as $size) {
    $image = wp_get_attachment_image_src($header_image_id, $size);
    $header_image[$size] = $image ? $image[0] : $header_image_url;
  }
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
