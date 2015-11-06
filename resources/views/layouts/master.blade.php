<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Academy</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
            integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
            crossorigin="anonymous"></script>
    {!! HTML::style('css/style.css') !!}
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
            });
        });
    </script>
</head>

<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {!! link_to('/', 'Blog', ['class'=>'navbar-brand']) !!}
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true"
                                   aria-expanded="false">
                                    <img src="http://placehold.it/30x30"
                                         class="profile-image img-circle"> {{ Auth::user()->fullname }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>{!! link_to_action('UserController@getProfile', 'Profile', ['id' => Auth::user()->getSlug()]) !!}</li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>{!! link_to_action('Auth\AuthController@getLogout', 'Logout') !!}</li>
                                </ul>
                            </li>
                        @else
                            <li>{!! link_to_action('Auth\AuthController@getRegister', 'Register') !!}</li>
                            <li>{!! link_to_action('Auth\AuthController@getLogin', 'Login') !!}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    @yield('content')

</div>
<div class="tab-nav tabs hidden-lg hidden-md">
    <a class="tab-item tab-item-active" href="{{ url('/') }}">
        <i class="icon ion-home"></i>
        <span class="tab-title">Home</span>
    </a>
    @if(Auth::check())
        <a class="tab-item" href="{{ URL::action('ArticleController@getCreate') }}">
            <i class="icon ion-compose"></i>
            <span class="tab-title">Pridať článok</span>
        </a>
        <a class="tab-item">
            <i class="icon ion-ios-star"></i>
            <span class="tab-title">Hodnotenia</span>
        </a>
        <a class="tab-item">
            <i class="icon ion-navicon-round"></i>
            <span class="tab-title">Viac</span>
        </a>
    @else
        <a class="tab-item" href="{{ URL::action('Auth\AuthController@getLogin') }}">
            <i class="icon ion-log-in"></i>
            <span class="tab-title">Login</span>
        </a>
        <a class="tab-item" href="{{ URL::action('Auth\AuthController@getRegister') }}">
            <i class="icon ion-person-add"></i>
            <span class="tab-title">Register</span>
        </a>
    @endif
</div>
</body>
</html>

