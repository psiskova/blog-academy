@extends('layouts.9-3')

@section('left')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h1>Vytvoriť zadanie</h1></div>
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

                        {!! Form::open(['url' => action('TaskController@postCreate'), 'class' => 'form-horizontal']) !!}


                        <div class="form-group">
                            <label class="col-md-4 control-label">Názov zadania</label>

                            <div class="col-md-6">
                                <input type="name" class="form-control" name="name" value="{{ old('name') }}">
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
    </div>
@stop

@section('right')

@stop