'use strict';

var updateUserCallback = function (response) {
    let hidden = $('[name=id][value=' + response.id + ']'),
        tr = $(hidden).closest('tr');
    $('.disabled', tr).removeClass('disabled');
    $('[value=' + response.ban + ']', tr).addClass('disabled');
};

var updateUserRequest = function (data) {

    $.ajax({
        url: laroute.action('UserController@postBlock'),
        method: 'POST',
        'data': data,
        dataType: 'JSON',
        success: function (response) {
            updateUserCallback(response);
        }
    });
};

$(document).ready(function () {
    $('td button').on('click', function () {
        let tr = $(this).closest('tr'),
            userId = $('[name=id]', tr).val(),
            ban = $(this).val(),
            data = {
                'ban': ban,
                id: userId
            };

        updateUserRequest(data);

        return false;
    });
});