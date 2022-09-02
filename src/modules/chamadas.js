jQuery(function($) {
  $('.chamadas').find('div.chamadas__campi, div.modalidades, div.chamadas__list').hide();

  $('.chamadas a.toggle').on('click', function(e) {
    var link = $(this);

    $(link.attr('href')).parent().children().fadeOut(500).promise().done(function() {
      $(link.attr('href')).children().not('div.chamadas__campi, div.modalidades, div.chamadas__list').show();
      $(link.attr('href')).fadeIn(500, function() {
        $('.chamadas').resize();
      });
    });

    e.preventDefault();
  });

  $('.chamadas .breadcrumb a').on('click', function(e) {
    var link = $(this);

    $(link.attr('href')).children().fadeOut(500).promise().done(function() {
      link.closest('div.chamadas__campi, div.modalidades, div.chamadas__list').children().hide();
      $(link.attr('href')).children().not('div.chamadas__campi, div.modalidades, div.chamadas__list').fadeIn(500, function() {
        $('.chamadas').resize();
      });
    });

    e.preventDefault();
  });
});
