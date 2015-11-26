@extends('layouts.master')

@section('content')
    <div class="container-fluid row text-justify">
        <div class="col-md-7 right-column">
                @yield('left')
            </div>
            <div class="col-md-3 col-md-offset-1 right_col">
                @yield('right')
            </div>
        </div>
    </div>
@stop



