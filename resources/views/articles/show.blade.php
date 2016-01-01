@extends('layouts.9-3')

@section('header')
    {!! HTML::style('css/star-rating.min.css') !!}
@stop

@section('scripts')
    <script src="{{ elixir('js/star-rating.min.js') }}"></script>
    <script src="{{ elixir('js/article.show.js') }}"></script>
@stop

@section('left')
    <article class="row">
        <header>
            <h2>{{ $article->title }}</h2>
            <div class="top_separator"></div>
            <div class="article-info">
                <p>{!! link_to_action('UserController@getProfile', $article->user->fullname, ['user_id' => $article->user->slug])!!}</p>
                <div class="divider"></div>{{ $article->updated_at }}
                <div class="divider hidden-xs hidden-sm"></div>
                <div class="hidden-xs hidden-sm">
                    <input type="number" class="rating" min=0 max=5 step=1 readonly data-size="xs"
                           data-show-Caption="false" data-show-Clear="false"
                           value="{{ round($article->average_rating) }}">
                </div>
                @if(Auth::check() && (Auth::user()->hasRole(\App\Models\User::ADMIN_ROLE) || Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE)))
                    <div class="divider hidden-xs hidden-sm"></div>
                    <div class="hidden-xs hidden-sm">
                        <p>
                            <a href="{{ action('ArticleController@getDelete', ['id' => $article->id]) }}"
                               class="red">Zmazať nevhodný článok</a>
                        </p>
                    </div>
                @endif
            </div>
            <div class="hidden-md hidden-lg">
                <input type="number" class="rating" min=0 max=5 step=1 readonly data-size="xs"
                       data-show-Caption="false" data-show-Clear="false"
                       value="{{ round($article->average_rating) }}">
                @if(Auth::check() && (Auth::user()->hasRole(\App\Models\User::ADMIN_ROLE) || Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE)))
                    <p>
                        <a href="{{ action('ArticleController@getDelete', ['id' => $article->id]) }}" class="red">
                            Zmazať nevhodný článok</a>
                    </p>
                @endif
            </div>

            <p class="tagy">{!! HTML::tags($article) !!}</p>
        </header>

        {!! $article->text !!}
    </article>
    <div class="row">
        @if(Auth::check())
            @if($article->user->id == Auth::id())
                @if($hodnotenie)
                    <h3>Hodnotenie</h3>
                    <div class="top_separator"></div>
                    <input type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                           data-show-Caption="false" data-show-Clear="false" data-disabled="true"
                           value="{{ $hodnotenie->rating }}">
                    <p>{!!  $hodnotenie->text !!}</p>
                @endif
            @endif
            @if($article->user->id != Auth::id())
                <input id="rate" type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                       data-show-Caption="false" data-show-Clear="false"
                       data-disabled="{{ $rating ? 'true' : 'false' }}"
                       value="{{ $rating ? $rating->rating : '' }}"
                       data-article_id="{{ $article->id }}">
            @endif
        @endif

        @if(Auth::check() or $discussions->count()>0)
            <h3>Diskusia k článku</h3>
            <div class="top_separator"></div>
        @endif

        @if(Auth::check())
            {!! Form::open(['url' => action('DiscussionController@postAddDiscussion'), 'method'=>'post']) !!}
            {!! Form::hidden('article_id', $article->id) !!}
            <div class="form-group">
                <label for="comment-area">Komentár:</label>
                <textarea class="form-control" rows="4" id="comment-area" name="text"></textarea>
                {!! Form::submit('Pridať komentár', ['class'=>'btn btn-ba-style', 'name' => 'action']) !!}
            </div>
            {!! Form::close() !!}
        @endif

        @forelse($discussions as $discussion)
            {!! HTML::discussion($discussion, $article->id) !!}
        @empty
            @if(Auth::check()) Žiadny diskusný príspevok. Buďte prvý!@endif
        @endforelse
    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => $article->user])
@stop