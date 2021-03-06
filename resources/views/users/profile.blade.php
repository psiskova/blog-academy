@extends('layouts.master')

@section('header')
    {!! HTML::style('css/star-rating.min.css') !!}
@stop

@section('scripts')
    <script src="{{ elixir('js/star-rating.min.js') }}"></script>
@stop

@section('content')
    <div class="container-fluid row container_content">
        <div class="col-md-3 col-md-push-7 col-md-offset-1 right_col">
            <div id="movable-bounding" class="right_col_profile right_col_profile_top mobile_profile">
                <div class="pencil"></div>
                <div id="movable-profile" class="text-center">
                    {!! HTML::profilePicture($user, 120, 120) !!}
                    <h4>{{ $user->fullname }}</h4>

                    <p>{{ $user->email }}</p>
                    @if(Auth::check() && $user->id == Auth::id())
                        <p>{!! link_to_action('UserController@getUpdateProfile', 'Upraviť profil', [])!!}</p>
                        <div class="separator"></div>
                        <p>{!! link_to_action('ArticleController@getCreate', "Nový článok") !!}</p>
                        {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->published()->count() /*--}}
                        <p>Publikované články {{ ($count ? ('('.$count.')') : '')}}</p>
                        {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
                        <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
                        @if(Auth::user()->hasRole(\App\Models\User::STUDENT_ROLE))
                            <p>{!! link_to_action('CourseController@getOverview', "Zapísať sa na predmet") !!}</p>
                        @elseif (Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                            <p>{!! link_to_action('CourseController@getOverview', "Správa predmetov") !!}</p>
                        @else
                            <p>{!! link_to_action('UserController@getManagement', "Správa používateľských rolí") !!}</p>
                            <p>{!! link_to_action('UserController@getBlock', "Blokovanie používateľov") !!}</p>
                        @endif
                    @else
                        <p>Publikované články ({{$user->countPublishedArticles()}})</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-pull-4 right-column left_col">
            <div class="row">
                <h1>Publikované články</h1>
                @forelse($articles as $article)
                    <div class="articles_list">
                        <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                        <div class="article-info">
                            <p>{{ $article->user->fullname }}</p>
                            <div class="divider"></div>
                            {{ $article->updated_at }}
                            <div class="divider hidden-sm hidden-xs"></div>
                            <div class="hidden-sm hidden-xs">
                                <input type="number" class="rating" min=0 max=5 step=1 readonly  data-size="xs"
                                       data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}">
                            </div>
                        </div>
                        <div class="hidden-md hidden-lg">
                            <input type="number" class="rating" min=0 max=5 step=1 readonly
                                   data-size="xs"
                                   data-show-Caption="false" data-show-Clear="false"
                                   value="{{ round($article->average_rating) }}">
                        </div>
                        <p class="tagy">{!! HTML::tags($article) !!}</p>
                        {{ str_limit(strip_tags($article->text), 200) }}
                    </div>
                @empty
                    <p>Nemáte žiadne publikované články</p>
                @endforelse
            </div>
        </div>
    </div>
@stop