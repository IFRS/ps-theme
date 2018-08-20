<?php

function campi_shortcode( $atts, $content = '' ) {
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

    foreach ($campi as $campus) {
        $string .= '<h3>' . $campus->name . '</h3>';
        $string .= !empty($campus->description) ? '<p>' . nl2br($campus->description) . '</p>' : '';
    }

    return $string;
}

add_shortcode( 'campi', 'campi_shortcode' );
