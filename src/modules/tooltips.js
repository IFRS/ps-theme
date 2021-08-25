import Tooltip from 'bootstrap/js/dist/tooltip';

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new Tooltip(tooltipTriggerEl);
});

document.querySelectorAll('.menu-social__link').forEach(function(el) {
    let texto = el.querySelector('span').textContent;
    new Tooltip(el, {
        placement: 'top',
        title: texto.trim(),
    });
});
