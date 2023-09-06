<article id="chamadas" class="chamadas" aria-live="polite">
    <h2 class="chamadas__title"><?php echo chamada_get_option('title', __('Chamadas', 'ifrs-ps-theme')); ?></h2>
    <?php echo wpautop(chamada_get_option('desc', ''), true); ?>
    <p>
        <small>
            <?php printf(__('Os resultados ser&atilde;o divulgados conforme <a href="%s">Cronograma</a>.', 'ifrs-ps-theme'), get_post_type_archive_link( 'evento' )); ?>
        </small>
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
    </div>
</article>
