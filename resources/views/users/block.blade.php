@extends('layouts.master')

@section('scripts')
    <script src="{{ elixir('js/users.block.js') }}"></script>
@stop

@section('content')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="container-fluid row text-justify container_content">
        <div class="col-md-3 col-md-push-7 col-md-offset-1 right_col">
            <div class="right_col_profile right_col_profile_top mobile_profile">
                <div class="pencil"></div>
                <div class="text-center">
                    <p>{!! link_to_action('UserController@getManagement', "Správa používateľských rolí") !!}</p>
                    <p>Blokovanie používateľov</p>
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
                <h1>Blokovanie používateľov</h1>
                <table class="center_elements table_block table-striped col-xs-12">
                    <tr class="row">
                        <th class="border_right col-xs-4">Meno a priezvisko</th>
                        <th class="border_right col-xs-4 text-center">Zablokovať</th>
                        <th class="col-xs-4 text-center">Odblokovať</th>
                    </tr>
                    @foreach($users as $user)
                        {!! Form::open(['url' => action('UserController@postBlock'), 'method' => 'post']) !!}
                        <tr class="row">
                            <td class="border_right col-xs-4 table_block_td">{{ $user->fullname }}</td>
                            <td class="border_right col-xs-4 table_block_button">{!! Form::submitWithIcon('ban', 0, 'btn-success center-block'. ($user->ban == 0 ? ' disabled' : ''), 'glyphicon-ok') !!}</td>
                            <td class="col-xs-4 table_block_button">{!! Form::submitWithIcon('ban', 1, 'btn-danger center-block' . ($user->ban == 1 ? ' disabled' : ''), 'glyphicon-remove') !!}</td>
                            {!! Form::hidden('id', $user->id) !!}
                        </tr>
                        {!! Form::close() !!}
                    @endforeach
                </table>
                <div class="text-center fix1">
                    {!! $users->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop