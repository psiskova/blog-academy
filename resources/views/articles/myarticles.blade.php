@extends('layouts.9-3')

@section('left')
    @forelse($articles as $article)
        <div class="articles_list">
            <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
        </div>
    @empty
        <p>Nemáte žiadne publikované články</p>
    @endforelse
@stop

@section('right')
    @include('articles.rightmenu')
@stop