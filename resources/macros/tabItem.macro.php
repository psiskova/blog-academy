<?php

HTML::macro('tabItem', function ($url, $caption, $icon, $colorStyle) {
    $actualUrl = Request::url();

    return '<a class="tab-item ' . $colorStyle . ' ' . ($url == $actualUrl ? 'tab-item-active' : '') . '" href="' . $url . '">
                <i class="icon ' . $icon . '"></i>
                <span class="tab - title">' . $caption . '</span>
            </a>';
});