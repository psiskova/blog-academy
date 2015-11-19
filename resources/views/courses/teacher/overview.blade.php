@extends(isset($course) ? 'layouts.master' : 'layouts.9-3')

@if(!isset($course))
@section('scripts')
    {!! HTML::script('js/courses.teacher.overview.js') !!}
@stop

@section('left')
    <div class="row">
        <h1>Prihlásení na predmet</h1>
        <table class="center_elements table_courses_view table-striped col-xs-12">
            @foreach($participants as $participant)
                <tr class="row">
                    <td class="border_right col-xs-6">{{ $participant->user->fullname }}</td>
                    <td class="col-xs-6 text-center">
                        @if($participant->state == \App\Models\Participant::ACCEPTED)
                            Prihlásený
                        @endif
                        @if($participant->state == \App\Models\Participant::REJECTED)
                            Odmietnutý
                        @endif
                        @if($participant->state == \App\Models\Participant::PENDING)
                            Buttony
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop

@section('right')
    <div class="row">
        {!! link_to_action('CourseController@getCreate', 'Pridať predmet') !!}
    </div>
@stop
@else
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-10 col-md-2 text-center">
                <span class="ion-ios-arrow-thin-up" style="font-size: 32px"></span><br>
                Nie je zvolený predmet
            </div>
        </div>
    </div>
@stop
@endif