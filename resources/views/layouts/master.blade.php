<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Academy</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="cTLZgZmwZhQv9jLmPmzMmciStEMSCSHzQioeQRvbT-8"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">
    {!! HTML::style('css/ionicons.min.css') !!}
    <link rel="stylesheet" href="{{ elixir('css/style.css') }}">
</head>
<body>

    <div class="container main_container">
        <div class="row {{ Auth::check() ? '' : 'row-header' }}">
            <div class="jumbotron main-header">
                <div id="nav-top-right" class="hidden-xs hidden-sm pull-right">
                    @if(Auth::check())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true"
                           aria-expanded="false">
                            {{ Auth::user()->fullname }}
                            {!! HTML::profilePicture(Auth::user(), 30, 30, ['class' => 'profile-image img-circle']) !!}
                        </a>
                        <a href="{!! URL::action('Auth\AuthController@getLogout') !!}" class="vertical-login-separator">Odhlásiť</a>
                    @else
                        {!! link_to_action('Auth\AuthController@getLogin', 'Prihlásenie') !!}
                        <a href="{!! URL::action('Auth\AuthController@getRegister') !!}" class="vertical-login-separator">Registrácia</a>
                    @endif
                </div>
                <div class="{{ Auth::check() ? 'col-xs-3 col-sm-3' : 'col-xs-4 col-sm-4' }} col-md-6">
                    <a href="{!! url('/') !!}" id="ba-logo"></a>
                </div>
                <div class="col-md-6 hidden-xs hidden-sm">
                    {!! Form::open(['url' => '/', 'method' => 'get', 'class'=>'navbar-form navbar-right search-form-header', 'role'=>'search']) !!}
                    <div class="form-group search-form-group row">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control search-input-mod typeahead"
                                   placeholder="Hľadaný výraz" value="{{ $search or '' }}"
                                   autocomplete="off">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-search">
                                    <i class="icon ion-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="mobile-icon-profile col-xs-7 col-sm-7 hidden-md hidden-lg">
                    <!-- MOBILE SEARCH FORM -->

                    {!! Form::open(['url' => '/', 'method' => 'get', 'class'=>'navbar-form navbar-right search-form-header', 'role'=>'search']) !!}
                    <div class="form-group search-form-group row">

                        <div class="inner-addon left-addon">
                            <i class="icon icon-resizer ion-search "></i>
                            <input type="text" name="search" class="form-control typeahead mobile-search-input"
                                   placeholder="Hľadaj" value="{{ $search or '' }}"
                                   autocomplete="off">
                        </div>


                    </div>
                    {!! Form::close() !!}
                    <!-- END OF MOBILE SEARCH FORM -->
                </div>
                @if(Auth::check())
                    <div class="mobile-icon-profile col-xs-2 col-sm-2 hidden-md hidden-lg">
                        <a href="{!! URL::action('UserController@getProfile', Auth::user()->slug) !!}">
                            <i class="icon icon-resizer ion-android-person"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @if(Auth::check())
        <div class="hidden-md hidden-lg course-mobile-row">
            {!! Form::open(['url' => URL::action('CourseController@postChangeSelectedCourse'), 'class' => 'course-select-form', 'role' => 'form']) !!}
            <div class="form-group col-sm-offset-3">
                <div class="input-group">
                    <span class="input-group-btn">
                        <label for="chooseCourse" class="course-select-label hidden-xs">Výber predmetu:</label>
                    </span>
                    <select class="form-control course-option" id="chooseCourse" name="course_id">
                        <option value="" style="display:none">Vyber predmet</option>
                        @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                            @foreach(\App\Models\Course::where('user_id', '=', Auth::id())->get() as $course)
                                <option value="{{ $course->id }}" {{ (Auth::user()->course && $course->id == Auth::user()->course->id) ? 'selected' : '' }}>{{ $course->name }}</option>
                            @endforeach
                        @else
                            @foreach(\App\Models\Participant::where('user_id', '=', Auth::id())->where('state', '=', \App\Models\Participant::ACCEPTED)->with('course')->get() as $participant)
                                <option value="{{ $participant->course->id }}" {{ Auth::user()->course && $participant->course->id == Auth::user()->course->id ? 'selected' : ''}}>{{ $participant->course->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
        @endif
        <div class="row hidden-xs hidden-sm">
            <nav class="navbar navbar-default">
                <!-- Collect the nav links, forms, and other content for toggling  **dektop -->
                <div class="container-fluid full-nav-width">
                    @if(Auth::check())
                        <ul class="nav navbar-nav row col-md-12">
                            <li class="col-md-2 color-nav-home">
                                {!! HTML::navTabItem(url('/'), 'Domov', 'ion-home') !!}
                            </li>
                            <li class="col-md-2 color-nav-profile">
                                {!! HTML::navTabItem(URL::action('UserController@getProfile', Auth::user()->slug), 'Profil', 'ion-android-person') !!}
                            </li>
                            <li class="col-md-2 color-nav-addarticle">
                                {!! HTML::navTabItem(URL::action('ArticleController@getCreate'), 'Pridať článok', 'ion-edit') !!}
                            </li>
                            <li class="col-md-2 color-nav-grading">
                                {!! HTML::navTabItem(URL::action('UserController@getGrading', Auth::user()->slug), 'Hodnotenie', 'ion-star') !!}
                            </li>
                            <li class="col-md-2 color-nav-course">
                                @if(Auth::user()->hasRole(\App\Models\User::STUDENT_ROLE))
                                    {!! HTML::navTabItem(URL::action('CourseController@getOverview'), 'Zapísať sa', 'ion-university') !!}
                                @else
                                    {!! HTML::navTabItem(URL::action('CourseController@getOverview'), 'Moje predmety', 'ion-university') !!}
                                @endif
                            </li>
                            <li class="col-md-2 color-nav-select">
                                {!! Form::open(['url' => URL::action('CourseController@postChangeSelectedCourse'), 'class' => 'course-select-form', 'role' => 'form']) !!}
                                <div class="form-group">
                                    <label for="chooseCourse" class="course-select-label">Výber predmetu:</label>
                                    <select class="form-control course-option" id="chooseCourse" name="course_id">
                                        <option value="" style="display:none">Vyber predmet</option>
                                        @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                                            @foreach(\App\Models\Course::where('user_id', '=', Auth::id())->get() as $course)
                                                <option value="{{ $course->id }}" {{ (Auth::user()->course && $course->id == Auth::user()->course->id) ? 'selected' : '' }}>{{ $course->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach(\App\Models\Participant::where('user_id', '=', Auth::id())->where('state', '=', \App\Models\Participant::ACCEPTED)->with('course')->get() as $participant)
                                                <option value="{{ $participant->course->id }}" {{ Auth::user()->course && $participant->course->id == Auth::user()->course->id ? 'selected' : ''}}>{{ $participant->course->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav row col-md-12">
                            <li class="col-md-3 color-nav-home">
                                {!! HTML::navTabItem(url('/'), 'Domov', 'ion-home') !!}
                            </li>
                            <li class="col-md-3 color-nav-profile">
                                {!! HTML::navTabItem(url('/about-us'), 'O nás', 'ion-android-person') !!}
                            </li>
                            <li class="col-md-3 color-nav-addarticle">
                                {!! HTML::navTabItem(URL::action('Auth\AuthController@getLogin'), 'Prihlásenie', 'ion-edit') !!}
                            </li>
                            <li class="col-md-3 color-nav-grading">
                                {!! HTML::navTabItem(URL::action('Auth\AuthController@getRegister'), 'Registrácia', 'ion-star') !!}
                            </li>
                        </ul>
                    @endif
                </div>
            </nav>
        </div>


        @include('flash::message')
        @yield('content')


        <footer class="hidden-sm hidden-xs">
            <div class="row footer-top-row">
                <ul class="footer-top-menu">
                    <li> <a href="{!! url('/about-us') !!}">O nás</a> </li>
                    <li> <a href="{!! url('/faq') !!}">FAQ</a> </li>
                    <li> <a href="{!! url('/rules') !!}">Pravidlá</a> </li>
                </ul>
            </div>
            <div class="row footer-bottom-row">
                <p class="text-center">FMFI UK v Bratislave &copy; 2015-2016 access_denied</p>
            </div>

        </footer>



</div>







<div class="tab-nav tabs hidden-lg hidden-md">
    {!! HTML::tabItem(url('/'), 'Home', 'ion-home', 'color-nav-home') !!}
    @if(Auth::check())
        {!! HTML::tabItem(URL::action('ArticleController@getCreate'), 'Pridať článok', 'ion-compose', 'color-nav-addarticle') !!}
        {!! HTML::tabItem('', 'Hodnotenia', 'ion-ios-star', 'color-nav-grading') !!}
        {!! HTML::tabItem('', 'Viac', 'ion-navicon-round', 'color-nav-course') !!}
    @else
        {!! HTML::tabItem(URL::action('Auth\AuthController@getLogin'), 'Login', 'ion-log-in', 'color-nav-grading') !!}
        {!! HTML::tabItem(URL::action('Auth\AuthController@getRegister'), 'Register', 'ion-person-add', 'color-nav-course') !!}
    @endif
</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
        integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
        crossorigin="anonymous"></script>
{!! HTML::script('js/laroute.js') !!}
{!! HTML::script('js/bootstrap-typeahead.min.js') !!}
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        });
    });
</script>
{!! HTML::script('js/index.js') !!}
@yield('scripts')
</body>
</html>