'use strict';

$(document).ready(function () {
    $('input.typeahead').typeahead({
        ajax: laroute.action('SearchController@getSearch'),
        displayField: 'title'
    });

    $('#chooseCourse').on('change', function () {

        this.form.submit();
    });
});