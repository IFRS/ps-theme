require('jquery-bridget');
require('masonry-layout');

$(window).load(function() {
    $('#ms-grid').masonry({
        itemSelector: '.ms-item',
        percentPosition: true
    });
});
