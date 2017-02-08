$(document).ready(function() {
    $('#resultados').find('div.campi, div.modalidades, div.resultados').hide();

    $('#resultados a.toggle').on('click', function(e) {
        var link = $(this);

        $(link.attr('href')).parent().children().fadeOut(500).promise().done(function() {
            $(link.attr('href')).children().not('div.campi, div.modalidades, div.resultados').show();
            $(link.attr('href')).fadeIn(500, function() {
                $('#resultados').resize();
                if ( $.isFunction($.fn.masonry) ) {
                    $('#ms-grid').masonry();
                }
            });
        });

        e.preventDefault();
    });

    $('#resultados .breadcrumb a').on('click', function(e) {
        var link = $(this);

        $(link.attr('href')).children().fadeOut(500).promise().done(function() {
            link.closest('div.campi, div.modalidades, div.resultados').children().hide();
            $(link.attr('href')).children().not('div.campi, div.modalidades, div.resultados').fadeIn(500, function() {
                $('#resultados').resize();
                if ( $.isFunction($.fn.masonry) ) {
                    $('#ms-grid').masonry();
                }
            });
        });

        e.preventDefault();
    });
});
