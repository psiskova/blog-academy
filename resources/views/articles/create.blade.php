@extends('layouts.9-3')

@section('scripts')
    <script src="{{ elixir('js/summernote.min.js') }}"></script>
    <script src="{{ elixir('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ elixir('js/article.create.js') }}"></script>
@stop


@section('left')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('css/summernote.css') !!}
    {!! HTML::style('css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('css/bootstrap-tagsinput-typeahead.css') !!}

    <div class="row addarticle-form-row">
        <h1> Pridať článok </h1>
        {!! Form::open(['url' => action('ArticleController@postCreate'), 'method' => 'post', 'class'=>'form-horizontal clearfix']) !!}
        {!! Form::hidden('id', isset($article) ? $article->slug : '') !!}
        <div class="form-group">
            <label for="title" class="col-md-2 control-label">Nadpis</label>

            <div class="col-md-10">
                <input type="text" id="title" name="title" class="form-control" value="{{ $article->title or ''}}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="task_id" class="col-md-2 control-label">Zadanie</label>

            <div class="col-md-10">
                <select name="task_id" id="task_id" class="form-control">
                    <option value="" {{ (isset($article) && !$article->task) ? 'selected' : ''}}>Bez zadania</option>
                    @if(Auth::user()->course)
                        @foreach(Auth::user()->course->tasks as $task)
                            <option value="{{ $task->id }}" {{ (isset($article) && $article->task && $article->task->id == $task->id) ? 'selected' : ''}}>{{ $task->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="tags" class="col-md-2 control-label">Tagy</label>

            <div class="col-md-10">
                <input type="text" id="tags" name="tags" class="form-control" data-trimValue="true" data-role="tagsinput" value="{!! $tags or '' !!}">
            </div>
        </div>
        <div class="form-group">
            <label for="summernote" class="col-md-2 control-label">Text</label>

            <div class="col-md-10">
                <textarea id="area" name="text">{{ $article->text or ''}}</textarea>

                <div id="summernote"></div>
            </div>
        </div>
        <div class="form-group addarticle-form-group-btns">
            <div class="col-xs-11 col-md-offset-2" style="margin-top:-20px">
                {!! Form::submit('Uložiť', ['class'=>'btn btn-primary', 'name' => 'action']) !!}
                {!! Form::submit('Odoslať', ['class'=>'btn btn-primary', 'name' => 'action']) !!}
                <button type="button" class="btn btn-primary" id="trash">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>

                <button type="button" class="btn btn-primary" id="insight">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                </button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => Auth::user()])
@stop