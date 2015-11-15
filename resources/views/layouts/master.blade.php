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
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    {!! HTML::style('css/style.css') !!}
</head>


<body>

<div class="container main_container">
    <div class="row">
        <div class="jumbotron main-header">
            <div id="nav-top-right" class="hidden-xs hidden-sm">
                @if(Auth::check())
                    <span class="login-information">Prihlásený ako </span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true"
                       aria-expanded="false">
                        {{ Auth::user()->fullname }}
                        <img src="http://placehold.it/30x30"
                             class="profile-image img-circle">
                        <span class="caret"></span>
                    </a>
                    <a href="{!! URL::action('Auth\AuthController@getLogout') !!}">Odhlásiť</a>
                @else
                    {!! link_to_action('Auth\AuthController@getLogin', 'Prihlásenie') !!} &#124;
                    {!! link_to_action('Auth\AuthController@getRegister', 'Registrácia') !!}
                @endif
            </div>
            <a href="{!! url('/') !!}">
                <div id="ba-logo">BlogAcademy</div>
            </a>

            <form class="navbar-form navbar-right search-form-header" role="search">
                <div class="form-group">
                    <input type="text" class="form-control search-input-mod" placeholder="Hľadaný výraz">
                </div>
                <button type="submit" class="btn btn-default btn-search"><i class="icon ion-search"></i></button>
            </form>
            @if(Auth::check())
                <div class="mobile-icon-profile col-sm-3 hidden-md hidden-lg">
                    <a href="{!! URL::action('UserController@getProfile', Auth::user()->slug) !!}">
                        <i class="icon icon-resizer ion-android-person"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
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
                            {!! HTML::navTabItem(URL::action('CourseController@getOverview'), 'Zapísať sa', 'ion-university') !!}
                        </li>
                        <li class="col-md-2 color-nav-select">
                            <form role="form" class="course-select-form">
                                <div class="form-group">
                                    <label for="sel1">Výber predmetu:</label>
                                    <select class="form-control course-option" id="sel1">
                                        <option value="" style="display:none">Vyber predmet</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="nav navbar-nav row col-md-12">
                        <li class="col-md-2 color-nav-home">
                            {!! HTML::navTabItem(url('/'), 'Domov', 'ion-home') !!}
                        </li>
                        <li class="col-md-2 color-nav-profile">
                            <!-- TODO: about us, change link -->
                            {!! HTML::navTabItem(url('/'), 'O nás', 'ion-android-person') !!}
                        </li>
                        <li class="col-md-2 color-nav-addarticle">
                            {!! HTML::navTabItem(URL::action('Auth\AuthController@getLogin'), 'Prihlásenie', 'ion-edit') !!}
                        </li>
                        <li class="col-md-2 color-nav-grading">
                            {!! HTML::navTabItem(URL::action('Auth\AuthController@getRegister'), 'Registrácia', 'ion-star') !!}
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    </div>
    @include('flash::message')
    @yield('content')
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

<footer class="hidden-sm hidden-xs">
    <p class="text-center">FMFI UK v Bratislave &copy; 2015-2016 access_denied</p>
</footer>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
        integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
        crossorigin="anonymous"></script>
{!! HTML::script('js/laroute.js') !!}
@yield('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
        });
    });
</script>
</body>
</html>

