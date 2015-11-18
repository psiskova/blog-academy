@extends('layouts.9-3')

@section('left')
    <div class="row">
        <h1>Prihlásenie na predmet</h1>
        @foreach($courses as $course)
            <table class="center_elements table_courses_view table-striped col-xs-12">
                <tr class="row">
                    <td class="border_right col-xs-6"><b>{{ $course->name }}</b>, {{ $course->teacher->fullname }}</td>
                    {{--podľa stavu prihláseného užívateľa v danom predmete sa mu ponúkne adekvátny výpis--}}
                    <td class ="col-xs-6">
                        <button type="button" class="btn btn-default center-block">Prihlásiť sa</button>
                    </td>
    {{--                <td class ="col-xs-6">Čaká na schválenie</td>
                    <td class ="col-xs-6">Prihlásený</td>--}}
                </tr>
            </table>
        @endforeach
    </div>
@stop

@section('right')
    <div class="row">
        <p>tu budeme vypisovat profil</p>
    </div>
@stop