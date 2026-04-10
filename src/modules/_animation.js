import 'intersection-observer';

const intersectionObserver = effect => new IntersectionObserver((entries, observer) => {
  entries.forEach((entry) => {
    if (entry.intersectionRatio > 0) {
      entry.target.classList.add(...effect);
      observer.unobserve(entry.target);
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  let delay = 0;

  document.querySelectorAll('.searchform').forEach(element => {
    element.classList.add('animate__animated');
    let observer = intersectionObserver(['animate__slideInRight']);
    observer.observe(element);
  });

  document.querySelectorAll('.menu-social__item').forEach(element => {
    element.classList.add('animate__animated');
    let observer = intersectionObserver(['animate__zoomIn', 'animate__slow']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.widget-atalhos').forEach(element => {
    element.classList.add('animate__animated');
    element.style = 'animation-delay:' + delay + 's';
    delay = delay + 0.1;
    let observer = intersectionObserver(['animate__flipInX']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.btn-campus').forEach(element => {
    element.classList.add('animate__animated');
    element.style = 'animation-delay:' + delay + 's';
    delay = delay + 0.1;
    let observer = intersectionObserver(['animate__fadeInLeft']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.home-faq__item').forEach(element => {
    element.classList.add('animate__animated');
    let observer = intersectionObserver(['animate__bounceInRight']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.aside__item').forEach(element => {
    element.classList.add('animate__animated');
    element.style = 'animation-delay:' + delay + 's';
    delay = delay + 0.1;
    let observer = intersectionObserver(['animate__fadeInRight']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.editais .list-group-item').forEach(element => {
    element.classList.add('animate__animated');
    element.style = 'animation-delay:' + delay + 's';
    delay = delay + 0.2;
    let observer = intersectionObserver(['animate__fadeInDown']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.cursos__nav .nav-item').forEach(element => {
    element.classList.add('animate__animated');
    element.style = 'animation-delay:' + delay + 's';
    delay = delay + 0.1;
    let observer = intersectionObserver(['animate__fadeInDown', 'animate__fast']);
    observer.observe(element);
  });

  delay = 0;
  document.querySelectorAll('.site-map__menu > .menu-item').forEach(element => {
    element.classList.add('animate__animated');
    element.style = 'animation-delay:' + delay + 's';
    delay = delay + 0.2;
    let observer = intersectionObserver(['animate__fadeIn']);
    observer.observe(element);
  });

  document.querySelectorAll('.footer-logo').forEach(element => {
    element.classList.add('animate__animated');
    let observer = intersectionObserver(['animate__slideInUp']);
    observer.observe(element);
  });

  document.querySelectorAll('.contato').forEach(element => {
    element.classList.add('animate__animated');
    let observer = intersectionObserver(['animate__fadeInUp']);
    observer.observe(element);
  });

  document.querySelectorAll('.creditos').forEach(element => {
    element.classList.add('animate__animated');
    let observer = intersectionObserver(['animate__zoomIn']);
    observer.observe(element);
  });
});
