@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/star-rating.min.js') !!}
@stop

@section('left')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="row">
        <h1>Publikované články</h1>
        @forelse($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                    <span class="article-info">{{ $article->user->fullname }}
                        <div class="divider"></div>
                        {{ $article->updated_at }}
                        <div class="divider"></div>
                        <input id="input-id-avg" type="number" class="rating" min=0 max=5 step=1 readonly="true"  data-size="xs"
                                 data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}"></span><br>
                {!! HTML::tags($article) !!}
                {{ str_limit(strip_tags($article->text), 200) }}
            </div>
        @empty
            <p>Nemáte žiadne publikované články</p>
        @endforelse
    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => Auth::user()])
@stop