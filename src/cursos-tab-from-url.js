// Javascript to enable link to tab
var hash = document.location.hash;
if (hash) {
    $('.list-campi a[href="'+hash+'"]').tab('show');
}
