@extends('layouts.9-3')

@section('left')
    {{--TODO: asi všetky vlastné články--}}
    <div class="row">
        <h1>Publikované články</h1>
        @foreach($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                <span class="article-info">{{ $article->user->fullname }} | {{ $article->updated_at }}</span><br>
                <span class="article-info">{!! HTML::tags($article) !!}</span><br>
                {{ str_limit(strip_tags($article->text), 200) }}
            </div>
        @endforeach
    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => $user])
@stop