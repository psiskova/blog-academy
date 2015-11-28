@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/star-rating.min.js') !!}
    {!! HTML::script('js/article.show.js') !!}
@stop

@section('left')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="row">
        <h3>{{ $article->title }}</h3>
        <span class="article-info">{!! link_to_action('UserController@getProfile', $article->user->fullname, ['user_id' => $article->user->slug])!!}
            | {{ $article->updated_at }} |
            <input id="input-id-avg" type="number" class="rating" min=0 max=5 step=1 readonly="true" data-size="xs"
                   data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}">
            @if(Auth::check() && (Auth::user()->hasRole(\App\Models\User::ADMIN_ROLE) || Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE)))
                |  <a href="{{ action('ArticleController@getDelete', ['id' => $article->id]) }}" style="color:red">Zmazať
                    nevhodný článok</a>
            @endif
        </span><br>
        {!! HTML::tags($article) !!}

        <p>{!! $article->text !!}</p>
    </div>
    <div class="row">
        @if(Auth::check())
            <input id="input-id" type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                   data-show-Caption="false" data-show-Clear="false">
        @endif

        @if(Auth::check() or $discussions->count()>0)
            <h3>Diskusia k článku</h3>
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