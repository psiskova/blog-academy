@extends('layouts.9-3')

@section('scripts')
    <script src="{{ elixir('js/star-rating.min.js') }}"></script>
@stop

@section('left')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="row">
        <h1>Publikované články</h1>
        @forelse($articles as $article)
            <div class="articles_list">
                <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                    <span class="article-info"><p>{{ $article->user->fullname }}</p>
                        <div class="divider"></div>
                        {{ $article->updated_at }}
                        <div class="divider"></div>
                        <input id="input-id-avg" type="number" class="rating" min=0 max=5 step=1 readonly="true"  data-size="xs"
                                 data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}"></span>
                <p>{!! HTML::tags($article) !!}</p>
                {{ str_limit(strip_tags($article->text), 200) }}
            </div>
        @empty
            <p>Nemáte žiadne publikované články</p>
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
                <p>Publikované články {{ ($count ? ('('.$count.')') : '')}}</p>
                {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
                <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
                @if(Auth::user()->hasRole(\App\Models\User::STUDENT_ROLE))
                    <p>{!! link_to_action('CourseController@getOverview', "Zapísať sa na predmet ") !!}</p>
                @elseif (Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                    <p>{!! link_to_action('CourseController@getOverview', "Správa predmetov") !!}</p>
                @else
                    <p>{!! link_to_action('UserController@getManagement', "Správa používateľov") !!}</p>
                @endif
            @endif
        </div>
    </div>
@stop