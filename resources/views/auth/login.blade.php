@extends('layouts.master')

@section('content')
    <div class="container-fluid container_content push">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading"><h1>Prihlásenie</h1></div>
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

                        {!! Form::open(['url' => '/auth/login', 'class' => 'form-horizontal']) !!}


                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail <i class="ion-help-circled" rel="tooltip" title="Prihlasovací e-mail (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Heslo <i class="ion-help-circled" rel="tooltip" title="Prihlasovacie heslo (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Zapamätaj si ma
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                    Prihlásiť sa
                                </button>

                                <a href="/password/email">Zabudol som heslo</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection