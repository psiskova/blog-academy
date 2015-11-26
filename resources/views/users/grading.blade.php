@extends('layouts/9-3')

@section('left')
    <div class="row">
    <h1>Hodnotenie</h1>
    <div class="side_tabs col-sx-12 side_tabs_grading">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Neohodnotené</a></li>
            <li><a data-toggle="tab" href="#tab2">Celkové hodnotenie</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">

                @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                    <table class="center_elements table-striped table_not_grading_teacher col-xs-12">
                        <tr class="row">
                            <td class="border_right col-xs-6">Názov</td>
                            <td class="col-xs-6">
                                <button type="button" class="btn btn-default center-block">Ohodnotiť</button>
                            </td>
                        </tr>
                    </table>
                @else
                    <table class="center_elements table-striped table_not_grading_student col-xs-12">
                        <tr class="row">
                            @foreach($unratedArticles->get() as $unratedArticle)
                                <td class="col-xs-12">{!! link_to_action('ArticleController@getShow', $unratedArticle->title, ['id' => $unratedArticle->slug]) !!}</td>
                            @endforeach
                        </tr>
                    </table>
                @endif
            </div>
            <div id="tab2" class="tab-pane fade">
                @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                    <table class="center_elements table-striped table_grades col-xs-12">
                        <tr class="row">
                            <td class="border_right col-xs-6">Meno študenta</td>
                            <td class="col-xs-6">Celkové hodnotenie študenta v danom predmete</td>
                        </tr>
                    </table>
                @else
                    <table class="center_elements table-striped table_grades col-xs-12">
                        <tr class="row">
                            <td class="border_right col-xs-6">Článok 1</td>
                            <td class="col-xs-6">Hodnotenie</td>
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </div>

    </div>

@stop

@section('right')
    @include('users.rightmenu', ['user' => $user])
@stop