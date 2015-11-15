@extends('layouts.9-3')

@section('left')
    <div class="row">
        @foreach($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                {{ $article->user->fullname }}, {{ $article->updated_at }}<br>
                {{ str_limit($article->text, 200) }}
            </div>
        @endforeach
        {!! $articles->render() !!}
    </div>
@stop

@section('right')
    <div class="side_tabs side_tabs_top">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Tab 1</a></li>
            <li><a data-toggle="tab" href="#tab2">Tab 2</a></li>
        </ul>
        <div class="tab-content ">
            <div id="tab1" class="tab-pane fade in active">
                <h3>Tab 1</h3>

                <p>3 užívatelia s najvyšším počtom článkov</p>
                @foreach($topUsers as $topUser)
                    <div class="top-user">
                        <!-- <img src="..." alt=" top user fullname "> -->
                        <span class="top-user-name">{{ $topUser->user->fullname }}</span>
                        <span class="top-user-count">{{ trans_choice('articles.count', $topUser->user->countPublishedArticles(), ['count' => $topUser->user->countPublishedArticles()]) }}</span>
                    </div><br>
                @endforeach
            </div>
            <div id="tab2" class="tab-pane fade">
                <h3>Tab 2</h3>

                <p>3 užívatelia s najlepším hodnotením</p>
            </div>
        </div>
    </div>
@stop