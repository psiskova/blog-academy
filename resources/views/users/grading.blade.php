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
                            @foreach($unratedArticles as $unratedArticle)
                                <tr class="row">
                                    <td class="border_right col-xs-6">{{ $unratedArticle->title }}</td>
                                    <td class="col-xs-6">
                                        <a href="{{ action('ArticleController@getRate', ['id' => $unratedArticle->slug]) }}">
                                            <button type="button" class="btn btn-default center-block">Ohodnotiť
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <table class="center_elements table-striped table_not_grading_student col-xs-12">
                            @foreach($unratedArticles as $unratedArticle)
                                <tr class="row">
                                    <td class="col-xs-12">{!! link_to_action('ArticleController@getShow', $unratedArticle->title, ['id' => $unratedArticle->slug]) !!}</td>
                                </tr>
                            @endforeach
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
                            @foreach($ratedArticles as $ratedArticle)
                                <tr class="row">
                                    <td class="border_right col-xs-6">{!! link_to_action('ArticleController@getShow', $ratedArticle->title, ['id' => $ratedArticle->slug]) !!}</td>
                                    <td class="col-xs-6">{{ $ratedArticle->teacher_rating_value }}</td>
                                </tr>
                            @endforeach
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