@extends('layouts/9-3')

@section('header')
    {!! HTML::style('css/star-rating.min.css') !!}
@stop

@section('scripts')
    <script src="{{ elixir('js/star-rating.min.js') }}"></script>
@stop

@section('left')
    <div class="row">
        <h1>Hodnotenie</h1>

        <div class="side_tabs col-sx-12 side_tabs_grading">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab1">Neohodnotené</a></li>
                <li><a data-toggle="tab" href="#tab2">Hodnotenie článkov</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                        <table class="center_elements table-striped table_not_grading_teacher col-xs-12">
                            <thead>
                            <tr class="row">
                                <th class="border_right col-xs-6">Názov článku</th>
                                <th class="col-xs-6 text-center">Hodnotenie</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($unratedArticles as $unratedArticle)
                                    <tr class="row">
                                        <td class="border_right col-xs-6 table_not_grading_student_td">{{ $unratedArticle->title }}</td>
                                        <td class="col-xs-6 table_not_grading_student_button text-center">
                                            <a href="{{ action('ArticleController@getRate', ['id' => $unratedArticle->slug]) }}">
                                                <button type="button" class="btn btn-default">
                                                    Ohodnotiť
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="center_elements table-striped table_not_grading_student col-xs-12">
                            <thead>
                                <tr class="row">
                                    <th class="col-xs-12">Názov článku</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unratedArticles as $unratedArticle)
                                    <tr class="row">
                                        <td class="col-xs-12">{!! link_to_action('ArticleController@getShow', $unratedArticle->title, ['id' => $unratedArticle->slug]) !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div id="tab2" class="tab-pane fade">
                    @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                        <table class="center_elements table-striped table_grades col-xs-12">
                            <thead>
                                <tr class="row">
                                    <th class="border_right col-xs-6">Meno a priezvisko</th>
                                    <th class="col-xs-6 text-center">Hodnotenie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ratedArticles as $ratedArticle)
                                    <tr class="row">
                                        <td class="border_right col-xs-6">{{ \App\Models\User::find($ratedArticle->user_id)->fullname }}</td>
                                        <td class="col-xs-6 text-center">
                                            <input type="number" class="rating" min=0 max=5
                                                   step=1 readonly data-size="xs"
                                                   data-show-Caption="false" data-show-Clear="false"
                                                   value="{{ round($ratedArticle->rating) }}"
                                                   data-disabled="true">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="center_elements table-striped table_grades col-xs-12">
                            <thead>
                                <tr class="row">
                                    <th class="border_right col-xs-6">Názov článku</th>
                                    <th class="col-xs-6 text-center">Hodnotenie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ratedArticles as $ratedArticle)
                                    <tr class="row">
                                        <td class="border_right col-xs-6">{!! link_to_action('ArticleController@getShow', $ratedArticle->title, ['id' => $ratedArticle->slug]) !!}</td>
                                        <td class="col-xs-6  text-center">
                                            <input type="number" class="rating" min=0 max=5
                                                   step=1 readonly data-size="xs"
                                                   data-show-Caption="false" data-show-Clear="false"
                                                   value="{{ round($ratedArticle->teacher_rating_value) }}"
                                                   data-disabled="true">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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