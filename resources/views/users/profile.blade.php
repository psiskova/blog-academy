@extends('layouts.master')

@section('scripts')
    {!! HTML::script('js/star-rating.min.js') !!}
@stop

@section('content')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="container-fluid row text-justify container_content">
        <div class="col-sm-3 col-sm-push-7  col-md-3 col-md-offset-1 right_col">
            <div class="right_col_profile right_col_profile_top mobile_profile">
                <div class="pencil"></div>
                <div class="text-center">
                    {!! HTML::profilePicture($user, 120, 120) !!}
                    <h4>{{ $user->fullname }}</h4>

                    <p>{{ $user->email }}</p>
                    @if(Auth::check() && $user->id == Auth::id())
                        <p>{!! link_to_action('UserController@getUpdateProfile', 'Upraviť profil', [])!!}</p>
                        <p>{!! link_to_action('ArticleController@getCreate', "Nový článok") !!}</p>
                        {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->published()->count() /*--}}
                        <p>{!! link_to_action('ArticleController@getMyArticles', "Publikované články " . ($count ? ('('.$count.')') : '')) !!}</p>
                        {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
                        <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
                        <p>{!! link_to_action('CourseController@getOverview', "Zapísať sa na predmet ") !!}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-7 col-sm-pull-4 col-md-7 right-column left_col">
            {{--TODO: asi všetky vlastné články--}}
            <div class="row">
                <h1>Publikované články</h1>
                @forelse($articles as $article)
                    <div class="articles_list">
                        <h3>{!! link_to_action('ArticleController@getShow', $article->title, ['id' => $article->slug]) !!}</h3>
                        <span class="article-info">{{ $article->user->fullname }} | {{ $article->updated_at }}
                            | <input id="input-id-avg" type="number" class="rating" min=0 max=5 step=1 readonly="true"  data-size="xs"
                                     data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}"></span><br>
                        {!! HTML::tags($article) !!}
                        {{ str_limit(strip_tags($article->text), 200) }}
                    </div>
                @empty
                    <p>Nemáte žiadne publikované články</p>
                @endforelse
            </div>
        </div>
    </div>
@stop