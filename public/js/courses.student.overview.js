'use strict';

var joinCourseCallback = function (response) {
    $('button[data-course=' + response.id + ']').closest('td').html('Čaká na schválenie');
};

var joinCourseRequest = function (id) {
    $.ajax({
        url: laroute.action('CourseController@postJoinCourse'),
        method: 'POST',
        dataType: 'json',
        data: {
            course_id: id
        },
        success: function (response) {
            joinCourseCallback(response);
        }
    })
};

$(document).ready(function () {

    $('button[type=button]').on('click', function () {

        joinCourseRequest($(this).data('course'));
        return false;
    });
});