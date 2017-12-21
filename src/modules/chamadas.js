$(document).ready(function() {
    $('#chamadas').find('div.campi, div.modalidades, div.chamadas').hide();

    $('#chamadas a.toggle').on('click', function(e) {
        var link = $(this);

        $(link.attr('href')).parent().children().fadeOut(500).promise().done(function() {
            $(link.attr('href')).children().not('div.campi, div.modalidades, div.chamadas').show();
            $(link.attr('href')).fadeIn(500, function() {
                $('#chamadas').resize();
                if ( $.isFunction($.fn.masonry) ) {
                    $('#ms-grid').masonry();
                }
            });
        });

        e.preventDefault();
    });

    $('#chamadas .breadcrumb a').on('click', function(e) {
        var link = $(this);

        $(link.attr('href')).children().fadeOut(500).promise().done(function() {
            link.closest('div.campi, div.modalidades, div.chamadas').children().hide();
            $(link.attr('href')).children().not('div.campi, div.modalidades, div.chamadas').fadeIn(500, function() {
                $('#chamadas').resize();
                if ( $.isFunction($.fn.masonry) ) {
                    $('#ms-grid').masonry();
                }
            });
        });

        e.preventDefault();
    });
});
