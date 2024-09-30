import axios from 'axios';
import ics from 'ics';
import FileSaver from 'file-saver';
import dayjs from 'dayjs';
import UTC from 'dayjs/plugin/utc.js';
import toArray from 'dayjs/plugin/toArray.js';

dayjs.extend(UTC);
dayjs.extend(toArray);

document.addEventListener('DOMContentLoaded', () => {
  let observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.intersectionRatio > 0) {
        entry.target.classList.add('evento--novo');
      }
    });
  });

  if (typeof cronograma !== 'undefined') {
    let cronograma_local = localStorage.getItem('ifrs_ps_cronograma');

    if (cronograma_local === null) {
      localStorage.setItem('ifrs_ps_cronograma', JSON.stringify(cronograma));
    }

    cronograma_local = JSON.parse(localStorage.getItem('ifrs_ps_cronograma'));

    let difference = cronograma.filter(x => !cronograma_local.includes(x));

    if (difference) {
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

  let evento_passado = Array.from(eventos_passados).pop();
  if (evento_passado) {
    let tr = document.createElement('tr');
    let td = document.createElement('td');
    td.setAttribute('colspan', '2');
    td.classList.add('border-0', 'ps-0', 'pe-0');
    let button = document.createElement('button');
    button.classList.add('btn', 'btn-block', 'cronograma__toggle');
    button.setAttribute('type', 'button');
    button.setAttribute('data-bs-toggle', 'collapse');
    button.setAttribute('data-bs-target', '.evento--passado');
    button.setAttribute('aria-expanded', 'false');
    button.innerText = "Exibir Datas Passadas";

    td.appendChild(button);
    tr.appendChild(td);

    evento_passado.parentNode.insertBefore(tr, evento_passado.nextSibling);

    evento_passado.addEventListener('shown.bs.collapse', function () {
      button.innerText = 'Ocultar Datas Passadas';
    });
    evento_passado.addEventListener('hidden.bs.collapse', function () {
      button.innerText = 'Exibir Datas Passadas';
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
          start_date[1]++ // Workaround para correção de "bug" no método toArray, que conta os meses a partir do 0 (zero).

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
