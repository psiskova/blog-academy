@extends('layouts.9-3')

@section('left')
    <div class="row">
        <p>tu budeme vypisovat cely clanok a diskusiu</p>

        <p>{!! $article->text !!}</p>
    </div>
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat profil autora</p>

        <p>{{ $article->user->fullname }}</p>
    </div>
@stop