@extends('layouts/9-3')

@section('scripts')
    {!! HTML::script('js/users.block.js') !!}
@stop

@section('left')
    <div class="row">
        <h1 class="text-center">BLOKOVANIE POUŽÍVATEĽOV</h1>
        <table class="center_elements table_block table-striped col-xs-12">
            <tr class="row">
                <th class="border_right col-xs-4">Meno a priezvisko</th>
                <th class="border_right col-xs-4">Zablokovať</th>
                <th class="col-xs-4">Odblokovať</th>
            </tr>
            @foreach($users as $user)
                {!! Form::open(['url' => action('UserController@postBlock'), 'method' => 'post']) !!}
                <tr class="row">
                    <td class="border_right col-xs-4">{{ $user->fullname }}</td>
                    <td class="border_right col-xs-4">{!! Form::submitWithIcon('ban', 0, 'btn-success center-block'. ($user->ban == 0 ? ' disabled' : ''), 'glyphicon-ok') !!}</td>
                    <td class="col-xs-4">{!! Form::submitWithIcon('ban', 1, 'btn-danger center-block' . ($user->ban == 1 ? ' disabled' : ''), 'glyphicon-remove') !!}</td>
                    {!! Form::hidden('id', $user->id) !!}
                </tr>
                {!! Form::close() !!}
            @endforeach
        </table>
        <div class="text-center fix1">
            {!! $users->render() !!}
        </div>
    </div>
@stop