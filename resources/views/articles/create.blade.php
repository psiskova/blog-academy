@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/summernote.min.js') !!}
    {!! HTML::script('js/bootstrap-tagsinput.min.js') !!}
    {!! HTML::script('js/article.create.js') !!}
@stop


@section('left')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('css/summernote.css') !!}
    {!! HTML::style('css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('css/bootstrap-tagsinput-typeahead.css') !!}

    <div class="row">
        {!! Form::open(['url' => action('ArticleController@postCreate'), 'method' => 'post', 'class'=>'form-horizontal clearfix']) !!}
        {!! Form::hidden('id', isset($article) ? $article->slug : '') !!}
        <div class="form-group">
            <label for="title" class="col-md-2 control-label">Nadpis</label>

            <div class="col-md-10">
                <input type="text" id="title" name="title" class="form-control" value="{{ $article->title or ''}}">
            </div>
        </div>
        <div class="form-group">
            <label for="tagy" class="col-md-2 control-label">Tagy</label>

            <div class="col-md-10">
                <input type="text" id="tagy" class="form-control" data-role="tagsinput" value="{!! $tags or '' !!}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Text</label>

            <div class="col-md-10">
                <textarea id="area" name="text">{{ $article->text or ''}}</textarea>

                <div id="summernote">Hello Summernote</div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 col-md-offset-5">
                {!! Form::submit('Uložiť', ['class'=>'btn btn-default', 'name' => 'action']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::submit('Odoslať', ['class'=>'btn btn-default', 'name' => 'action']) !!}
                {{--<button type="button" class="btn btn-default" id="send">Odoslať</button>--}}
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-default" id="trash">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default" id="insight">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                </button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('right')
    @include('articles.rightmenu')
@stop