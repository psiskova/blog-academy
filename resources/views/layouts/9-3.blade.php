@extends('layouts.master')

@section('content')

    <div class="row">
        
        <div class="col-md-8 col-md-push-2">
    <div class="row">
        <div class="col-md-9">
            @yield('left')
        </div>
        <div class="col-md-3">
            @yield('right')
        </div>
    </div>
    </div>
    </div>
@stop