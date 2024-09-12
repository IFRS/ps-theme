<?php
  $banner_enabled = cmb2_get_option( 'banner_especial_options', 'banner_especial_enable' );
  $banner_img = wp_get_attachment_image( cmb2_get_option( 'banner_especial_options', 'banner_especial_img_id' ), 'full', false, array( 'class' => 'img-fluid' ) );
  $banner_url = cmb2_get_option( 'banner_especial_options', 'banner_especial_url' );
?>
<?php if (!empty($banner_enabled) && !empty($banner_img)) : ?>
  <section class="banner-especial">
    <div class="container text-center">
      <?php if (!empty($banner_url)) : ?>
        <a href="<?php echo $banner_url ?>" class="d-inline-block">
      <?php endif; ?>
          <?php echo $banner_img; ?>
      <?php if (!empty($banner_url)) : ?>
        </a>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
