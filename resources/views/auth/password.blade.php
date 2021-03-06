@extends('layouts.master')

@section('content')

    <div class="container-fluid container_content push">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading"><h1>Obnoviť heslo</h1></div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

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

                        {!! Form::open(['url' => '/password/email', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail <i class="ion-help-circled" rel="tooltip" title="Prihlasovací e-mail na obnovenie hesla (povinné pole)"></i></label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Odoslať odkaz na obnovu hesla
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
