@extends('layouts/9-3')

@section('scripts')
    {!! HTML::script('js/users.management.js') !!}
@stop

@section('left')
    <div class="row">
        <h1 class="text-center">SPRÁVA POUŽÍVATEĽSKÝCH ROLÍ</h1>
        <table class="center_elements table_block table-striped">
            <tr>
                <th class="border_right">Meno a priezvisko</th>
                <th>Používateľská rola</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td class="border_right">{{ $user->fullname }}</td>
                    <td>
                        {!! Form::select('role', [\App\Models\User::STUDENT_ROLE => 'Žiak', \App\Models\User::TEACHER_ROLE => 'Učiteľ', \App\Models\User::ADMIN_ROLE => 'Administrátor'], $user->role, ['id' => $user->id]) !!}
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="text-center fix1">
            {!! $users->render() !!}
        </div>
    </div>
@stop