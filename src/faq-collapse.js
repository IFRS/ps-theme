$(document).ready(function() {
    $('#accordion .panel-collapse').on('show.bs.collapse', function() {
        $(this).parent().find('.panel-title .glyphicon').removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
    });
    $('#accordion .panel-collapse').on('hide.bs.collapse', function() {
        $(this).parent().find('.panel-title .glyphicon').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
    });
});
