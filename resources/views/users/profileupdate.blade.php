@extends('layouts.master')

@section('scripts')
    {!! HTML::script('js/user.profileupdate.js') !!}
@stop

@section('content')
    <div class="container-fluid">
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

                        {!! Form::open(['url' => URL::action('UserController@postUpdateProfile'), 'class' => 'form-horizontal']) !!}

                            <div class="form-group">

                                <div class="col-md-6 col-md-push-5">
                                    <img src="http://lorempixel.com/120/120/" alt=" top user fullname ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Meno</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name')  : $user->name  }}">
                                </div>
                            </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Priezvisko</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname" value="{{ old('surname') ? old('surname') : $user->surname }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') ? old('email') : $user->email }}">
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
