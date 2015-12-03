<?php

HTML::macro('tabItem', function ($url, $caption, $icon, $colorStyle, $aClass = '') {
    $actualUrl = Request::url();

    return '<a class="tab-item ' . $colorStyle . ' ' . ($url == $actualUrl ? 'tab-item-active' : '') . ' ' . $aClass . '" ' . ($caption == 'Viac' ? 'name="' : 'href="') . $url . '">
                <i class="icon ' . $icon . ' ' . $aClass . '"></i>
                <span class="tab-title">' . $caption . '</span>
            </a>';
});