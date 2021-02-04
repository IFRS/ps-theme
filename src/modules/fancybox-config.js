require('@fancyapps/fancybox/src/js/core.js');
// require('@fancyapps/fancybox/src/js/media.js');
require('@fancyapps/fancybox/src/js/guestures.js');
// require('@fancyapps/fancybox/src/js/slideshow.js');
// require('@fancyapps/fancybox/src/js/fullscreen.js');
// require('@fancyapps/fancybox/src/js/thumbs.js');
// require('@fancyapps/fancybox/src/js/hash.js');
// require('@fancyapps/fancybox/src/js/wheel.js');

$(function() {
    $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.svg']").attr('data-fancybox', 'gallery').fancybox();
    $("a[data-fancybox='gallery']").each(function() {
        var caption = $(this).parent().next('.gallery-caption').text() || $(this).siblings('figcaption').first().text();
        if (caption) {
            $(this).attr('data-caption', $.trim(caption));
        }
    });
});
