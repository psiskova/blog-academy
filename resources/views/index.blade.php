@extends('layouts.9-3')

@section('left')
    <div class="row">
        @foreach($articles as $article)
            <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
            {{ $article->user->fullname }}, {{ $article->updated_at }}<br>
            {{ str_limit($article->text, 200) }}
        @endforeach
    </div>

    {!! $articles->render() !!}
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat bocne menu/profil</p>
    </div>
@stop