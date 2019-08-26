<?php

function campi_list_shortcode( $atts, $content = '' ) {
    $arr = shortcode_atts(
        array(),
        $atts
    );

    $campi = get_terms(array(
        'taxonomy' => 'campus',
        'orderby' => 'name',
        'hide_empty' => false,
    ));

    $string = '';

    $string .= $content;

    $string .= '<div class="campi-list">';
    foreach ($campi as $campus) {
        $string .= '<dl class="campi-list__item">';
        $string .= '<dt class="campi-list__title"><em>Campus</em> ' . $campus->name . '</dt>';
        $string .= !empty($campus->description) ? '<dd>' . nl2br($campus->description) . '</dd>' : '';
        $string .= '</dl>';
    }
    $string .= '</div>';

    return $string;
}

add_shortcode( 'campi-list', 'campi_list_shortcode' );
