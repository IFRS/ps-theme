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

    foreach ($campi as $campus) {
        $string .= '<h4>' . $campus->name . '</h4>';
        $string .= !empty($campus->description) ? '<p>' . nl2br($campus->description) . '</p>' : '';
        $string .= $content;
    }

    return $string;
}

add_shortcode( 'campi-list', 'campi_list_shortcode' );
