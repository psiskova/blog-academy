@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/star-rating.min.js') !!}
@stop

@section('left')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="row">
        @foreach($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                <span class="article-info">{!! link_to_action('UserController@getProfile', $article->user->fullname , ['user_id' => $article->user->slug]) !!}
                    | {{$article->updated_at}} |
                    <input id="input-id-avg" type="number" class="rating" min=0 max=5 step=1 readonly="true"  data-size="xs"
                           data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}">
                </span><br>
                {!! HTML::tags($article) !!}
                {{ str_limit(strip_tags($article->text), 200) }}
            </div>
        @endforeach
        <div class="text-center fix1">
            @if($search)
                {!! $articles->appends(['search' => $search])->render() !!}
            @else
                {!! $articles->render() !!}
            @endif
        </div>
    </div>
@stop

@section('right')
    <div class="side_tabs side_tabs_top hidden-sm hidden-xs">
        <ul class="nav nav-tabs side_nav">
            <li class="active"><a data-toggle="tab" href="#tab1">Kecálek</a></li>
            <li><a data-toggle="tab" href="#tab2">Hviezda</a></li>
        </ul>
        <div class="tab-content ">
            <div id="tab1" class="tab-pane fade in active">
                {{--*/ $i = 1 /*--}}
                @foreach($topUsers as $topUser)
                    <div class="top_user_{{ $i }}">
                        {{--*/ $i++ /*--}}
                        {!! HTML::profilePicture($topUser->user, 120, 120) !!}
                        <span class="top-user-name">{!! link_to_action('UserController@getProfile', $topUser->user->fullname, ['user_id' => $topUser->user->slug])!!}</span><span class="top-user-count">{{ trans_choice('articles.count', $topUser->user->countPublishedArticles(), ['count' => $topUser->user->countPublishedArticles()]) }}</span>
                    </div><br>
                @endforeach
            </div>
            <div id="tab2" class="tab-pane fade">
                {{--*/ $i = 1 /*--}}
                @foreach($bestUsers as $bestUser)
                    <div class="top_user_{{ $i }}">
                        {{--*/ $i++ /*--}}
                        {!! HTML::profilePicture($bestUser, 120, 120) !!}
                        <span class="top-user-name">{{ $bestUser->fullname }}</span>
                        <span class="top-user-count">{{ $bestUser->average_rating }}</span>
                    </div><br>
                @endforeach
            </div>
        </div>
    </div>
    <div class="push"></div>
@stop