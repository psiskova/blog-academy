@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/summernote.min.js') !!}
    {!! HTML::script('js/bootstrap-tagsinput.min.js') !!}
    {!! HTML::script('js/star-rating.min.js') !!}
    {!! HTML::script('js/article.rate.js') !!}
@stop

@section('left')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('css/summernote.css') !!}
    {!! HTML::style('css/star-rating.min.css') !!}


    <div class="row">

        <h3>{{ $article->title }}</h3>
        <span class="article-info">
            {!! link_to_action('UserController@getProfile', $article->user->fullname , ['user_id' => $article->user->slug]) !!}
            <div class="divider"></div>
            {{$article->updated_at}}
            <div class="divider"></div>{{ $article->average_rating }}
        </span><br>
        {!! HTML::tags($article) !!}

        <p>{!! $article->text !!}</p>

        <h1> Ohodnotiť článok </h1>
        <!-- Grading controller -->
        {!! Form::open(['url' => action('ArticleController@postRate'), 'method' => 'post', 'class'=>'form-horizontal clearfix']) !!}
        {!! Form::hidden('id', $article->id) !!}
        <div class="form-group">
            <label for="grades">Hodnotenie:</label>
            <input id="input-id" type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                   data-show-Caption="false" data-show-Clear="false">
        </div>
        <div class="form-group">
            <label for="summernote" class="control-label">Text hodnotenia</label>

            <div>
                <br>

                <div id="summernote"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 col-md-push-10">
                {!! Form::submit('Hodnotiť', ['class'=>'btn btn-default', 'name' => 'action']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => $article->user])
@stop