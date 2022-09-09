<article id="chamadas" class="chamadas" aria-live="polite">
    <h2 class="chamadas__title"><?php echo chamada_get_option('title', __('Chamadas', 'ifrs-ps-theme')); ?></h2>
    <?php echo wpautop(chamada_get_option('desc', ''), true); ?>
    <p>
        <small>
            <?php printf(__('Os resultados serão divulgados conforme <a href="%s">cronograma</a>.', 'ifrs-ps-theme'), get_post_type_archive_link( 'evento' )); ?>
        </small>
    </p>

    <section v-if="!isSearch">
        <h3 class="chamadas__title">Navegar pelos Resultados</h3>
        <div v-if="campi.length === 0" class="spinner-grow text-light" role="status">
            <span class="visually-hidden">Carregando Campi...</span>
        </div>
        <button v-else v-for="campus in campi" :key="campus.id" @click="getChamadas(campus)" :disabled="loadingChamadas" class="btn btn-campus" :class="{ 'active': campus === selectedCampus }">
            <span class="visually-hidden">Campus </span>
            {{ campus.name }}
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
    </section>

    <span v-if="!isSearch && !selectedCampus" class="chamadas__ou">ou</span>

    <section v-if="!selectedCampus">
        <h3 class="chamadas__title">Buscar nos Resultados</h3>
        <form class="input-group" @submit.prevent="buscar">
            <input ref="search" type="text" class="form-control" placeholder="Buscar em todos os resultados" minlength="3" aria-label="Buscar nos Resukltados">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
        <template v-if="isSearch">
            <h4 class="chamadas__title mt-3">Chamadas em que o termo "{{ search }}" aparece</h4>
            <div v-if="loadingSearch" class="spinner-grow text-light mt-5" role="status">
                <span class="visually-hidden">Carregando Chamadas...</span>
            </div>
            <div v-if="!loadingSearch && hasSearchResults" class="list-group">
                <a v-for="chamada in searchResults" :key="chamada.ID" :href="chamada.link" class="list-group-item list-group-item-action">
                    {{ chamada.post_title }}
                    |
                    <span v-for="campus in chamada.campi" :key="campus.term_id">
                        {{ campus.name }}
                    </span>
                    |
                    <span v-for="forma in chamada.formasingresso" :key="forma.term_id">
                        {{ forma.name }}
                    </span>
                </a>
            </div>
            <div v-else-if="!loadingSearch && !hasSearchResults" class="alert alert-info" role="alert">
                N&atilde;o foram encontradas Chamadas com esse termo. Tente outro termo ou navegue manualmente pelas Chamadas.
            </div>
        </template>
    </section>
</article>
