@extends('layouts/9-3')

@section('scripts')
    {!! HTML::script('js/users.block.js') !!}
@stop

@section('left')
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
                <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
                <p>{!! link_to_action('UserController@getManagement', "Správa používateľov") !!}</p>
            @endif
        </div>
    </div>
@stop