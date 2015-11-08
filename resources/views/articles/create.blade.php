@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/summernote.min.js') !!}
    {!! HTML::script('js/article.create.js') !!}
@stop


@section('left')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('css/summernote.css') !!}

    <div class="row">
        <textarea id="area"></textarea>

        <div id="summernote">Hello Summernote</div>
    </div>
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat profil autora</p>
    </div>
@stop