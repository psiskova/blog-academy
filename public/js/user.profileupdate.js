'use strict';

$(document).ready(function () {

    $('#profile_picture').on('click', function () {
        $('[name=image]').click();
    });

    $('[name=image]').on('change', function () {

        if (this.files && this.files[0]) {
            console.log(this.files[0].size / 1024 > 2048);
            if (this.files[0].size / 1024 > 2048) {
                $('.image-error').removeClass('hidden');
                $(this).val('');

                return false;
            }
            $('.image-error').addClass('hidden');
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile_picture').attr({
                    src: e.target.result
                });
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
});