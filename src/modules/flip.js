$(document).ready(function() {
    $(window).on('scroll', function() {
        clearTimeout($.data(this, 'scrollTimer'));
        $.data(this, 'scrollTimer', setTimeout(function() {
            $('.home-ajuda__image').toggleClass('home-ajuda__image_reverse');
        }, 150));
    });
});
