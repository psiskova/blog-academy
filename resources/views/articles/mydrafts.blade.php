@extends('layouts.9-3')

@section('left')
    <div class="row">
        <h1>Koncepty</h1>
        @forelse($drafts as $draft)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getDraft', $draft->title, ['id' => $draft->slug]) !!}</h3>
            </div>
        @empty
            <p>Nemáte žiadne koncepty článkov</p>
        @endforelse
    </div>
@stop

@section('right')
    <div class="right_col_profile right_col_profile_bottom mobile_profile">
        <div class="pencil"></div>
        <div class="text-center">
            {!! HTML::profilePicture(Auth::user(), 120, 120) !!}
            <h4>{{ Auth::user()->fullname }}</h4>
            <p>{{ Auth::user()->email }}</p>
            @if(Auth::check())
                <p>{!! link_to_action('UserController@getUpdateProfile', 'Upraviť profil', [])!!}</p>
                <div class = "separator"></div>
                <p>{!! link_to_action('ArticleController@getCreate', "Nový článok") !!}</p>
                {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->published()->count() /*--}}
                <p>{!! link_to_action('ArticleController@getMyArticles', "Publikované články " . ($count ? ('('.$count.')') : '')) !!}</p>
                {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
                <p>Koncepty</p>
                @if(Auth::user()->hasRole(\App\Models\User::STUDENT_ROLE))
                    <p>{!! link_to_action('CourseController@getOverview', "Zapísať sa na predmet") !!}</p>
                @elseif (Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                    <p>{!! link_to_action('CourseController@getOverview', "Správa predmetov") !!}</p>
                @else
                    <p>{!! link_to_action('UserController@getManagement', "Správa používateľov") !!}</p>
                @endif
            @endif
        </div>
    </div>
@stop