@extends('layouts.9-3')

@section('left')
    <h1 class="text-center">PRIHLÁSENIE NA PREDMET</h1>
    @foreach($courses as $course)
        <table class="center_elements table_courses_view table-striped">
            <tr>
                <td class="border_right"><b>{{ $course->name }}</b>, {{ $course->teacher->fullname }}</td>
                {{--podľa stavu prihláseného užívateľa v danom predmete sa mu ponúkne adekvátny výpis--}}
                <td>
                    <button type="button" class="btn btn-default">Prihlásiť sa</button>
                </td>
                <td>Čaká na schválenie</td>
                <td>Prihlásený</td>
            </tr>
        </table>
    @endforeach
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat profil</p>
    </div>
@stop