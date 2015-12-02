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
                                <div class="alert alert-danger" role="alert" style="margin: 0 0px 20px 0">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span><div id="error-message" style="width: initial"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Meno</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') ? old('name')  : $user->name  }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Priezvisko</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname"
                                       value="{{ old('surname') ? old('surname') : $user->surname }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email"
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
