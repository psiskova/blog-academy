@extends('layouts/9-3')

@section('scripts')
    {!! HTML::script('js/users.block.js') !!}
@stop

@section('left')
    <h1 class="text-center">BLOKOVANIE POUŽÍVATEĽOV</h1>
    <div class="row">
        <table class="center_elements table_block table-striped">
            <tr>
                <th class="border_right">Meno a priezvisko</th>
                <th class="border_right">Zablokovať</th>
                <th>Odblokovať</th>
            </tr>
            @foreach($users as $user)
                {!! Form::open(['url' => action('UserController@postBlock'), 'method' => 'post']) !!}
                <tr>
                    <td class="border_right">{{ $user->fullname }}</td>
                    <td class="border_right">{!! Form::submitWithIcon('ban', 0, 'btn-success center-block'. ($user->ban == 0 ? ' disabled' : ''), 'glyphicon-ok') !!}</td>
                    <td>{!! Form::submitWithIcon('ban', 1, 'btn-danger center-block' . ($user->ban == 1 ? ' disabled' : ''), 'glyphicon-remove') !!}</td>
                    {!! Form::hidden('id', $user->id) !!}
                </tr>
                {!! Form::close() !!}
            @endforeach
        </table>
        <div class="text-center">
            {!! $users->render() !!}
        </div>
    </div>
@stop