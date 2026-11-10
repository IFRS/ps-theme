import { createApp } from 'vue';
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime.js';
import 'dayjs/locale/pt-br.js';

dayjs.extend(relativeTime);
dayjs.locale('pt-br');

const app = createApp({
  props: {
    WP_API: {
      type: String,
      default: document.querySelector('link[rel="https://api.w.org/"]').getAttribute('href'),
    },
  },
  computed: {
    dayjs() {
      return dayjs;
    },
  },
  data() {
    return {
      campi: [],
      chamadas: {},
      selectedCampus: null,
      loadingChamadas: false,
    }
  },
  created() {
    axios.get(this.WP_API + 'wp/v2/campus', { params: { 'per_page': '100' } })
      .then((response) => {
        setTimeout(() => {
          this.campi = response.data;
        }, 250);
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

      const params = {
        order: 'desc',
        orderby: 'date',
        per_page: 100,
        campus: campus.id,
      };
      await axios.get(this.WP_API + 'wp/v2/chamada', { params })
        .then((response) => {
          if (Array.isArray(response.data) && response.data.length > 0) {
            this.chamadas = response.data;
          }
        })
        .catch((error) => {
          console.error(error);
        });

      setTimeout(() => {
        this.loadingChamadas = false;
      }, 250);
    },
  },
});

app.mount('#chamadas');
