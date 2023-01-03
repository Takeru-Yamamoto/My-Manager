@extends('layouts.page.card-noFooter')

@section('card-header')
    Dashboard
@stop

@section('card-body')
    <div class="d-flex align-items-center justify-content-between">
        <p class="h4 m-0">勤怠情報</p>

        <div class="btn-box">
            @if (is_null($attendance) || $attendance->type !== '退勤')
                @if (is_null($attendance))
                    <a class="btn btn-primary attendance-create-btn" data-type="start_work" data-relation=""
                        data-url="{{ url('attendance/create') }}">出勤</a>
                @elseif ($attendance->type === '休憩中')
                    <a class="btn btn-warning attendance-create-btn" data-type="end_break"
                        data-relation="{{ $attendance->relation }}" data-url="{{ url('attendance/create') }}">休憩終了</a>
                @else
                    <a class="btn btn-success attendance-create-btn" data-type="start_break"
                        data-relation="{{ $attendance->relation }}" data-url="{{ url('attendance/create') }}">休憩開始</a>
                    <a class="btn btn-danger attendance-create-btn" data-type="end_work"
                        data-relation="{{ $attendance->relation }}" data-url="{{ url('attendance/create') }}">退勤</a>
                @endif
            @endif
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <th width="15%">状態</th>
            <th width="20%">出勤時刻</th>
            <th width="20%">退勤時刻</th>
            <th width="15%">実働時間</th>
            <th width="15%">勤務時間</th>
            <th width="15%">休憩時間</th>
        </thead>
        <tbody>
            @if (is_null($attendance))
                <tr>
                    <td>未出勤</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                <tr>
                    <td>{{ $attendance->type }}</td>
                    <td>{{ $attendance->startWork }}</td>
                    <td>{{ isset($attendance->endWork) ? $attendance->endWork : '' }}</td>
                    <td>{{ isset($attendance->totalWorkActual) ? $attendance->totalWorkActual : '' }}</td>
                    <td>{{ isset($attendance->totalWork) ? $attendance->totalWork : '' }}</td>
                    <td>{{ isset($attendance->totalBreak) ? $attendance->totalBreak : '' }}</td>
                </tr>
            @endif
        </tbody>
    </table>


    @if (!is_null($tasks))
        {!! border(5) !!}
        <p class="h4">タスク</p>

        <table class="table table-hover">
            <thead>
                <th width="25%">タイトル</th>
                <th width="35%">コメント</th>
                <th width="20%">開始日</th>
                <th width="20%">終了日</th>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->comment }}</td>
                        <td>{{ $task->startDate }}</td>
                        <td>{{ $task->endDate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop
