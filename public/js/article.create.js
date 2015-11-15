'use strict';

var saveArticleCallback = function (response) {

};

var saveArticleRequest = function () {
    $.ajax({
        url: laroute.action('ArticleController@postArticle'),
        method: 'POST',
        dataType: 'json',
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
    $('#area').remove();

    $('#summernote').summernote({
        height: 300,                 // set editor height

        minHeight: 300,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor

        focus: false,                 // set focus to editable area after initializing summernote
    });

    $('input[type=submit][value=Uložiť]').on('click', function () {
        saveArticleRequest();

        return false;
    });
});