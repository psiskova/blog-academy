'use strict';

var updateUserCallback = function (response) {

};

var updateUserRequest = function (data) {

    $.ajax({
        url: laroute.action('UserController@postManagement'),
        method: 'POST',
        'data': data,
        dataType: 'JSON',
        success: function (response) {
            updateUserCallback(response);
        }
    });
};

$(document).ready(function () {
    $('select[name=role]').on('change', function () {
        let data = {
            id: $(this).attr('id'),
            role: $(this).val()
        };

        updateUserRequest(data);

        return false;
    });
});