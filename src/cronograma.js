import axios from 'axios';
import ics from 'ics';
import FileSaver from 'file-saver';
import dayjs from 'dayjs';
import UTC from 'dayjs/plugin/utc.js';
import toArray from 'dayjs/plugin/toArray.js';

dayjs.extend(UTC);
dayjs.extend(toArray);

document.addEventListener('DOMContentLoaded', () => {
  const WP_API = document.querySelector('link[rel="https://api.w.org/"]').getAttribute('href');

  let observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.intersectionRatio > 0) {
        entry.target.classList.add('evento--novo');
      }
    });
  });

  const cronogramaNode = document.querySelector('#cronograma-data');
  const cronograma = cronogramaNode ? JSON.parse(cronogramaNode.textContent || '[]') : [];

  if (cronograma.length > 0) {
    let cronograma_local = localStorage.getItem('ifrs_ps_cronograma');

    if (cronograma_local === null) {
      localStorage.setItem('ifrs_ps_cronograma', JSON.stringify(cronograma));
    }

    cronograma_local = JSON.parse(localStorage.getItem('ifrs_ps_cronograma') || '[]');

    let difference = cronograma.filter(x => !cronograma_local.includes(x));

    if (difference.length > 0) {
      difference.forEach(id => {
        let evento = document.querySelector('#evento-' + id);
        if (evento) {
          evento.setAttribute('aria-label', 'Nova data adicionada desde sua última visita.');
          observer.observe(evento);
        }
      });

      localStorage.setItem('ifrs_ps_cronograma', JSON.stringify(cronograma));
    }
  }

  let eventos_passados = document.querySelectorAll('.evento--passado');
  eventos_passados.forEach(evento => evento.classList.add('collapse'));

  const switchElement = document.querySelector('#cronograma__switch');
  if (switchElement && eventos_passados.length > 0) {
    switchElement.addEventListener('change', () => {
      eventos_passados.forEach(evento => {
        if (switchElement.checked) {
          evento.classList.add('show');
        } else {
          evento.classList.remove('show');
        }
      });
    });
  }

  const btn = document.querySelector('#ics');

  if (btn) {
    btn.addEventListener('click', () => {
      btn.classList.add('disabled');
      let eventos = [];
      axios.get(WP_API + 'wp/v2/cronograma?per_page=100')
        .then(response => {
          if (Array.isArray(response.data)) response.data.forEach((evento) => {
            let start_date = dayjs.unix(evento.cmb2._evento_datas['_evento_data-inicio']).utc().toArray().slice(0, 6);
            start_date[1]++ // Workaround para correção de comportamento no método toArray, que conta os meses a partir do 0 (zero).

            let end_date = dayjs.unix(evento.cmb2._evento_datas['_evento_data-fim']).utc().toArray().slice(0, 6);
            end_date[1]++

            let created_date = dayjs(evento.date_gmt).toArray().slice(0, 6);
            created_date[1]++

            let modified_date = dayjs(evento.modified_gmt).toArray().slice(0, 6);
            modified_date[1]++

            eventos.push({
              start: start_date,
              startOutputType: 'local',
              end: end_date,
              endOutputType: 'local',
              organizer: { name: 'IFRS', email: 'processoseletivo@ifrs.edu.br' },
              title: evento.title.rendered,
              description: evento.content.rendered.replace(/(<([^>]+)>)/gi, '').replace('\n', ''),
              htmlContent: evento.content.rendered,
              url: window.location.origin,
              status: 'CONFIRMED',
              classification: 'PUBLIC',
              created: created_date,
              lastModified: modified_date,
            });
          });
          ics.createEvents(eventos, (error, calendar) => {
            if (error) console.error(error);
            const blob = new Blob([calendar], { type: 'text/calendar;charset=utf-8' });
            FileSaver.saveAs(blob, 'ps.ics');
          });
        })
        .catch(err => {
          console.error(err);
        })
        .finally(() => {
          btn.classList.remove('disabled');
        });
    });
  }
});
