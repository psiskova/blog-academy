@extends('layouts.master')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-8 col-md-push-2">
            <div class="container-fluid row">
                <div class="col-md-9">
                    @yield('left')
                </div>
                <div class="col-md-3 hidden-sm hidden-xs">
                    @yield('right')
                </div>
            </div>
        </div>
    </div>
@stop