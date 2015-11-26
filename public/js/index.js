'use strict';

$(document).ready(function () {
    $('input.typeahead').typeahead({
        ajax: laroute.action('SearchController@getSearch'),
        displayField: 'title'
    });

    $('.course-option').on('change', function () {

        this.form.submit();
    });
});