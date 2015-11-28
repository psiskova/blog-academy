function resizeArea(arg) {
    $("#" + arg + ", ." + arg).toggle();
}

var saveRateCallback = function (response) {
    $('#rate').rating('refresh', {disabled: true});
};

var saveRateRequest = function (value, article_id) {
    $.ajax({
        url: laroute.action('ArticleController@postRating'),
        method: 'POST',
        dataType: 'JSON',
        data: {
            article_id: article_id,
            rating: value
        },
        success: function (response) {
            saveRateCallback(response);
        }
    });
};

$(document).ready(function () {
    $('#rate').on('rating.change', function (event, value) {
        saveRateRequest(value, $(this).data('article_id'));
    });
});