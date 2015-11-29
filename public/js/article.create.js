'use strict';

var timer;

var initSummernote = function (text) {
    $('#summernote').summernote({
        height: 300,

        minHeight: 300,
        maxHeight: null,

        focus: false,
        onChange: function () {
            clearTimeout(timer);
            if ($(this).code()) {
                $('#summernote').closest('.form-group').removeClass('has-error');
            }
            timer = setTimeout(saveArticleRequest, 500);
        }
    }).code(text || '');
};

var saveArticleCallback = function (response) {
    $('[name=id]').val(response.id);
    if (response.count) {
        $('#draft-count').text('Koncepty (' + response.count + ')');
    }
};

var saveArticleRequest = function () {
    if (!$('#title').val()) {
        $('#title').closest('.form-group').addClass('has-error');

        return false;
    }
    if (!$('#summernote').code()) {
        $('#summernote').closest('.form-group').addClass('has-error');

        return false;
    }
    $('input[type=submit][value=Uložiť]').attr({
        'disabled': true
    });
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
            $('input[type=submit][value=Uložiť]').attr({
                'disabled': false
            });
            saveArticleCallback(response);
        },
        error: function () {
            $('input[type=submit][value=Uložiť]').attr({
                'disabled': false
            });
        }
    });

    return true;
};

var deleteArticleCallback = function (response) {
    if (response.count) {
        $('#draft-count').text('Koncepty (' + response.count + ')');
    } else {
        $('#draft-count').text('Koncepty');
    }

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
            $('#trash').attr({
                'disabled': false
            });
            deleteArticleCallback(response);
        }
    });
};

$(document).ready(function () {

    $('input[type=submit][value=Uložiť]').on('click', function () {
        if (saveArticleRequest()) {
            $('#custom-message').removeClass('hidden')
                .html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                '<div id="custom-message-text">Článok bol uložený</div>' +
                '</div>');
        }

        return false;
    });

    $('input[type=submit][value=Odoslať]').on('click', function () {
        clearTimeout(timer);

        $('#area').text($('#summernote').code());
    });

    $('#title').on('keyup', function () {
        if ($(this).val()) {
            $(this).closest('.form-group').removeClass('has-error');
        }
    });

    $('#trash').on('click', function () {
        if (!$('[name=id]').val()) {

            return false;
        }
        $(this).attr({
            'disabled': true
        });
        clearTimeout(timer);
        deleteArticleRequest();
        $('#custom-message').removeClass('hidden')
            .html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<div id="custom-message-text">Článok bol zmazaný</div>' +
            '</div>');

        return false;
    });

    if ($('[name=id]').val()) {
        initSummernote($('#area').val());
    } else {
        initSummernote('');
    }

    $('[rel=tooltip]').tooltip({placement: 'top'});
    $('#area').hide();
});