@extends('layouts.9-3')

@section('left')
    <div class="row">
        @foreach($courses as $course)
            {{ $course->teacher->fullname }}
            {{ $course->name }}
        @endforeach
    </div>
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat profil</p>
    </div>
@stop