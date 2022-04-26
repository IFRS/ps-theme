const Masonry =  require('masonry-layout');

document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('masonry')) {
        new Masonry( '#masonry', {
            itemSelector: '.col-auto',
            columnWidth: '.col-auto',
            percentPosition: true,
        });
    }
});
