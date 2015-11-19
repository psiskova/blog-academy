@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/summernote.min.js') !!}
    {!! HTML::script('js/bootstrap-tagsinput.min.js') !!}
    {!! HTML::script('js/article.create.js') !!}
@stop


@section('left')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('css/summernote.css') !!}


    <div class="row">

        <h3>{!! $article->title !!}</h3>
        <span class="article-info">{{ $article->user->fullname }}, {{ $article->updated_at }}</span><br>
        <span class="article-info">{!! HTML::tags($article) !!}</span><br>
        <p>{!! $article->text !!}</p>

        <h1> Ohodnotiť článok </h1>
        <!-- Grading controller -->
        {!! Form::open(['url' => action('ArticleController@postRate'), 'method' => 'post', 'class'=>'form-horizontal clearfix']) !!}
        {!! Form::hidden('id', isset($article) ? $article->slug : '') !!}
        <div class="form-group">
            <label for="grades">Hodnotenie:</label>
            <select class="form-control course-option" id="grades">
                <option value="1">1/5 <i class="icon ion-star"></i> </option>
                <option value="2">
                    2/5 <i class="icon ion-star"></i><i class="icon ion-star"></i>
                </option>
                <option value="3">
                    3/5 <i class="icon ion-star"></i><i class="icon ion-star"></i><i class="icon ion-star"></i>
                </option>
                <option value="4">
                    4/5 <i class="icon ion-star"></i><i class="icon ion-star"></i><i class="icon ion-star"></i><i class="icon ion-star"></i>
                </option>
                <option value="5">
                    5/5 <i class="icon ion-star"></i><i class="icon ion-star"></i><i class="icon ion-star"></i><i class="icon ion-star"></i><i class="icon ion-star"></i>
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="summernote" class="col-md-2 control-label">Text hodnotenia</label>

            <div class="col-md-10">
                <textarea id="area" name="text"></textarea>

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
    @include('articles.rightmenu')
@stop