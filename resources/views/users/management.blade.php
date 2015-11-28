@extends('layouts.master')

@section('scripts')
    <script src="{{ elixir('js/users.management.js') }}"></script>
@stop

@section('content')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="container-fluid row text-justify container_content">
        <div class="col-md-3 col-md-push-7 col-md-offset-1 right_col">
            <div class="right_col_profile right_col_profile_top mobile_profile">
                <div class="pencil"></div>
                <div class="text-center">
                    <p>Správa používateľských rolí</p>
                    <p>{!! link_to_action('UserController@getBlock', "Blokovanie používateľov") !!}</p>
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
                            <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-pull-4 right-column left_col">
            <div class="row">
                <h1>Správa používateľských rolí</h1>
                <table class="center_elements table_manage table-striped col-xs-12">
                    <tr>
                        <th class="border_right col-xs-6">Meno a priezvisko</th>
                        <th class="col-xs-6">Používateľská rola</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td class="border_right table_manage_td col-xs-6">{{ $user->fullname }}</td>
                            <td class="col-xs-6 table_manage_button">
                                {!! Form::select('role', [\App\Models\User::STUDENT_ROLE => 'Žiak', \App\Models\User::TEACHER_ROLE => 'Učiteľ', \App\Models\User::ADMIN_ROLE => 'Administrátor'], $user->role, ['id' => $user->id]) !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="text-center fix1">
                    {!! $users->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop
