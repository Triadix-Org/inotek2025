jQuery(document).ready(function ($) {

    $('#back-to-top').click(function() {

    });

    $('.current-language').click(function(e) {
        e.preventDefault();
        $('#language-menu ul.sub-menu').show();
    })
});