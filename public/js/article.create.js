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
            'task_id': $('#task_id').val(),
            id: $('[name=id]').val()
        },
        success: function (response) {
            saveArticleCallback(response);
        }
    });
};

var deleteArticleCallback = function (response) {

    $('[name=id]').val('');
    $('#title').val('');
    $('#tags').val('').tagsinput('removeAll');
    $('#task_id').val('');
    initSummernote();
};

var deleteArticleRequest = function () {
    $.ajax({
        url: laroute.action('ArticleController@postDelete'),
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: $('[name=id]').val()
        },
        success: function (response) {
            deleteArticleCallback(response);
        }
    });
};

$(document).ready(function () {

    $('input[type=submit][value=Uložiť]').on('click', function () {
        saveArticleRequest();

        return false;
    });

    $('input[type=submit][value=Odoslať]').on('click', function () {

        $('#area').text($('#summernote').code());
    });

    $('#trash').on('click', function () {
        deleteArticleRequest();

        return false;
    });

    if ($('[name=id]').val()) {
        initSummernote($('#area').val());
    } else {
        initSummernote('');
    }
    $('#area').hide();
});