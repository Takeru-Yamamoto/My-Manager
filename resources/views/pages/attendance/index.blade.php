@extends('layouts.page.card-noFooter')

@section('card-header')
    {{ tableCardHeader() }}
@stop

@section('card-body')
    <p class="h4 m-0">月間</p>
    <table class="table table-hover">
        <thead>
            <th width="25%">勤務日数</th>
            <th width="25%">総実働時間</th>
            <th width="25%">総勤務時間</th>
            <th width="25%">総休憩時間</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $attendanceInMonth->workDays }}</td>
                <td>{{ $attendanceInMonth->totalWorkActual }}</td>
                <td>{{ $attendanceInMonth->totalWork }}</td>
                <td>{{ $attendanceInMonth->totalBreak }}</td>
            </tr>
        </tbody>
    </table>

    @if (!is_null($attendances))
        <p class="h4 m-0">ログ</p>
        <table class="table table-hover">
            <thead>
                <th width="40%">種別</th>
                <th width="60%">時刻</th>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ getAttendanceTypeText($attendance->type) }}</td>
                        <td>{{ $attendance->datetime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $attendances->links() }}

    @endif
@stop
