let Rellax = require('rellax');

$(document).ready(function() {
    if ($('.rellax').length != 0) {
        var rellax = new Rellax('.rellax', {
            speed: 2,
            center: true,
            wrapper: null,
            round: false,
            vertical: true,
            horizontal: false
        });
    }
});
