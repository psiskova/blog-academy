<?php

HTML::macro('profileGrid', function ($profiles) {
    $_user = [];
    foreach ($profiles as $profile) {
        $_user[] = HTML::profilePicture($profile, 125, 125, ['class' => 'img-circle']) .
            '<h3>' . $profile->fullname . '</h3>';
    }
    $count = count($_user);
    for ($i = 0; $i < $count; $i++) {
        if ($count % 3 == 0) {
            $_user[$i] = '<div class="col-md-4">' . $_user[$i] . '</div>';
            continue;
        }

        if ($i >= ($count - ($count % 3))) {

            if ($count % 3 == 1) {

                $_user[$i] = '<div class="col-md-12">' . $_user[$i] . '</div>';
            } else {
                if ($i % 3 == 0) {

                    $_user[$i] = '<div class="col-md-offset-2 col-md-4">' . $_user[$i] . '</div>';
                } else {

                    $_user[$i] = '<div class="col-md-4">' . $_user[$i] . '</div>';
                }
            }
        } else {

            $_user[$i] = '<div class="col-md-4">' . $_user[$i] . '</div>';
        }
    }
    $result = '<div class="row">';

    $result .= implode('</div><div class="row">', array_map(function ($i) {

        return implode("", $i);
    }, array_chunk($_user, 3)));

    $result = $result . '</div>';
    
    return $result;
});