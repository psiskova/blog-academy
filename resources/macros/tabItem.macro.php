<?php

HTML::macro('tabItem', function ($url, $caption, $icon) {
    $actualUrl = Request::url();
    return '<a class="tab-item ' . ($url == $actualUrl ? 'tab-item-active' : '') . '" href="' . $url . '">
                <i class="icon ' . $icon . '"></i>
                <span class="tab - title">' . $caption . '</span>
            </a>';
});