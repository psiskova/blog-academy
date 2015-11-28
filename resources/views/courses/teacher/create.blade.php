@extends('layouts.master')

@section('content')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="container-fluid row text-justify container_content">
        <div class="col-md-3 col-md-push-7 col-md-offset-1 right_col">
            <div class="right_col_profile right_col_profile_top mobile_profile">
                <div class="pencil"></div>
                <div class="text-center">
                    <p>{!! link_to_action('CourseController@getOverview', "Správa predmetu ") !!}</p>
                    <p>{!! link_to_action('TaskController@getCreate', 'Vytvoriť zadanie') !!}</p>
                    <p>Pridať predmet</p>
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
                <h1>Pridať predmet</h1>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['url' => action('CourseController@postCreate'), 'class' => 'form-horizontal']) !!}


                    <div class="form-group">
                        <label class="col-md-4 control-label">Názov predmetu</label>
                        <div class="col-md-6">
                            <input type="name" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Rok</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="year">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                Uložiť
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop