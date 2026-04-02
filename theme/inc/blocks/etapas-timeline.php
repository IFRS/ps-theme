<?php
add_action("init", function () {
  register_block_type("ifrs-ps/etapas-timeline", [
    "api_version" => 2,
    "editor_script" => "ps-etapas-timeline-block",
    "render_callback" => "ifrs_ps_render_etapas_timeline_block",
    "attributes" => [
      "title" => [
        "type" => "string",
        "default" => __("Próximas etapas importantes", "ifrs-ps-theme"),
      ],
      "hidePast" => [
        "type" => "boolean",
        "default" => true,
      ],
      "postsPerPage" => [
        "type" => "number",
        "default" => 10,
      ],
    ],
  ]);
});

if (!function_exists("ifrs_ps_render_etapas_timeline_block")) {
  function ifrs_ps_render_etapas_timeline_block($attributes) {
    $title = !empty($attributes["title"])
      ? wp_kses_post($attributes["title"])
      : esc_html__("Próximas datas importantes", "ifrs-ps-theme");
    $hide_past = !empty($attributes["hidePast"]);
    $agora = current_time("timestamp");

    $icon_paths = [
      '' => '<path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" />',
      'inscricao' => '<path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M16 19h6" /><path d="M19 16v6" />',
      'selecao' => '<path d="M12 21h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" />',
      'resultado' => '<path d="M4 4m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z" /><path d="M4 8h16" /><path d="M8 4v4" /><path d="M9.5 14.5l1.5 1.5l3 -3" />',
      'matricula' => '<path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M19 22v-6" /><path d="M22 19l-3 -3l-3 3" />',
    ];

    $meta_query = [];

    if ($hide_past) {
      $meta_query[] = [
        "key" => "_evento_data-fim",
        "compare" => ">=",
        "value" => $agora,
        "type" => "NUMERIC",
      ];
    }

    $posts_per_page = !empty($attributes["postsPerPage"])
      ? (int) $attributes["postsPerPage"]
      : 10;

    $eventos = new WP_Query([
      "post_type" => "evento",
      "post_status" => "publish",
      "posts_per_page" => $posts_per_page,
      "orderby" => "meta_value_num",
      "order" => "ASC",
      "meta_key" => "_evento_data-inicio",
      "meta_query" => $meta_query,
      "no_found_rows" => true,
      "ignore_sticky_posts" => true,
    ]);

    if (!$eventos->have_posts()) {
      return "<p>" .
        esc_html__(
          "Nenhuma data importante cadastrada no momento.",
          "ifrs-ps-theme",
        ) .
        "</p>";
    }

    ob_start();
    ?>
    <section class="etapas-timeline">
      <?php
      echo do_blocks(
        sprintf(
          '<!-- wp:heading {"level":2,"className":"etapas-timeline__titulo"} --><h2 class="wp-block-heading etapas-timeline__titulo">%s</h2><!-- /wp:heading -->',
          $title,
        ),
      );
      ?>
      <ol class="etapas-timeline__list">
        <?php while ($eventos->have_posts()):
          $eventos->the_post();
          $data_inicio = (int) get_post_meta(
            get_the_ID(),
            "_evento_data-inicio",
            true,
          );
          $data_fim = (int) get_post_meta(
            get_the_ID(),
            "_evento_data-fim",
            true,
          );

          $evento_passou = $data_fim > 0 ? $data_fim < $agora : false;
          $evento_atual =
            $data_inicio > 0 && $data_fim > 0
              ? $data_inicio <= $agora && $data_fim >= $agora
              : false;
          $evento_mesmo_dia =
            $data_inicio > 0 && $data_fim > 0
              ? date_i18n("Ymd", $data_inicio) === date_i18n("Ymd", $data_fim)
              : false;

          if ($data_inicio > 0 && $data_fim > 0) {
            $periodo = $evento_mesmo_dia
              ? date_i18n("d/m/Y", $data_fim)
              : date_i18n("d/m/Y", $data_inicio) .
                " a " .
                date_i18n("d/m/Y", $data_fim);
          } elseif ($data_inicio > 0) {
            $periodo = date_i18n("d/m/Y", $data_inicio);
          } else {
            $periodo = esc_html__("Sem data", "ifrs-ps-theme");
          }

          $item_class = "etapa";
          if ($evento_atual) {
            $item_class .= " etapa--atual";
          } elseif ($evento_passou) {
            $item_class .= " etapa--passado";
          }

          $evento_tipo = get_post_meta(get_the_ID(), "_evento_tipo", true);
        ?>
          <li class="<?php echo esc_attr($item_class); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="etapa__icone">
              <?php echo $icon_paths[$evento_tipo] ?? $icon_paths[""]; ?>
            </svg>

            <div class="etapa__conteudo">
              <h3 class="etapa__titulo">
                <?php the_title(); ?>
              </h3>
              <p class="etapa__periodo">
                <?php echo esc_html($periodo); ?>
              </p>
            </div>
          </li>
          <?php
        endwhile; ?>
        </ol>
        <?php
        $eventos_archive_link = get_post_type_archive_link("evento");

        if (!empty($eventos_archive_link)) {
          echo do_blocks(
            sprintf(
              '<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="%1$s">%2$s</a></div><!-- /wp:button --></div><!-- /wp:buttons -->',
              esc_url($eventos_archive_link),
              esc_html__("Confira todas as Datas Importantes", "ifrs-ps-theme"),
            ),
          );
        }
        ?>
    </section>
    <?php
    wp_reset_postdata();

    return ob_get_clean();
  }
}
