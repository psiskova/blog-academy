@extends('layouts.master')

@section('content')
    <div class="container-fluid row text-justify container_content">
        <div class="col-md-7 right-column left_col">
            @yield('left')
        </div>
        <div class="col-md-3 col-md-offset-1 right_col">
            @yield('right')
        </div>
    </div>
@stop



