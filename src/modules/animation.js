$(function() {
    const intersectionObserver = effect => new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.intersectionRatio > 0) {
                $(entry.target).addClass(effect);
                observer.unobserve(entry.target);
            }
        });
    });

    $('.btn-formaingresso').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('fadeInLeft');
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

    $('.title-sobreposto').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('slideInDown');
        observer.observe(e);
    });

    $('.aside__item').addClass('animated').each(function(i, e) {
        let observer = intersectionObserver('fadeInRight');
        observer.observe(e);
    });
});
