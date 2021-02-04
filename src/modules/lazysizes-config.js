require('lazysizes');
require('lazysizes/plugins/native-loading/ls.native-loading');

$(function() {
    $('img[data-src]').addClass('lazyload');
    $('img[data-srcset]').addClass('lazyload');
    $('img[srcset]').attr('data-sizes', 'auto');
});
