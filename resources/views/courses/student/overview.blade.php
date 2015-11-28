@extends('layouts.9-3')

@section('scripts')
    <script src="{{ elixir('js/courses.student.overview.js') }}"></script>
@stop

@section('left')
    <div class="row">
        <h1>Prihlásenie na predmet</h1>
        <table class="center_elements table_courses_view table-striped col-xs-12">
            @foreach($courses as $course)
                <tr class="row">
                    <td class="border_right col-xs-6"><b>{{ $course->name }}</b>, {{ $course->teacher->fullname }}</td>
                        @if($course->participants->first() && $course->participants->first()->state <> \App\Models\Participant::NOTHING)
                            <td class="col-xs-6 text-center table_courses_view_td">
                                @if($course->participants->first()->state == \App\Models\Participant::ACCEPTED)
                                    Prihlásený
                                @endif
                                @if($course->participants->first()->state == \App\Models\Participant::REJECTED)
                                    Odmietnutý
                                @endif
                                @if($course->participants->first()->state == \App\Models\Participant::PENDING)
                                    Čaká na schválenie
                                @endif
                            </td>
                        @else
                            <td class="col-xs-6 text-center table_courses_view_button">
                                <button type="button" class="btn btn-default" data-course="{{ $course->id }}">
                                    Prihlásiť sa
                                </button>
                            </td>
                        @endif
                </tr>
            @endforeach
        </table>
    </div>
@stop

@section('right')
    @include('users.rightmenu', ['user' => Auth::user()])
@stop