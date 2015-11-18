@extends('layouts.9-3')

@section('left')
    {{--TODO: asi všetky vlastné články--}}
    <div class="row">
    <h1>Publikované články</h1>
        @foreach($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                <span class="article-info">{{ $article->user->fullname }}, {{ $article->updated_at }}</span><br>
                <span class="article-info">{!! HTML::tags($article) !!}</span><br>
                {{ str_limit(strip_tags($article->text), 200) }}
            </div>
        @endforeach
    </div>
@stop

@section('right')
    <div class="row">
        {{--<img src="{{ url($user->image) }}">--}}
        USER IMAGE
        <h4>{{ $user->fullname }}</h4>

        <p>{{ $user->email }}</p>
        **TODO - aké možnosti bude mať (upraviť profil ???)
    </div>
@stop