<?php

HTML::macro('profilePicture', function ($user, $width, $height, array $attributes = []) {
    $params = '';
    foreach ($attributes as $key => $value) {
        $params .= $key . '="' . $value . '" ';
    }

    $width .= '';
    $height .= '';

    if (!str_contains($width, '%')) {
        $width .= 'px';
    }
    if (!str_contains($height, '%')) {
        $height .= 'px';
    }

    return '<img ' . $params . ' onerror="this.src=\'' . asset('img/no_profile_pic.png') . '\'" src="' . action('UserController@getProfileImage', ['id' => $user->profileimage]) . '"style="height: ' . $height . '; width: ' . $width . '">';
});