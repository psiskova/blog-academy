@extends('layouts.9-3')

@section('left')
    <div class="row">
        <h3>{!! $article->title !!}</h3>
        {{ $article->updated_at->format('M j, Y') }}<br>
        <p>{!! $article->text !!}</p>
    </div>

    <p>DISKUSIA K ČLÁNKU</p>
@stop

@section('right')
    <div class="row">
        {{--<img src="{{ url($user->image) }}">--}}
        USER IMAGE
        <h4>{{ $article->user->fullname }}</h4>
        {{ $article->user->email }}<br>
        {{--{!! link_to_action('**TODO presmerovanie', 'publikované články('.**TODO pocet.')',['user_id' => $article->slug]) !!} --}}
        **TODO publikované články(počet)
    </div>
@stop