@extends('layouts.9-3')

@section('left')
    @forelse($drafts as $draft)
        <div class="articles_list">
            <h3>{!! link_to_action('ArticleController@getDraft', $draft->title, ['id' => $draft->slug]) !!}</h3>
        </div>
    @empty
        <p>Nemáte žiadne koncepty článkov</p>
    @endforelse
@stop

@section('right')
    @include('articles.rightmenu')
@stop