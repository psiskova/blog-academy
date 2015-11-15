<?php

HTML::macro('navTabItem', function ($url, $caption, $icon) {
    $actualUrl = Request::url();
    return '<a class="tab-item ' . ($url == $actualUrl ? 'nav-tab-item-active' : '') . '" href="' . $url . '">
                <i class="icon icon-resizer ' . $icon . '"></i>
                <span class="nav-tab-item-caption">' . $caption . '</span>
            </a>';
});