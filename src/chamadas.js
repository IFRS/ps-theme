import axios from 'axios';
import { createApp } from 'vue';

const app = createApp({
  props: {
    WP_API: {
      type: String,
      default: document.querySelector('link[rel="https://api.w.org/"]').getAttribute('href'),
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
    axios.get(this.WP_API + 'wp/v2/campus', { params: { 'per_page': '20' } })
    .then((response) => {
      setTimeout(() => {
        this.campi = response.data;
      }, 250);
    })
    .catch((error) => {
      console.error(error);
    });

    axios.get(this.WP_API + 'wp/v2/formaingresso')
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
        await axios.get(this.WP_API + 'wp/v2/chamada', { params })
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
