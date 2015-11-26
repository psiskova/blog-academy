@extends('layouts.9-3')

@section('left')
    <div class="row">
        <h1>Publikované články</h1>
        @forelse($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
            </div>
        @empty
            <p>Nemáte žiadne publikované články</p>
        @endforelse
    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => Auth::user()])
@stop