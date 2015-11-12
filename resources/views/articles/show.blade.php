@extends('layouts.9-3')

@section('left')
    <div class="row">
        <h3>{!! $article->title !!}</h3>
        {{ $article->updated_at }}<br>
        <p>{!! $article->text !!}</p>
    </div>
    <p>DISKUSIA K ČLÁNKU</p>
@stop

@section('right')
    <div class="row">
        {{--<img src="{{ url($user->image) }}">--}}
        USER IMAGE
        <h4>{{ $article->user->fullname }}</h4>
        <p>{{ $article->user->email }}</p>
        <p>{!! link_to_action('UserController@getProfile', 'publikované články ('.$article->user->articles()->published()->count().')', ['user_id' => $article->user->slug]) !!}</p>

        --> po kliknutí zobraziť user profile

        {{--{!! link_to_action('**TODO presmerovanie', 'publikované články('.**TODO pocet.')',['user_id' => $article->slug]) !!} --}}
        {{--@foreach($article->user->articles as $art)
            <p>{!! link_to_action('ArticleController@getShow', 'b' , ['user_id' => $art->slug]) !!}</p>
        @endforeach--}}
    </div>
@stop