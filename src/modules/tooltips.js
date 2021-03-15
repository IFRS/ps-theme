$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.menu-social__link').each(function (i, e) {
    texto = $(e).children('span').first().html();
    $(e).tooltip({
        placement: 'top',
        title: texto.trim(),
    });
});
