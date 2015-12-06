@extends('layouts.master')

@section('scripts')
    <script src="{{ elixir('js/user.profileupdate.js') }}"></script>
@stop

@section('content')
    <div class="container-fluid container_content push">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading"><h1>Zmena profilu</h1></div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Ooops!</strong> Jeden zo vstupov nie je správny.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['url' => URL::action('UserController@postUpdateProfile'), 'class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="form-group">
                            <div class="col-md-6 col-md-push-5">
                                {!! HTML::profilePicture($user, 120, 120, ['id' => 'profile_picture']) !!}
                                {!! Form::file('image', ['style' => 'display:none']) !!}
                            </div>
                        </div>

                        <div class="form-group image-error hidden" style="margin-bottom: 0">
                            <div class="col-md-offset-4 col-md-6">
                                <div class="alert alert-danger" role="alert" style="margin: 0 0 20px 0; width: initial;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span><div id="error-message" style="display: inline;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Meno  <i class="ion-help-circled" rel="tooltip" title="Zadajte Vaše nové meno (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{{ old('name') ? old('name')  : $user->name  }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Priezvisko  <i class="ion-help-circled" rel="tooltip" title="Zadajte Vaše nové priezvisko (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname" id="surname"
                                       value="{{ old('surname') ? old('surname') : $user->surname }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail  <i class="ion-help-circled" rel="tooltip" title="Nový prihlasovací e-mail (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" id="email"
                                       value="{{ old('email') ? old('email') : $user->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Odoslať
                                </button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
