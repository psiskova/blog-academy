<?php

HTML::macro('navTabItem', function ($url, $caption, $icon, $otherActions = []) {
    $actualUrl = Request::url();

    $active = $url == $actualUrl;

    if (!$active) {
        foreach ($otherActions as $action) {
            if ($actualUrl == action($action)) {
                $active = true;
                break;
            }
        }
    }

    return '<a class="tab-item ' . ($active ? 'nav-tab-item-active' : '') . '" href="' . $url . '">
                <i class="icon icon-resizer ' . $icon . '"></i>
                <span class="nav-tab-item-caption">' . $caption . '</span>
            </a>';
});