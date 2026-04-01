<?php
  /**
   * Title: Lista de Campi
   * Slug: ifrs-ps/campi
   * Description: Lista de todos os campi participantes do Processo Seletivo de Estudantes do IFRS, com suas respectivas descrições.
   * Categories: featured
   * Keywords: campi, unidades, campus
   * Viewport Width: 1296
   * Post Types: page
   * Inserter: true
   */

  $campi = get_terms(array(
    'taxonomy' => 'campus',
    'orderby' => 'name',
    'hide_empty' => false,
  ));
?>
<div class="campi-list">
<?php foreach ($campi as $campus) : ?>
  <dl class="campi-list__item">
    <dt class="campi-list__title"><em>Campus</em>&nbsp;<?php echo $campus->name; ?></dt>
    <?php if (!empty($campus->description)) : ?>
      <dd><?php echo nl2br($campus->description); ?></dd>
    <?php endif; ?>
  </dl>
<?php endforeach; ?>
</div>
