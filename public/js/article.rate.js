'use strict';

$(document).ready(function () {
    $('#summernote').summernote({
        height: 300,

        minHeight: 300,
        maxHeight: null,

        focus: false
    });

    $('input[type=submit]').on('click', function () {

        $('#text').text($('#summernote').code());
    });
});