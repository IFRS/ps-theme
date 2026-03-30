<?php
/**
 * Title: Avisos
 * Slug: ifrs-ps/avisos
 * Description: Avisos para os usuários ficarem por dentro das últimas notícias e atualizações
 * Categories: call-to-action, featured
 * Keywords: avisos, notícias, atualizações, comunicados
 * Viewport Width: 1296
 * Post Types: page
 * Inserter: true
 */

$link_todos_avisos = get_permalink( get_option( 'page_for_posts' ) );
?>

<!-- wp:group {"className":"avisos","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group avisos">
  <!-- wp:heading -->
  <h2 class="wp-block-heading">Se liga! Confira os últimos avisos</h2>
  <!-- /wp:heading -->

  <!-- wp:latest-posts {"displayPostContent":true,"excerptLength":50,"displayPostDate":true} /-->

  <!-- wp:buttons -->
  <div class="wp-block-buttons">
    <!-- wp:button -->
    <div class="wp-block-button">
      <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url($link_todos_avisos); ?>">Todos os Avisos</a>
    </div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
