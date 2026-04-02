<?php
class Site_Map_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        $output .= "{$n}{$indent}<ul class='sub-menu'>{$n}";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent  = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $output .= $indent . '<li>';

        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= $item_output;
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }
}
