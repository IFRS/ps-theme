<?php
function ifrs_ps_get_modalidades()
{
  return array(
    'tecnico-integrado' => __('Técnico Integrado ao Ensino Médio', 'ifrs-ps-theme'),
    'tecnico-concomitante' => __('Técnico Concomitante ao Ensino Médio', 'ifrs-ps-theme'),
    'tecnico-concomitante-subsequente' => __('Técnico Concomitante/Subsequente ao Ensino Médio', 'ifrs-ps-theme'),
    'tecnico-subsequente' => __('Técnico Subsequente ao Ensino Médio', 'ifrs-ps-theme'),
    'eja' => __('Educação de Jovens e Adultos (EJA)', 'ifrs-ps-theme'),
    'graduacao' => __('Graduação', 'ifrs-ps-theme'),
  );
}

function ifrs_ps_get_turnos()
{
  return array(
    'manha' => __('Manhã', 'ifrs-ps-theme'),
    'tarde' => __('Tarde', 'ifrs-ps-theme'),
    'noite' => __('Noite', 'ifrs-ps-theme'),
  );
}

function ifrs_ps_get_modalidade_label($slug)
{
  $modalidades = ifrs_ps_get_modalidades();

  return isset($modalidades[$slug]) ? $modalidades[$slug] : '';
}

function ifrs_ps_get_turno_label($slug)
{
  $turnos = ifrs_ps_get_turnos();

  return isset($turnos[$slug]) ? $turnos[$slug] : '';
}

function ifrs_ps_get_curso_modalidade($post_id)
{
  return ifrs_ps_get_modalidade_label(get_post_meta($post_id, '_curso_modalidade', true));
}

function ifrs_ps_get_curso_turnos($post_id)
{
  $turnos = (array) get_post_meta($post_id, '_curso_turnos', true);

  return array_values(array_filter(array_map('ifrs_ps_get_turno_label', $turnos)));
}
