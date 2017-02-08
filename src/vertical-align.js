$(document).ready(function() {
    $('#header-image').flexVerticalCenter({
        cssAttribute: 'padding-top',
        parentSelector: 'header'
    });
    $('.well .media-heading').flexVerticalCenter({
        cssAttribute: 'margin-top',
        parentSelector: '.media-body'
    });
});
