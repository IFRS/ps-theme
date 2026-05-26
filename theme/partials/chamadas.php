<article id="chamadas" class="chamadas" aria-live="polite">
  <h2 class="chamadas__title"><?php echo esc_html(chamada_get_option('title', __('Chamadas', 'ifrs-ps-theme'))); ?></h2>
  <?php echo wpautop(wp_kses_post(chamada_get_option('desc', '')), true); ?>
  <p>
    <?php printf(__('Os resultados ser&atilde;o divulgados conforme <a href="%s">Cronograma</a>.', 'ifrs-ps-theme'), esc_url(get_post_type_archive_link('evento'))); ?>
  </p>

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
  <div v-if="chamadas && !loadingChamadas" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center mt-1">
    <h4 v-if="selectedCampus" class="visually-hidden">{{ selectedCampus.name }}</h4>
    <div v-for="(resultados, key) in chamadas" :key="key" class="col">
      <div class="card border-primary">
        <div class="card-header bg-primary text-white">
          <h5 class="m-0">{{ key }}</h5>
        </div>
        <div class="list-group list-group-flush">
          <a v-for="resultado in resultados" :key="resultado.id" :href="resultado.link" class="list-group-item list-group-item-action">
            {{ resultado.title.rendered }}
            <template v-if="resultado.modalidades">
              <br>
              <span class="text-muted">
                <template v-for="(modalidade, key) in resultado.modalidades">
                  {{ modalidade }}<template v-if="key !== resultado.modalidades.length - 1">,&nbsp;</template>
                </template>
              </span>
            </template>
          </a>
        </div>
      </div>
    </div>
    <div v-if="selectedCampus && Object.keys(chamadas).length === 0" class="alert alert-warning d-flex align-items-center text-start fw-medium" role="alert">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
      </svg>
      <div>Ainda n&atilde;o h&aacute; conte&uacute;do dispon&iacute;vel para este Campus.</div>
    </div>
  </div>
</article>
