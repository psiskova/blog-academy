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
                $('#error-message').text('Súbor je príliš veľký. Maximálna veľkost 2048kB');
                $(this).val('');

                return false;
            }
            if (!this.files[0].type.match(/image.*/)) {
                $('.image-error').removeClass('hidden');
                $('#error-message').text('Nepodporovaný formát súboru');
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