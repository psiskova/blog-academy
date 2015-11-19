@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/courses.student.overview.js') !!}
@stop

@section('left')
    <div class="row">
        <h1>Prihlásenie na predmet</h1>
        <table class="center_elements table_courses_view table-striped col-xs-12">
            @foreach($courses as $course)
                <tr class="row">
                    <td class="border_right col-xs-6"><b>{{ $course->name }}</b>, {{ $course->teacher->fullname }}</td>
                    <td class="col-xs-6 text-center">
                        @if($course->participants->first() && $course->participants->first()->state <> \App\Models\Participant::NOTHING)
                            @if($course->participants->first()->state == \App\Models\Participant::ACCEPTED)
                                Prihlásený
                            @endif
                            @if($course->participants->first()->state == \App\Models\Participant::REJECTED)
                                Odmietnutý
                            @endif
                            @if($course->participants->first()->state == \App\Models\Participant::JOINED)
                                Čaká na schválenie
                            @endif
                        @else
                            <button type="button" class="btn btn-default" data-course="{{ $course->id }}">
                                Prihlásiť sa
                            </button>
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