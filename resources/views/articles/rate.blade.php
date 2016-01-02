@extends('layouts.9-3')

@section('header')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"
          xmlns="http://www.w3.org/1999/html">
    {!! HTML::style('css/summernote.css') !!}
    {!! HTML::style('css/star-rating.min.css') !!}
@stop

@section('scripts')
    <script src="{{ elixir('js/summernote.min.js') }}"></script>
    <script src="{{ elixir('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ elixir('js/star-rating.min.js') }}"></script>
    <script src="{{ elixir('js/article.rate.js') }}"></script>
@stop

@section('left')
    <div class="row">
        <article>
            <header>
                <h3>{{ $article->title }}</h3>
                <div class="article-info">
                    <p>{!! link_to_action('UserController@getProfile', $article->user->fullname , ['user_id' => $article->user->slug]) !!}</p>
                    <div class="divider"></div>
                    <date>{{$article->updated_at}}</date>
                    <div class="divider hidden-sm hidden-xs"></div>
                    <div class="hidden-sm hidden-xs">
                        <input type="number" class="rating" min=0 max=5 step=1 readonly data-size="xs"
                               data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}">
                    </div>
                </div>
                <div class="hidden-md hidden-lg">
                    <input type="number" class="rating" min=0 max=5 step=1 readonly
                           data-size="xs"
                           data-show-Caption="false" data-show-Clear="false"
                           value="{{ round($article->average_rating) }}">
                </div>
                <p>{!! HTML::tags($article) !!}</p>
            </header>

            <p>{!! $article->text !!}</p>
        </article>

        <h1> Ohodnotiť článok </h1>
        <!-- Grading controller -->
        {!! Form::open(['url' => action('ArticleController@postRate'), 'method' => 'post', 'class'=>'form-horizontal clearfix']) !!}
        {!! Form::hidden('article_id', $article->id) !!}
        <textarea name="text" id="text" style="display: none"></textarea>
        <div class="form-group lr-margin-clear-fix">
            <label for="grades">Hodnotenie:</label>
            <input id="input-id" type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                   data-show-Caption="false" data-show-Clear="false" name="rating" value="{!! old('rating') !!}">
        </div>
        <div class="form-group lr-margin-clear-fix">
            <label for="summernote" class="control-label">Text hodnotenia</label>

            <div>
                <div id="summernote">{!! old('text') !!}</div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                {!! Form::submit('Hodnotiť', ['class'=>'btn btn-primary', 'name' => 'action']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => $article->user])
@stop