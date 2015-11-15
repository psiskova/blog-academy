@extends('layouts/9-3')

@section('left')
    <h1 class="text-center">HODNOTENIE</h1>
    <div class="side_tabs">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Neohodnotené</a></li>
            <li><a data-toggle="tab" href="#tab2">Celkové hodnotenie</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">

                @if(Auth::user()->hasRole(\App\Models\User::TEACHER_ROLE))
                    <table class="center_elements table_not_grading_teacher table-striped">
                        <tr>
                            <td class="border_right">Názov</td>
                            <td>
                                <button type="button" class="btn btn-default">Ohodnotiť</button>
                            </td>
                        </tr>
                    </table>
                @else
                    <table class="center_elements table-striped table_not_grading_student">
                        <tr>
                            <td>Článok 1</td>
                        </tr>
                    </table>
                @endif
            </div>
            <div id="tab2" class="tab-pane fade">
                <p>bbb</p>
            </div>
        </div>
    </div>

@stop

@section('right')
    <p>*TODO čo sem?</p>
@stop