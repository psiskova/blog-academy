<?php

HTML::macro('profilePicture', function ($user, $width, $height, array $attributes = []) {
    $params = '';
    foreach ($attributes as $key => $value) {
        $params .= $key . '="' . $value . '" ';
    }

    return '<img ' . $params . ' onerror="this.src=\'img/no_profile_pic.png\'" src="' . action('UserController@getProfileImage', ['id' => $user->profileimage]) . '"style="height: ' . $height . 'px; width: ' . $width . 'px">';
});