<article id="chamadas" class="chamadas" aria-live="polite">
  <h2 class="chamadas__title"><?php echo esc_html(chamada_get_option('title', __('Chamadas', 'ifrs-ps-theme'))); ?></h2>
  <?php echo wpautop(wp_kses_post(chamada_get_option('desc', '')), true); ?>
  <!-- <p>
    <?php printf(__('Os resultados ser&atilde;o divulgados conforme <a href="%s">Cronograma</a>.', 'ifrs-ps-theme'), esc_url(get_post_type_archive_link('evento'))); ?>
  </p> -->

  <p v-if="!selectedCampus">Selecione seu Campus abaixo.</p>
  <div v-if="campi.length === 0" class="spinner-grow text-light" role="status">
    <span class="visually-hidden">Carregando Campi...</span>
  </div>
  <button v-else v-for="campus in campi" :key="campus.id" @click="getChamadas(campus)" :disabled="loadingChamadas" class="btn btn-campus" :class="{ 'active': campus === selectedCampus }">
    <span class="visually-hidden">Campus&nbsp;</span>{{ campus.name }}
  </button>
  <br>
  <div v-if="loadingChamadas" class="spinner-grow text-light mt-5" role="status">
    <span class="visually-hidden">Carregando Chamadas...</span>
  </div>
  <div v-if="chamadas && !loadingChamadas" class="mt-3 text-start">
    <div v-if="selectedCampus && Object.keys(chamadas).length > 0" class="card border-primary">
      <div class="card-header text-bg-primary">
        <h3 class="fs-5">Campus {{ selectedCampus.name }}</h3>
      </div>
      <div class="list-group list-group-flush">
        <a v-for="(chamada, key) in chamadas" :key="key" :href="chamada.link" class="list-group-item list-group-item-action d-flex gap-3 justify-content-between align-items-center">
          <div class="me-auto">
            <span class="d-block fw-bold fs-6 mb-1" v-html="chamada.title.rendered"></span>

            <template v-if="chamada.formaingresso_nomes.length">
              <span class="mt-1 fw-medium">
                <template v-for="(formaingresso, key) in chamada.formaingresso_nomes">
                  {{ formaingresso }}<template v-if="key !== chamada.formaingresso_nomes.length - 1">,&nbsp;</template>
                </template>
              </span>
            </template>

            <span v-if="chamada.modalidades_nomes.length && chamada.formaingresso_nomes.length"> | </span>

            <template v-if="chamada.modalidades_nomes.length">
              <span class="mt-1">
                <template v-for="(modalidade, key) in chamada.modalidades_nomes">
                  {{ modalidade }}<template v-if="key !== chamada.modalidades_nomes.length - 1">,&nbsp;</template>
                </template>
              </span>
            </template>
          </div>

          <div class="text-end">
            <div class="mb-1">
              <span v-for="(trilha, key) in chamada.trilha_selecao_nomes" :key="key" class="badge text-bg-accent">{{ trilha }}</span>
            </div>
            <time :datetime="chamada.modified" class="text-muted small mb-1" :title="dayjs(chamada.modified).format('DD/MM/YYYY HH:mm')">{{ dayjs(chamada.modified).fromNow() }}</time>
          </div>
        </a>
      </div>
    </div>
    <div v-if="selectedCampus && Object.keys(chamadas).length === 0" class="alert alert-warning d-flex align-items-center text-start fw-medium" role="alert">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
      </svg>
      <div>Ainda n&atilde;o h&aacute; conte&uacute;do dispon&iacute;vel para este Campus. Verifique novamente mais tarde.</div>
    </div>
  </div>
</article>
