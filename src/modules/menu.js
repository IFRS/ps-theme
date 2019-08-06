$(function() {
    $('.menu-principal .menu-item-has-children').addClass('dropright');
    $('.menu-principal .menu-item-has-children > a').attr('data-toggle', 'dropdown').attr('aria-haspopup', 'true').attr('aria-expanded', 'false');
    $('.menu-principal .sub-menu').addClass('dropdown-menu');

    // Impede que o dropdown se feche ao clicar em um item do mesmo.
    $('.menu-principal .dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });

    // Impede que o dropdown se feche ao clicar em qualquer lugar da página.
    $('.menu-principal .menu-item-has-children').on('hide.bs.dropdown', function (e) {
        if (e.clickEvent && e.clickEvent.target !== this) {
            return false;
        }
    });

    // Abre todos os dropdowns até o item atual.
    $('.current-menu-parent > a[data-toggle="dropdown"]').dropdown('show');

    // Controla a exibição do menu em viewports pequenos.
    function menu_resize_control() {
        if ($(window).width() < 992) {
            $(".menu-navbar").collapse('hide');
        } else {
            $(".menu-navbar").collapse('show');
        }
    }

    menu_resize_control();

    var width_control = $(window).width();
    $(window).resize(function() {
        if ($(window).width() === width_control) {
            return;
        }
        menu_resize_control();
    });

    $('.btn-menu-toggle').on('click', function(e) {
        $(".menu-navbar").collapse('toggle');
        e.preventDefault();
    });
});
