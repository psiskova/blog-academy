'use strict';

var initSummernote = function (text) {
    $('#summernote').summernote({
        height: 300,

        minHeight: 300,
        maxHeight: null,

        focus: false
    }).code(text || '');
};

var saveArticleCallback = function (response) {
    $('[name=id]').val(response.id);
};

var saveArticleRequest = function () {
    $.ajax({
        url: laroute.action('ArticleController@postCreate'),
        method: 'POST',
        dataType: 'JSON',
        data: {
            text: $('#summernote').code(),
            title: $('#title').val(),
            tags: $('#tags').val(),
            action: 'Uložiť',
            id: $('[name=id]').val()
        },
        success: function (response) {
            saveArticleCallback(response);
        }
    });
};

$(document).ready(function () {

    $('input[type=submit][value=Uložiť]').on('click', function () {
        saveArticleRequest();

        return false;
    });

    if ($('[name=id]').val()) {
        initSummernote($('#area').val());
    } else {
        initSummernote('');
    }
    $('#area').remove();
});