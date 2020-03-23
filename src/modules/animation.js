const intersectionObserver = effect => new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (entry.intersectionRatio > 0) {
            $(entry.target).addClass(effect);
            observer.unobserve(entry.target);
        }
    });
});

$(function() {
    var delay = 0;

    $('.searchform').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('slideInLeft');
        observer.observe(e);
    });

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

    delay = 0.5;
    $('.menu-principal > .menu-item').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.05;
        let observer = intersectionObserver('fadeInRight faster');
        observer.observe(e);
    });

    delay = 0;
    $('.widget-atalhos').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('flipInX');
        observer.observe(e);
    });

    delay = 0;
    $('.btn-formaingresso').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('fadeInLeft');
        observer.observe(e);
    });

    $('.chamadas__campi').each(function(i, e) {
        delay = 0;
        $(e).find('.btn-campus').addClass('animated').each(function(ii, ee) {
            $(ee).css('animation-delay', delay + 's');
            delay = delay + 0.1;
            let observer = intersectionObserver('fadeInLeft');
            observer.observe(ee);
        });
    });

    $('.chamadas__list').each(function(i, e) {
        delay = 0;
        $(e).find('.chamada').addClass('animated').each(function(ii, ee) {
            $(ee).css('animation-delay', delay + 's');
            delay = delay + 0.1;
            let observer = intersectionObserver('fadeInLeft');
            observer.observe(ee);
        });
    });

    delay = 0.5;
    $('.chamada__badges').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        let observer = intersectionObserver('fadeInUp');
        observer.observe(e);
    });

    delay = 0.9;
    $('.chamada__badges > .badge-modalidade').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.05;
        let observer = intersectionObserver('fadeInUp');
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

    delay = 0;
    $('.aside__item').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('fadeInRight');
        observer.observe(e);
    });

    delay = 0;
    $('.editais .list-group-item').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.2;
        let observer = intersectionObserver('fadeInLeft');
        observer.observe(e);
    });

    delay = 0;
    $('.cursos__nav .nav-item').addClass('animated').each(function(i, e) {
        $(e).css('animation-delay', delay + 's');
        delay = delay + 0.1;
        let observer = intersectionObserver('fadeInDown fast');
        observer.observe(e);
    });
});
