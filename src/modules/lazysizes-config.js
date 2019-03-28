require('lazysizes');

$(function() {
    $('img[srcset]').attr('data-sizes', 'auto');
    $('img').addClass('lazyload');
});
