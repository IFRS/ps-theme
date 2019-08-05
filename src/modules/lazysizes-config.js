require('lazysizes');

$(function() {
    $('img[data-src]').addClass('lazyload');
    $('img[data-srcset]').addClass('lazyload');
    $('img[srcset]').attr('data-sizes', 'auto');
});
