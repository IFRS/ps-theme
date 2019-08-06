require('@fancyapps/fancybox');

$(function() {
    $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.svg']").attr('data-fancybox', 'gallery').fancybox();
    $("a[data-fancybox='gallery']").each(function() {
        var caption = $(this).parent().next('.gallery-caption').text();
        if (caption) {
            $(this).attr('data-caption', $.trim(caption));
        }
    });
});
