@extends(isset($course) ? 'layouts.master' : 'layouts.9-3')

@if(!isset($course))
@section('scripts')
    <script src="{{ elixir('js/courses.teacher.overview.js') }}"></script>
@stop

@section('content')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="container-fluid row text-justify container_content">
        <div class="col-md-3 col-md-push-7 col-md-offset-1 right_col">
            <div class="right_col_profile right_col_profile_top mobile_profile">
                <div class="pencil"></div>
                <div class="text-center">
                    <p>Správa predmetu</p>
                    <p>{!! link_to_action('TaskController@getCreate', 'Vytvoriť zadanie') !!}</p>
                    <p>{!! link_to_action('CourseController@getCreate', 'Pridať predmet') !!}</p>
                    <div class="hidden-sm hidden-xs">
                        <div class = "separator"></div>
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
                            <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty" . ($count ? ('('.$count.')') : '')) !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-pull-4 right-column left_col">
            <div class="row">
                <h1>Správa predmetu</h1>
                <table class="center_elements table_courses_view table-striped col-xs-12">
                    @foreach($participants as $participant)
                        <tr class="row">
                            <td class="border_right col-xs-6">{{ $participant->user->fullname }}</td>
                            @if($participant->state == \App\Models\Participant::ACCEPTED)
                                <td class="col-xs-6 text-center table_courses_view_td">
                                    Prihlásený
                                </td>
                            @endif
                            @if($participant->state == \App\Models\Participant::REJECTED)
                                <td class="col-xs-6 text-center table_courses_view_td">
                                    Odmietnutý
                                </td>
                            @endif
                            @if($participant->state == \App\Models\Participant::PENDING)
                                <td class="col-xs-6 text-center table_courses_view_button">
                                    <button type="button" class="btn btn-default" data-user="{{ $participant->user_id }}"
                                            data-value="{{  \App\Models\Participant::ACCEPTED }}">
                                        Potvrdiť
                                    </button>
                                    <button type="button" class="btn btn-default" data-user="{{ $participant->user_id }}"
                                            data-value="{{  \App\Models\Participant::REJECTED }}">
                                        Odmietnuť
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop

@else
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-10 col-md-2 text-center">
                <span class="ion-ios-arrow-thin-up" style="font-size: 32px"></span><br>
                Nie je zvolený predmet
            </div>
        </div>
    </div>
@stop
@endif

