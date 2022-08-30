const ics = require('ics');
const FileSaver = require('file-saver');
const dayjs = require('dayjs');
const toArray = require('dayjs/plugin/toArray');
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
    button.innerText = "\u23F7 Exibir Datas Passadas \u23F7";

    td.appendChild(button);
    tr.appendChild(td);

    evento_passado.parentNode.insertBefore(tr, evento_passado.nextSibling);

    evento_passado.addEventListener('shown.bs.collapse', function () {
      button.innerText = '\u23F6 Ocultar Datas Passadas \u23F6';
    });
    evento_passado.addEventListener('hidden.bs.collapse', function () {
      button.innerText = '\u23F7 Exibir Datas Passadas \u23F7';
    });
  }

  const btn = document.querySelector('#ics');

  if (btn) {
    btn.addEventListener('click', () => {
      btn.classList.add('disabled');
      let eventos = [];
      jQuery.get('/wp-json/wp/v2/cronograma?per_page=100', (data) => {
        if (Array.isArray(data)) data.forEach((evento) => {
          eventos.push({
            start: dayjs.unix(evento.cmb2._evento_datas['_evento_data-inicio']).toArray().slice(0, 5),
            end: dayjs.unix(evento.cmb2._evento_datas['_evento_data-fim']).toArray().slice(0, 5),
            organizer: { name: 'Processo Seletivo IFRS', email: 'processoseletivo@ifrs.edu.br' },
            title: evento.title.rendered,
            description: evento.content.rendered.replace(/(<([^>]+)>)/gi, '').replace('\n', ''),
            htmlContent: evento.content.rendered,
            url: window.location.origin,
            status: 'CONFIRMED',
            classification: 'PUBLIC',
          });
        });
        ics.createEvents(eventos, (error, calendar) => {
          if (error) console.error(error);
          const blob = new Blob([calendar], {type: 'text/calendar;charset=utf-8'});
          FileSaver.saveAs(blob, 'ps.ics');
        });
      })
      .always(() => {
        btn.classList.remove('disabled');
      });
    });
  }
});
