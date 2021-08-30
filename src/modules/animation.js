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
    const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");

    if (mediaQuery && !mediaQuery.matches) {
        let delay = 0;

        $('.searchform').addClass('animate__animated').each(function(i, e) {
            let observer = intersectionObserver('animate__slideInRight');
            observer.observe(e);
        });

        $('.menu-social__item').addClass('animate__animated').each(function(i, e) {
            let observer = intersectionObserver('animate__zoomIn animate__slow');
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

        $('.home-faq__item').addClass('animate__animated').each(function(i, e) {
            let observer = intersectionObserver('animate__bounceInRight');
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
            let observer = intersectionObserver('animate__fadeInDown');
            observer.observe(e);
        });

        delay = 0;
        $('.cursos__nav .nav-item').addClass('animate__animated').each(function(i, e) {
            $(e).css('animation-delay', delay + 's');
            delay = delay + 0.1;
            let observer = intersectionObserver('animate__fadeInDown animate__fast');
            observer.observe(e);
        });

        delay = 0;
        $('.site-map__menu > .menu-item').addClass('animate__animated').each(function(i, e) {
            $(e).css('animation-delay', delay + 's');
            delay = delay + 0.2;
            let observer = intersectionObserver('animate__fadeIn');
            observer.observe(e);
        });

        $('.footer-logo').addClass('animate__animated').each(function(i, e) {
            let observer = intersectionObserver('animate__slideInUp');
            observer.observe(e);
        });

        $('.contato').addClass('animate__animated').each(function(i, e) {
            let observer = intersectionObserver('animate__fadeInUp');
            observer.observe(e);
        });

        $('.creditos').addClass('animate__animated').each(function(i, e) {
            let observer = intersectionObserver('animate__zoomIn');
            observer.observe(e);
        });
    }
});
