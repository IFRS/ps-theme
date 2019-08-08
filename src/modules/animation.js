const intersectionObserver = effect => new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (entry.intersectionRatio > 0) {
            $(entry.target).addClass(effect);
            observer.unobserve(entry.target);
        }
    });
});

$(function() {
    $('.header__marca').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('slideInDown');
        observer.observe(e);
    });

    $('.menu-social__item').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('zoomIn slow');
        observer.observe(e);
    });

    $('.menu-principal').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('slideInUp faster');
        observer.observe(e);
    });

    $('.menu-principal > .menu-item').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('fadeInRight faster delay-1s');
        observer.observe(e);
    });

    $('.widget-atalhos').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('flipInX');
        observer.observe(e);
    });

    $('.btn-formaingresso').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('fadeInLeft');
        observer.observe(e);
    });

    $('.title-sobreposto').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('slideInDown');
        observer.observe(e);
    });

    $('.home-faq__item').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('bounceInRight');
        observer.observe(e);
    });

    $('.home-cursos svg').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('zoomIn delay-1s');
        observer.observe(e);
    });

    $('.aside__item').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('fadeInRight');
        observer.observe(e);
    });
});
