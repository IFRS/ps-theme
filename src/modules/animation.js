require('intersection-observer');

const intersectionObserver = effect => new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (entry.intersectionRatio > 0) {
            $(entry.target).addClass(effect);
            observer.unobserve(entry.target);
        }
    });
});

$(function() {
    let delay = 0;

    $('.searchform').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__slideInLeft');
        observer.observe(e);
    });

    $('.header__marca').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__slideInDown');
        observer.observe(e);
    });

    $('.menu-social__item').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__zoomIn animate__slow');
        observer.observe(e);
    });

    $('.menu').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__slideInDown animate__faster');
        observer.observe(e);
    });

    delay = 0.5;
    $('.menu-principal > .menu-item').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.05;
        let observer = intersectionObserver('animate__fadeInRight animate__faster');
        observer.observe(e);
    });

    delay = 0;
    $('.widget-atalhos').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('animate__flipInX');
        observer.observe(e);
    });

    delay = 0;
    $('.btn-formaingresso').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('animate__fadeInLeft');
        observer.observe(e);
    });

    $('.chamadas__campi').each(function(i, e) {
        delay = 0;
        $(e).find('.btn-campus').addClass('animate__animated').each(function(ii, ee) {
            $(ee).css('animation-delay', delay + 's');
            delay = delay + 0.1;
            let observer = intersectionObserver('animate__fadeInLeft');
            observer.observe(ee);
        });
    });

    $('.chamadas__list').each(function(i, e) {
        delay = 0;
        $(e).find('.chamada').addClass('animate__animated').each(function(ii, ee) {
            $(ee).css('animation-delay', delay + 's');
            delay = delay + 0.1;
            let observer = intersectionObserver('animate__fadeInLeft');
            observer.observe(ee);
        });
    });

    delay = 0.5;
    $('.chamada__badges').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        let observer = intersectionObserver('animate__fadeInUp');
        observer.observe(e);
    });

    delay = 0.9;
    $('.chamada__badges > .badge-modalidade').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.05;
        let observer = intersectionObserver('animate__fadeInUp');
        observer.observe(e);
    });

    $('.title-sobreposto').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__slideInDown');
        observer.observe(e);
    });

    $('.home-faq__item').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__bounceInRight');
        observer.observe(e);
    });

    $('.home-cursos svg').addClass('animate__animated').each(function(i, e) {
        let observer = intersectionObserver('animate__zoomIn animate__delay-1s');
        observer.observe(e);
    });

    delay = 0;
    $('.aside__item').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('animate__fadeInRight');
        observer.observe(e);
    });

    delay = 0;
    $('.editais .list-group-item').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.2;
        let observer = intersectionObserver('animate__fadeInLeft');
        observer.observe(e);
    });

    delay = 0;
    $('.cursos__nav .nav-item').addClass('animate__animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('animate__fadeInDown animate__fast');
        observer.observe(e);
    });
});
