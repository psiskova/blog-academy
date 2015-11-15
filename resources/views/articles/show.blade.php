@extends('layouts.9-3')

@section('left')
    <div class="row">
        <h3>{!! $article->title !!}</h3>
        <span class="article-info">
            Napísal {{ $article->user->getFullnameAttribute() }} ,{{ $article->updated_at }}
        </span>
        <br>
        <p>{!! $article->text !!}</p>
    </div>
    <div class="row">
        <h3>Diskusia k článku</h3>
        <div class="discussion-main col-xs-12">
            <div class="discussion-commentary">
                <div class="col-xs-3">
                    <img class="discussion-profile col-xs-3" src="http://blogdailyherald.com/wp-content/uploads/2014/10/wallpaper-for-facebook-profile-photo.jpg">
                </div>
                <div class="col-xs-9 discussion-right">
                    <span class="discussion-author-info">Discussion->Author name</span>
                    <p>Discussion text...</p>
                </div>
            </div>
        </div>
    </div>
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