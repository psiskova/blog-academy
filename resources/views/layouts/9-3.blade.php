@extends('layouts.master')

@section('content')
    <div class="container-fluid row container_content">
        <main class="col-md-7 right-column left_col">
            @yield('left')
        </main>
        <aside class="col-md-3 col-md-offset-1 right_col">
            @yield('right')
        </aside>
    </div>
@stop