@extends('layouts.master')

@section('content')
    <div class="container-fluid row text-justify">
        <div class="col-md-8 col-md-push-2">
            <div class="col-md-9 left_col">
                @yield('left')
            </div>
            <div class="col-md-3 hidden-sm hidden-xs right_col">
                @yield('right')
            </div>
        </div>
    </div>
@stop



