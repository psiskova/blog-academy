@extends('layouts.9-3')

@section('left')
    <div class="row">
        @foreach($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                <span class="article-info">{{ $article->user->fullname }}, {{ $article->updated_at }}</span><br>
                <span class="article-info">{!! HTML::tags($article) !!}</span><br>
                {{ str_limit(strip_tags($article->text), 200) }}
            </div>
        @endforeach
        <div class="text-center fix1">
            @if($search)
                {!! $articles->appends(['search'=>$search])->render() !!}
            @else
                {!! $articles->render() !!}
            @endif
        </div>
    </div>
@stop

@section('right')
    <div class="side_tabs side_tabs_top">
        <ul class="nav nav-tabs side_nav">
            <li class="active"><a data-toggle="tab" href="#tab1">Kecálek</a></li>
            <li><a data-toggle="tab" href="#tab2">Hviezda</a></li>
        </ul>
        <div class="tab-content ">
            <div id="tab1" class="tab-pane fade in active">
                <h3></h3>
                {{--*/ $i = 1 /*--}}
                @foreach($topUsers as $topUser)
                    @if($i == 1)
                        <div class="top_user">
                            @elseif ($i == 2)
                                <div class="top_user_2">
                                    @else
                                        <div class="top_user_3">
                                            @endif
                                            {{--*/ $i++ /*--}}
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