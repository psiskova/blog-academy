'use strict';

var rating;

var rateArticleCallback = function (response) {

};

var rateArticleRequest = function () {
    $.ajax({
        url: laroute.action('ArticleController@postRate'),
        method: 'POST',
        dataType: 'json',
        data: {
            article_id: $('input[name=id]').val(),
            text: $('#summernote').code(),
            rating: rating
        },
        success: function (response) {
            rateArticleCallback(response);
        }
    });
};

$(document).ready(function () {
    $('#summernote').summernote({
        height: 300,

        minHeight: 300,
        maxHeight: null,

        focus: false
    });

    $('input[type=submit]').on('click', function () {
        rateArticleRequest();

        return false;
    });

    $('#input-id').on('rating.change', function (e, value) {

        rating = value;
    });
});