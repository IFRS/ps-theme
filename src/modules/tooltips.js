import { Tooltip } from 'bootstrap';

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new Tooltip(tooltipTriggerEl);
});

document.querySelectorAll('.menu-social__link').forEach(function(el) {
  let texto = el.getAttribute('aria-label');
  new Tooltip(el, {
    placement: 'top',
    title: texto.trim(),
  });
});

export { tooltipTriggerList }
