@extends('layouts/9-3')

@section('left')
    <div class="row">
        <table>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->ban }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop