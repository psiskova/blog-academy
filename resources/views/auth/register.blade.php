@extends('layouts.master')

@section('content')
    <div class="container-fluid container_content push">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading"><h1>Registrácia</h1></div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Ooops!</strong>
                                <div class="bad-input">Jeden zo vstupov nie je správny.</div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['url' => '/auth/register', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Meno <i class="ion-help-circled" rel="tooltip" title="Zadajte Vaše meno (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Priezvisko <i class="ion-help-circled" rel="tooltip" title="Zadajte Vaše priezvisko (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail <i class="ion-help-circled" rel="tooltip" title="E-mail pod ktorým sa budete prihlasovať (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Heslo <i class="ion-help-circled" rel="tooltip" title="Heslo s minimálnou dĺžkou 6 (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Zopakujte heslo <i class="ion-help-circled" rel="tooltip" title="Heslá sa musia zhodovať (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Zaregistrovať
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
