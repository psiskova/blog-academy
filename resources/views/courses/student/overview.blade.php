@extends('layouts.9-3')

@section('scripts')
    <script src="{{ elixir('js/courses.student.overview.js') }}"></script>
@stop

@section('left')
    <div class="row">
        <h1>Prihlásenie na predmet</h1>
        <table class="center_elements table_courses_view table-striped col-xs-12">
            <tbody>
                @foreach($courses as $course)
                    <tr class="row">
                        <td class="border_right col-xs-6"><b>{{ $course->name }}</b>, {{ $course->teacher->fullname }}</td>
                            @if($course->participants->first() && $course->participants->first()->state <> \App\Models\Participant::NOTHING)
                                <td class="col-xs-6 text-center table_courses_view_td">
                                    @if($course->participants->first()->state == \App\Models\Participant::ACCEPTED)
                                        Prihlásený
                                    @endif
                                    @if($course->participants->first()->state == \App\Models\Participant::REJECTED)
                                        Odmietnutý
                                    @endif
                                    @if($course->participants->first()->state == \App\Models\Participant::PENDING)
                                        Čaká na schválenie
                                    @endif
                                </td>
                            @else
                                <td class="col-xs-6 text-center table_courses_view_button">
                                    <button type="button" class="btn btn-default" data-course="{{ $course->id }}">
                                        Prihlásiť sa
                                    </button>
                                </td>
                            @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!! $courses->render() !!}
        </div>
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
                <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : ''), [], ['id'=>'draft-count']) !!}</p>
                @if(Auth::user()->hasRole(\App\Models\User::STUDENT_ROLE))
                    <p>Zapísať sa na predmet</p>
                @endif
            @endif
        </div>
    </div>
@stop