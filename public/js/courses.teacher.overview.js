'use strict';

var updateParticipantCallback = function (response) {
    $('button[data-user=' + response.id + ']').closest('td').html(response.value);
};

var updateParticipantRequest = function (id, state) {
    $.ajax({
        url: laroute.action('CourseController@postUpdateParticipant'),
        method: 'POST',
        dataType: 'json',
        data: {
            user_id: id,
            state: state
        },
        success: function (response) {
            updateParticipantCallback(response);
        }
    });
};

$(document).ready(function () {

    $('button[type=button]').on('click', function () {

        updateParticipantRequest($(this).data('user'), $(this).data('value'));
        return false;
    });
});