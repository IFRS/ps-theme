<?php
function ifrs_ps_search_chamadas( $request ) {
  $config = new \Smalot\PdfParser\Config();
  $config->setRetainImageContent(false); // Reduz o uso de memória.
  $config->setHorizontalOffset(''); // Tenta não quebrar palavras em novas linhas.
  $config->setFontSpaceLimit(-136); // Tenta não adicionar espaços desnecessários.

  $parser = new \Smalot\PdfParser\Parser([], $config);

  $search = array();

  if ( isset( $request['s'] ) ) {
    $s = sanitize_text_field(urldecode($request['s']));

    $modalidades = get_terms(array('taxonomy' => 'modalidade', 'orderby' => 'term_order'));

    $chamadas = get_posts( array(
      'post_type'      => 'chamada',
      'post_status'    => 'publish',
      'nopaging'       => true,
      'posts_per_page' => -1,
    ) );

    if (!empty($chamadas)) {
      foreach ($chamadas as $chamada) {
        $achou = false;
        foreach ($modalidades as $modalidade) {
          $resultados = (array) get_post_meta($chamada->ID, '_chamada_modalidade_' . $modalidade->slug);

          if (!empty($resultados)) {
            foreach ($resultados[0] as $id => $url) {
              $path = get_attached_file($id);
              $pdf = $parser->parseFile($path);
              $text = $pdf->getText();
              $text = preg_replace('/\s/', ' ', $text);
              $text = preg_replace('!\s+!', ' ', $text);

              if (stripos($text, $s) !== false) {
                $achou = true;
              }
            }
          }
        }
        if ($achou) {
          $chamada->link = get_post_permalink($chamada);
          $chamada->campi = get_the_terms($chamada, 'campus');
          $chamada->formasingresso = get_the_terms($chamada, 'formaingresso');
          $search[] = $chamada;
        }
      }
    }
  }

  return rest_ensure_response( $search );
}

function ifrs_ps_search_chamadas_args() {
  $args = array();

  $args['s'] = array(
    'description' => esc_html__( 'Termo da busca nas Chamadas.', 'ifrs-ps-theme' ),
    'type'        => 'string',
  );

  return $args;
}

add_action( 'rest_api_init', function() {
  register_rest_route( 'ifrs-ps/v1', '/search-chamadas', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'ifrs_ps_search_chamadas',
    'args' => ifrs_ps_search_chamadas_args(),
  ) );
} );
