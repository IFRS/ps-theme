<?php
if (!is_admin()) {
  return;
}

define('IFRS_PS_CURSO_IMPORT_CAP', 'manage_options');
define('IFRS_PS_CURSO_IMPORT_TRANSIENT_PREFIX', 'ifrs_ps_curso_import_');

add_action('admin_menu', function () {
  add_submenu_page(
    'edit.php?post_type=curso',
    __('Importar Cursos (CSV)', 'ifrs-ps-theme'),
    __('Importar CSV', 'ifrs-ps-theme'),
    IFRS_PS_CURSO_IMPORT_CAP,
    'ifrs-ps-curso-import',
    'ifrs_ps_render_curso_import_page'
  );
});

function ifrs_ps_render_curso_import_page()
{
  if (!current_user_can(IFRS_PS_CURSO_IMPORT_CAP)) {
    wp_die(__('Você não tem permissão para acessar esta página.', 'ifrs-ps-theme'));
  }

  echo '<div class="wrap">';
  echo '<h1>' . esc_html__('Importar Cursos (CSV)', 'ifrs-ps-theme') . '</h1>';

  $action = isset($_POST['ifrs_ps_curso_import_action']) ? sanitize_key(wp_unslash($_POST['ifrs_ps_curso_import_action'])) : '';

  if ('confirm' === $action && check_admin_referer('ifrs_ps_curso_import_confirm')) {
    ifrs_ps_curso_import_handle_confirm();
  } elseif ('preview' === $action && check_admin_referer('ifrs_ps_curso_import_preview')) {
    ifrs_ps_curso_import_handle_preview();
  } else {
    ifrs_ps_curso_import_render_upload_form();
  }

  echo '</div>';
}

function ifrs_ps_curso_import_render_upload_form($notice = '')
{
  if ($notice !== '') {
    echo '<div class="notice notice-error"><p>' . esc_html($notice) . '</p></div>';
  }

  $trilhas = get_terms(array('taxonomy' => 'trilha_selecao', 'hide_empty' => false, 'orderby' => 'name'));
  ?>
  <p><?php esc_html_e('Envie um CSV com as colunas: Campus, Modalidade, Descrição da Vaga, Turno, Duração, Carga EAD?, Estágio, Modo de Ingresso, Total de Vagas.', 'ifrs-ps-theme'); ?></p>
  <p><?php esc_html_e('Cada combinação de Campus + Descrição da Vaga + Modalidade + Turno é uma oferta separada. Só é atualizado um curso já existente se todos esses quatro dados coincidirem.', 'ifrs-ps-theme'); ?></p>

  <form method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('ifrs_ps_curso_import_preview'); ?>
    <input type="hidden" name="ifrs_ps_curso_import_action" value="preview">

    <table class="form-table">
      <tr>
        <th><label for="ifrs_ps_csv_file"><?php esc_html_e('Arquivo CSV', 'ifrs-ps-theme'); ?></label></th>
        <td><input type="file" name="ifrs_ps_csv_file" id="ifrs_ps_csv_file" accept=".csv,text/csv" required></td>
      </tr>
      <tr>
        <th><label for="ifrs_ps_trilha_select"><?php esc_html_e('Trilha de Seleção', 'ifrs-ps-theme'); ?></label></th>
        <td>
          <select name="ifrs_ps_trilha_select" id="ifrs_ps_trilha_select">
            <option value=""><?php esc_html_e('— Selecione —', 'ifrs-ps-theme'); ?></option>
            <?php foreach ((!is_wp_error($trilhas) ? $trilhas : array()) as $trilha) : ?>
              <option value="<?php echo esc_attr($trilha->name); ?>"><?php echo esc_html($trilha->name); ?></option>
            <?php endforeach; ?>
            <option value="__new__"><?php esc_html_e('+ Nova trilha…', 'ifrs-ps-theme'); ?></option>
          </select>
          <input type="text" name="ifrs_ps_trilha_new" id="ifrs_ps_trilha_new" class="regular-text" style="display:none" placeholder="<?php esc_attr_e('Nome da nova trilha', 'ifrs-ps-theme'); ?>">
          <p class="description"><?php esc_html_e('Trilha à qual pertence o "Total de Vagas" do CSV.', 'ifrs-ps-theme'); ?></p>
        </td>
      </tr>
    </table>

    <?php submit_button(__('Analisar CSV', 'ifrs-ps-theme')); ?>
  </form>
  <script>
    (function () {
      var select = document.getElementById('ifrs_ps_trilha_select');
      var input = document.getElementById('ifrs_ps_trilha_new');
      if (!select || !input) { return; }
      select.addEventListener('change', function () {
        var isNew = select.value === '__new__';
        input.style.display = isNew ? '' : 'none';
        input.required = isNew;
      });
    })();
  </script>
  <?php
}

function ifrs_ps_curso_import_handle_preview()
{
  if (empty($_FILES['ifrs_ps_csv_file']['tmp_name']) || !empty($_FILES['ifrs_ps_csv_file']['error'])) {
    ifrs_ps_curso_import_render_upload_form(__('Selecione um arquivo CSV válido.', 'ifrs-ps-theme'));
    return;
  }

  $trilha_select = isset($_POST['ifrs_ps_trilha_select']) ? sanitize_text_field(wp_unslash($_POST['ifrs_ps_trilha_select'])) : '';
  $trilha_nome = '__new__' === $trilha_select
    ? (isset($_POST['ifrs_ps_trilha_new']) ? sanitize_text_field(wp_unslash($_POST['ifrs_ps_trilha_new'])) : '')
    : $trilha_select;

  if ($trilha_nome === '') {
    ifrs_ps_curso_import_render_upload_form(__('Informe a Trilha de Seleção de destino.', 'ifrs-ps-theme'));
    return;
  }

  $tmp_name = $_FILES['ifrs_ps_csv_file']['tmp_name'];
  $original_name = isset($_FILES['ifrs_ps_csv_file']['name']) ? sanitize_file_name(wp_unslash($_FILES['ifrs_ps_csv_file']['name'])) : '';

  if (!is_uploaded_file($tmp_name) || strtolower(pathinfo($original_name, PATHINFO_EXTENSION)) !== 'csv') {
    ifrs_ps_curso_import_render_upload_form(__('O arquivo enviado precisa ser um CSV (.csv).', 'ifrs-ps-theme'));
    return;
  }

  $rows = ifrs_ps_curso_import_parse_csv($tmp_name);
  if (is_wp_error($rows)) {
    ifrs_ps_curso_import_render_upload_form($rows->get_error_message());
    return;
  }

  if (empty($rows)) {
    ifrs_ps_curso_import_render_upload_form(__('Nenhuma linha válida encontrada no CSV.', 'ifrs-ps-theme'));
    return;
  }

  $groups = ifrs_ps_curso_import_group_rows($rows);

  $transient_key = IFRS_PS_CURSO_IMPORT_TRANSIENT_PREFIX . get_current_user_id();
  set_transient($transient_key, array('groups' => $groups, 'trilha' => $trilha_nome), HOUR_IN_SECONDS);

  echo '<h2>' . esc_html__('Pré-visualização', 'ifrs-ps-theme') . '</h2>';
  echo '<p>' . sprintf(
    /* translators: %s: nome da trilha */
    esc_html__('Trilha de destino: %s', 'ifrs-ps-theme'),
    '<strong>' . esc_html($trilha_nome) . '</strong>'
  ) . '</p>';

  $validos = 0;
  $invalidos = 0;

  echo '<table class="widefat striped"><thead><tr>';
  foreach (array('Ação', 'Campus', 'Curso', 'Modalidade', 'Turnos', 'Modo de Ingresso', 'Duração', 'EAD', 'Estágio', 'Vagas') as $col) {
    echo '<th>' . esc_html($col) . '</th>';
  }
  echo '</tr></thead><tbody>';

  foreach ($groups as $group) {
    $ok = !empty($group['modalidade']);
    $ok ? $validos++ : $invalidos++;

    $acao = esc_html__('Ignorado', 'ifrs-ps-theme');
    if ($ok) {
      $campus_term_id = ifrs_ps_curso_import_find_term_id($group['campus'], 'campus');
      $existing_id = $campus_term_id ? ifrs_ps_curso_import_find_existing($group['titulo'], $campus_term_id, $group['modalidade'], $group['turnos']) : 0;
      $acao = $existing_id
        ? sprintf('<a href="%s" target="_blank">%s</a>', esc_url(get_edit_post_link($existing_id)), esc_html(sprintf(__('Atualizar #%d', 'ifrs-ps-theme'), $existing_id)))
        : esc_html__('Criar novo', 'ifrs-ps-theme');
    }

    echo '<tr' . ($ok ? '' : ' style="background:#fbeaea"') . '>';
    echo '<td>' . $acao . '</td>';
    echo '<td>' . esc_html($group['campus']) . '</td>';
    echo '<td>' . esc_html($group['titulo']) . '</td>';
    echo '<td>' . ($ok ? esc_html($group['modalidade']) : esc_html__('não reconhecida: ', 'ifrs-ps-theme') . esc_html($group['modalidade_raw'])) . '</td>';
    echo '<td>' . esc_html(implode(', ', $group['turnos'])) . '</td>';
    echo '<td>' . esc_html(implode(', ', $group['ingresso'])) . '</td>';
    echo '<td>' . esc_html($group['duracao']) . '</td>';
    echo '<td>' . ($group['ead'] ? esc_html__('Sim', 'ifrs-ps-theme') : '-') . '</td>';
    echo '<td>' . ($group['estagio'] ? esc_html__('Sim', 'ifrs-ps-theme') : '-') . '</td>';
    echo '<td>' . esc_html($group['vagas']) . '</td>';
    echo '</tr>';
  }

  echo '</tbody></table>';

  echo '<p>' . sprintf(
    /* translators: 1: quantidade de cursos válidos, 2: quantidade de linhas ignoradas */
    esc_html__('%1$d curso(s) prontos para importar. %2$d linha(s) serão ignoradas por modalidade não reconhecida.', 'ifrs-ps-theme'),
    $validos,
    $invalidos
  ) . '</p>';

  if ($validos > 0) {
    echo '<form method="post">';
    wp_nonce_field('ifrs_ps_curso_import_confirm');
    echo '<input type="hidden" name="ifrs_ps_curso_import_action" value="confirm">';
    submit_button(__('Confirmar Importação', 'ifrs-ps-theme'), 'primary');
    echo '</form>';
  }

  echo '<p><a href="' . esc_url(admin_url('edit.php?post_type=curso&page=ifrs-ps-curso-import')) . '">' . esc_html__('&larr; Enviar outro arquivo', 'ifrs-ps-theme') . '</a></p>';
}

function ifrs_ps_curso_import_handle_confirm()
{
  $transient_key = IFRS_PS_CURSO_IMPORT_TRANSIENT_PREFIX . get_current_user_id();
  $data = get_transient($transient_key);

  if (empty($data) || empty($data['groups'])) {
    ifrs_ps_curso_import_render_upload_form(__('A pré-visualização expirou. Envie o arquivo novamente.', 'ifrs-ps-theme'));
    return;
  }

  delete_transient($transient_key);

  $trilha_term_id = ifrs_ps_curso_import_get_or_create_term($data['trilha'], 'trilha_selecao');
  if (!$trilha_term_id) {
    ifrs_ps_curso_import_render_upload_form(__('Não foi possível criar/localizar a Trilha de Seleção informada.', 'ifrs-ps-theme'));
    return;
  }

  $created = 0;
  $updated = 0;
  $skipped = 0;

  foreach ($data['groups'] as $group) {
    if (empty($group['modalidade'])) {
      $skipped++;
      continue;
    }

    $campus_term_id = ifrs_ps_curso_import_get_or_create_term($group['campus'], 'campus');
    $existing_id = ifrs_ps_curso_import_find_existing($group['titulo'], $campus_term_id, $group['modalidade'], $group['turnos']);

    $postarr = array(
      'post_title'  => $group['titulo'],
      'post_type'   => 'curso',
      'post_status' => 'draft',
    );

    if ($existing_id) {
      $postarr['ID'] = $existing_id;
      $post_id = wp_update_post($postarr, true);
    } else {
      $post_id = wp_insert_post($postarr, true);
    }

    if (is_wp_error($post_id)) {
      $skipped++;
      continue;
    }

    wp_set_object_terms($post_id, array($campus_term_id), 'campus');

    $ingresso_ids = array();
    foreach ($group['ingresso'] as $nome) {
      $term_id = ifrs_ps_curso_import_get_or_create_term($nome, 'formaingresso');
      if ($term_id) {
        $ingresso_ids[] = $term_id;
      }
    }
    if (!empty($ingresso_ids)) {
      wp_set_object_terms($post_id, $ingresso_ids, 'formaingresso');
    }

    wp_set_object_terms($post_id, array($trilha_term_id), 'trilha_selecao');

    update_post_meta($post_id, '_curso_modalidade', $group['modalidade']);
    update_post_meta($post_id, '_curso_turnos', $group['turnos']);
    update_post_meta($post_id, '_curso_duracao', $group['duracao']);

    if ($group['ead']) {
      update_post_meta($post_id, '_curso_ead', 'on');
    } else {
      delete_post_meta($post_id, '_curso_ead');
    }

    if ($group['estagio']) {
      update_post_meta($post_id, '_curso_estagio', 'on');
    } else {
      delete_post_meta($post_id, '_curso_estagio');
    }

    update_post_meta($post_id, '_curso_vagas_trilha_' . $trilha_term_id, absint($group['vagas']));

    // Publica só depois de garantir a trilha, para não cair em rascunho pela checagem obrigatória.
    wp_update_post(array('ID' => $post_id, 'post_status' => 'publish'));

    $existing_id ? $updated++ : $created++;
  }

  echo '<div class="notice notice-success"><p>' . sprintf(
    /* translators: 1: criados, 2: atualizados, 3: ignorados */
    esc_html__('Importação concluída. Criados: %1$d | Atualizados: %2$d | Ignorados: %3$d.', 'ifrs-ps-theme'),
    $created,
    $updated,
    $skipped
  ) . '</p></div>';

  echo '<p><a href="' . esc_url(admin_url('edit.php?post_type=curso')) . '">' . esc_html__('Ver Cursos', 'ifrs-ps-theme') . '</a> | ';
  echo '<a href="' . esc_url(admin_url('edit.php?post_type=curso&page=ifrs-ps-curso-import')) . '">' . esc_html__('Importar outro arquivo', 'ifrs-ps-theme') . '</a></p>';
}

function ifrs_ps_curso_import_parse_csv($file)
{
  $handle = fopen($file, 'r');
  if (!$handle) {
    return new WP_Error('csv_unreadable', __('Não foi possível abrir o arquivo enviado.', 'ifrs-ps-theme'));
  }

  $header = fgetcsv($handle);
  if (!$header) {
    fclose($handle);
    return new WP_Error('csv_empty', __('O arquivo CSV está vazio.', 'ifrs-ps-theme'));
  }

  // Remove BOM eventual do primeiro cabeçalho.
  $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
  $header = array_map('trim', $header);

  $required = array('Campus', 'Modalidade', 'Descrição da Vaga');
  foreach ($required as $col) {
    if (!in_array($col, $header, true)) {
      fclose($handle);
      /* translators: %s: nome da coluna */
      return new WP_Error('csv_missing_column', sprintf(__('Coluna obrigatória ausente no CSV: %s', 'ifrs-ps-theme'), $col));
    }
  }

  $rows = array();
  while (($row = fgetcsv($handle)) !== false) {
    if (count($row) === 1 && trim((string) $row[0]) === '') {
      continue;
    }

    $assoc = array();
    foreach ($header as $index => $key) {
      $assoc[$key] = isset($row[$index]) ? trim((string) $row[$index]) : '';
    }

    if (empty($assoc['Campus']) || empty($assoc['Descrição da Vaga'])) {
      continue;
    }

    $rows[] = $assoc;
  }

  fclose($handle);

  return $rows;
}

function ifrs_ps_curso_import_group_rows($rows)
{
  $groups = array();

  foreach ($rows as $row) {
    $campus = $row['Campus'];
    $titulo = $row['Descrição da Vaga'];
    $modalidade_raw = isset($row['Modalidade']) ? $row['Modalidade'] : '';
    $modalidade = ifrs_ps_curso_import_map_modalidade($modalidade_raw);
    $turnos = ifrs_ps_curso_import_parse_turnos(isset($row['Turno']) ? $row['Turno'] : '');
    $turnos_chave = $turnos;
    sort($turnos_chave);

    // Turno faz parte da chave: mesma oferta em turnos diferentes é um curso separado.
    $key = mb_strtolower($campus) . '|' . mb_strtolower($titulo) . '|' . $modalidade . '|' . implode(',', $turnos_chave);

    if (!isset($groups[$key])) {
      $groups[$key] = array(
        'campus'         => $campus,
        'titulo'         => $titulo,
        'modalidade'     => $modalidade,
        'modalidade_raw' => $modalidade_raw,
        'turnos'         => array(),
        'ingresso'       => array(),
        'duracao'        => isset($row['Duração']) ? $row['Duração'] : '',
        'ead'            => false,
        'estagio'        => false,
        'vagas'          => 0,
      );
    }

    $groups[$key]['turnos'] = array_values(array_unique(array_merge(
      $groups[$key]['turnos'],
      $turnos
    )));

    $groups[$key]['ingresso'] = array_values(array_unique(array_merge(
      $groups[$key]['ingresso'],
      ifrs_ps_curso_import_parse_ingresso(isset($row['Modo de Ingresso']) ? $row['Modo de Ingresso'] : '')
    )));

    if (mb_strtolower(trim(isset($row['Carga EAD?']) ? $row['Carga EAD?'] : '')) === 'sim') {
      $groups[$key]['ead'] = true;
    }

    if (mb_strtolower(trim(isset($row['Estágio']) ? $row['Estágio'] : '')) === 'sim') {
      $groups[$key]['estagio'] = true;
    }

    $vagas = isset($row['Total de Vagas']) ? (int) preg_replace('/\D/', '', $row['Total de Vagas']) : 0;
    $groups[$key]['vagas'] += $vagas;
  }

  return $groups;
}

function ifrs_ps_curso_import_map_modalidade($value)
{
  $normalized = mb_strtolower(remove_accents(trim($value)));

  $map = array(
    'integrado'                    => 'tecnico-integrado',
    'concomitante'                 => 'tecnico-concomitante',
    'concomitante/subsequente'     => 'tecnico-concomitante-subsequente',
    'subsequente'                  => 'tecnico-subsequente',
    'educacao de jovens e adultos' => 'eja',
    'superior'                     => 'graduacao',
  );

  return isset($map[$normalized]) ? $map[$normalized] : '';
}

function ifrs_ps_curso_import_parse_turnos($value)
{
  $value = remove_accents($value);
  $parts = preg_split('/,| e /i', $value);

  $map = array(
    'manha' => 'manha',
    'tarde' => 'tarde',
    'noite' => 'noite',
  );

  $slugs = array();
  foreach ((array) $parts as $part) {
    $key = mb_strtolower(trim($part));
    if (isset($map[$key])) {
      $slugs[] = $map[$key];
    }
  }

  return $slugs;
}

function ifrs_ps_curso_import_parse_ingresso($value)
{
  $parts = array_map('trim', explode('/', $value));
  return array_values(array_filter($parts, function ($part) {
    return $part !== '';
  }));
}

function ifrs_ps_curso_import_find_term_id($name, $taxonomy)
{
  $name = trim($name);
  if ($name === '') {
    return 0;
  }

  $existing = term_exists($name, $taxonomy);
  return $existing ? (int) $existing['term_id'] : 0;
}

function ifrs_ps_curso_import_get_or_create_term($name, $taxonomy)
{
  $name = trim($name);
  if ($name === '') {
    return 0;
  }

  $existing = term_exists($name, $taxonomy);
  if ($existing) {
    return (int) $existing['term_id'];
  }

  $created = wp_insert_term($name, $taxonomy);
  if (is_wp_error($created)) {
    return 0;
  }

  return (int) $created['term_id'];
}

function ifrs_ps_curso_import_find_existing($title, $campus_term_id, $modalidade, $turnos = array())
{
  if (!$campus_term_id) {
    return 0;
  }

  $turnos_ordenados = $turnos;
  sort($turnos_ordenados);

  $query = new WP_Query(array(
    'post_type'      => 'curso',
    'title'          => $title,
    'post_status'    => 'any',
    'posts_per_page' => -1,
    'no_found_rows'  => true,
    'fields'         => 'ids',
    'tax_query'      => array(
      array(
        'taxonomy' => 'campus',
        'field'    => 'term_id',
        'terms'    => $campus_term_id,
      ),
    ),
  ));

  foreach ($query->posts as $post_id) {
    if (get_post_meta($post_id, '_curso_modalidade', true) !== $modalidade) {
      continue;
    }

    $post_turnos = (array) get_post_meta($post_id, '_curso_turnos', true);
    sort($post_turnos);

    if ($post_turnos === $turnos_ordenados) {
      return (int) $post_id;
    }
  }

  return 0;
}
