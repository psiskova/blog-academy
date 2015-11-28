<?php

HTML::macro('tags', function ($article) {
    $collection = collect(array_flatten($article->tags()->get(['name'])->toArray()))->map(function ($tag) {
        return '<span class="tag label label-info"><a href="' . url('/?search=' . $tag) . '">' . $tag . '</a></span>';
    })->all();

    $result = implode(' ', $collection);
    if ($result != '') {
        $result = '<span class="article-info" style="display: inline-block">' . $result . '</span><br>';
    }
    return $result;
});