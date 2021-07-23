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

        console.log('Cronograma Server:');
        console.log(cronograma);
        console.log('Cronograma Local:');
        console.log(cronograma_local);

        let difference = cronograma.filter(x => !cronograma_local.includes(x));
        console.log('Diferença:');
        console.log(difference);

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
});
