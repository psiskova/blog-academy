<?php

HTML::macro('tabItem', function ($url, $caption, $icon, $colorstyle) {
    $actualUrl = Request::url();
    return '<a class="tab-item ' . $colorstyle . ' ' . ($url == $actualUrl ? 'tab-item-active' : '') . '" href="' . $url . '">
                <i class="icon ' . $icon . '"></i>
                <span class="tab - title">' . $caption . '</span>
            </a>';
});