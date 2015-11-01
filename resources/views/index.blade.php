@extends('layouts.9-3')

@section('left')
    <div class="row">
        <p>tu budeme vypisovat clanky</p>
        @foreach($articles as $article)
            {!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}<br>
        @endforeach
    </div>


    {!! $articles->render() !!}
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat bocne menu/profil</p>
    </div>
@stop