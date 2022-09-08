import axios from 'axios';
import { createApp } from 'vue/dist/vue.esm-browser.js';

const app = createApp({
  props: {
    WP_API: {
      type: String,
      default: document.querySelector('link[rel="https://api.w.org/"]').getAttribute('href') + 'wp/v2/',
    },
  },
  data() {
    return {
      campi: [],
      formasingresso: [],
      chamadas: {},
      selectedCampus: null,
      loadingChamadas: false,
    }
  },
  created() {
    axios.get(this.WP_API + 'campus')
    .then((response) => {
      setTimeout(() => {
        this.campi = response.data;
      }, 250);
    })
    .catch((error) => {
      console.error(error);
    });

    axios.get(this.WP_API + 'formaingresso')
    .then((response) => {
      this.formasingresso = response.data;
    })
    .catch((error) => {
      console.error(error);
    });
  },
  methods: {
    async getChamadas(campus) {
      this.selectedCampus = campus;
      this.loadingChamadas = true;
      this.chamadas = {};

      await this.formasingresso.forEach(async formaingresso => {
        const params = {
          campus: campus.id,
          formaingresso: formaingresso.id,
        };
        await axios.get(this.WP_API + 'chamada', { params })
        .then((response) => {
          if (Array.isArray(response.data) && response.data.length > 0) {
            this.chamadas[formaingresso.name] = response.data;
          }
        })
        .catch((error) => {
          console.error(error);
        });
      });

      setTimeout(() => {
        this.loadingChamadas = false;
      }, 250);
    },
  },
}, {
  WP_API: WP_API,
});

app.mount('#chamadas');
