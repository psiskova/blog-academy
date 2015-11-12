@extends('layouts.9-3')

@section('left')
    <p>*TODO - asi všetky vlastné články</p>
    <div class="row">
        @foreach($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                {{ $article->updated_at }}<br>
                {{ str_limit($article->text, 200) }}
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