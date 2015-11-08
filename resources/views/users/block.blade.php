@extends('layouts/9-3')

@section('scripts')
    {!! HTML::script('js/users.block.js') !!}
@stop

@section('left')
    <div class="row">
        <table>
            @foreach($users as $user)
                {!! Form::open(['url' => action('UserController@postBlock'), 'method' => 'post']) !!}
                <tr>
                    <td>{{ $user->fullname }}</td>
                    <td>{!! Form::submitWithIcon('ban', 1, 'btn-danger' . ($user->ban == 1 ? ' disabled' : ''), 'glyphicon-remove') !!}</td>
                    <td>{!! Form::submitWithIcon('ban', 0, 'btn-success'. ($user->ban == 0 ? ' disabled' : ''), 'glyphicon-ok') !!}</td>
                    {!! Form::hidden('id', $user->id) !!}
                </tr>
                {!! Form::close() !!}
            @endforeach
        </table>
        {!! $users->render() !!}
    </div>
@stop